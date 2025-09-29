@php
$typeList = \App\Models\Room::select('type')->distinct()->get();
$facilitiesListByThree = array_chunk(\App\Models\Facilitie::all()->all(), 3);
$maxPrice = strval(\App\Models\Room::max('price'));
@endphp
<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        @can('admin')
            <div class="mb-5">
                <x-link-button class="bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-400" href="{{ route('hotels.showFormCreate') }}">Добавить отель</x-link-button>
            </div>
        @endcan
        <form method="get" action="{{route('hotels.index')}}" class="bg-white mb-5 text-gray-600 p-2 rounded">
            @csrf
            <input type="hidden" name="flag" value="1">
            <h4 class="text-lg font-medium mb-4">Фильтры</h4>
            <hr class="mb-3">
            <div class="flex flex-row mb-5">
                <div class="flex flex-col ml-5 flex-auto">
                    <p class="font-medium">Минимальная цена</p>
                    <label for="radio_price_1"><input id="radio_price_1" type="radio" name="price" value="0-1000" @if($valueFromRequest && $valueFromRequest['price'] === '0-1000') checked @endif> до 1000 рублей</label>
                    <label for="radio_price_2"><input id="radio_price_2" type="radio" name="price" value="1000-10000" @if($valueFromRequest && $valueFromRequest['price'] === '1000-10000') checked @endif> от 1000 до 10000 рублей</label>
                    <label for="radio_price_3"><input id="radio_price_3" type="radio" name="price" value="10000-{{$maxPrice}}" @if($valueFromRequest && $valueFromRequest['price'] === "10000-{$maxPrice}") checked @endif> от 10000</label>
                </div>
                <div class="flex flex-col ml-5 flex-auto">
                    <p class="font-medium">Категория</p>
                    @foreach($typeList as $key => $item)
                        <label for="checkbox_type_{{$key}}"><input id="checkbox_type_{{$key}}" type="checkbox" name="type[]" value="{{$item->type}}" @if($valueFromRequest && in_array($item->type, $valueFromRequest['type'])) checked @endif> {{$item->type}}</label>
                    @endforeach
                </div>
                <div class="flex flex-col ml-5 flex-auto">
                    <p class="font-medium">Удобства</p>
                    <div class="flex">
                        @foreach($facilitiesListByThree as $group)
                            <div class="flex flex-col">
                                @foreach($group as $facility)
                                    <label class="mr-2" for="checkbox_facility_{{$facility->id}}"><input id="checkbox_facility_{{$facility->id}}" type="checkbox" name="facilities[]" value="{{$facility->id}}" @if($valueFromRequest && in_array($facility->id, $valueFromRequest['facilities'])) checked @endif> {{$facility->title}}</label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" name="reset_filters" value="1" class="mr-2 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Сбросить фильтры
                </button>
                <button class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Показать результаты
                </button>
            </div>
        </form>
        @if(method_exists($hotels, 'links'))
            <div class="mb-5">
                {{$hotels->links()}}
            </div>
        @endif

        @if(count($hotels) !== 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($hotels as $hotel)
                    <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
                @endforeach
            </div>
        @else
            <div class="pt-8">
                <h1 class="text-lg md:text-xl font-semibold text-gray-800">Отели не найдены</h1>
            </div>
        @endif

        @if(method_exists($hotels, 'links'))
            <div class="mt-5">
                {{$hotels->links()}}
            </div>
        @endif
    </div>
</x-app-layout>
