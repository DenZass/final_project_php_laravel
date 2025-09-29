<?php

namespace App\Services\Hotels;

use App\Models\FacilityHotel;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelServicesClass implements HotelServices
{
    public function index(Request $request): array
    {
        if($request->input('reset_filters')){
            $request->session()->forget('filterData');
            return [
                'hotels' => Hotel::paginate(10),
                'valueFromRequest'=> [],
            ];
        }

        if ($request->input('flag') == 1) {
            $price = $request->input('price');
            $type = $request->input('type');
            $facilities = $request->input('facilities');
            $request->session()->put('filterData', [
                'price' => $request->input('price'),
                'type' => $request->input('type'),
                'facilities' => $request->input('facilities')
            ]);

        } else if ($request->session()->has('filterData')){
            $price = $request->session()->get('filterData.price');
            $type = $request->session()->get('filterData.type');
            $facilities = $request->session()->get('filterData.facilities');

        } else {
            return [
                'hotels' => Hotel::paginate(10),
                'valueFromRequest'=> [],
            ];
        }

        $valueFromRequest = [
            'price' => '',
            'type' => [],
            'facilities' => [],
        ];

        $sqlComponents = [];
        $variablesForSqlRequest = [];

        if ($price) {
            $valueFromRequest['price'] = $price;
            $arrPrice = explode('-', $price);
            $variablesForSqlRequest['minValue'] = $arrPrice[0];
            $variablesForSqlRequest['maxValue'] = $arrPrice[1];
            $sqlComponents[] = <<<EOD
    select sub.id as hotel_id
        from (select id, title, (select min(price) from rooms where rooms.hotel_id = hotels.id) as room_price from hotels) as sub
        where sub.room_price BETWEEN :minValue and :maxValue
    EOD;
        }

        if ($type) {
            $valueFromRequest['type'] = $type;
            $typesInString = implode("', '", $type);
            $typesInString = "'" . $typesInString . "'";
            $sqlComponents[] = "select distinct hotel_id from rooms where type in({$typesInString})";
        }
        if ($facilities) {
            $valueFromRequest['facilities'] = $facilities;
            $facilitiesInString = implode("', '", $facilities);
            $facilitiesInString = "'" . $facilitiesInString . "'";
            $sqlComponents[] = "select distinct hotel_id from facility_hotels where facility_id in ($facilitiesInString)";
        }


        $implodeSqlComponents = implode(') intersect (', $sqlComponents);
        $implodeSqlComponents = '(' . $implodeSqlComponents . ')';
        $generalQslRequest = "select distinct tab.hotel_id from({$implodeSqlComponents}) tab;";

        $result = DB::select($generalQslRequest, $variablesForSqlRequest);

        $resultHotelsId = [];
        foreach ($result as $item) {
            $resultHotelsId[] = $item->hotel_id;
        }

        if($result) {
            return [
                'hotels' => Hotel::whereIn('id', $resultHotelsId)->paginate(10),
                'valueFromRequest'=> $valueFromRequest,
            ];
        }

        return [
            'hotels' => [],
            'valueFromRequest'=> [],
        ];
    }

    public function create(array $validateParam): int
    {
        $hotel = new Hotel();
        $hotel->title = $validateParam['title'];
        $hotel->description = $validateParam['description'];
        $hotel->poster_url = $validateParam['poster_url'];
        $hotel->address = $validateParam['address'];
        $hotel->save();

        if($validateParam['facilities']){
            foreach ($validateParam['facilities'] as $facilityId){
                $facilityHotel = new FacilityHotel();
                $facilityHotel->facility_id = $facilityId;
                $facilityHotel->hotel_id = $hotel->id;
                $facilityHotel->save();
            }
        }
        return $hotel->id;
    }

    public function update(int $id, array $validateParam): int
    {
        $hotel = Hotel::find($id);
        $hotel->title = $validateParam['title'];
        $hotel->description = $validateParam['description'];
        $hotel->poster_url = $validateParam['poster_url'];
        $hotel->address = $validateParam['address'];
        $hotel->save();

        FacilityHotel::where('hotel_id', $id)->delete();
        if ($validateParam['facilities'] !== null){
            foreach ($validateParam['facilities'] as $facilityId){
                $facilityHotel = new FacilityHotel();
                $facilityHotel->hotel_id = $id;
                $facilityHotel->facility_id = $facilityId;
                $facilityHotel->save();
            }
        }
        return $hotel->id;
    }
}
