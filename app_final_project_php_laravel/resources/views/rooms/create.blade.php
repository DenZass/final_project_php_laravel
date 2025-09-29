@php
    $typeList7878 = \Illuminate\Support\Facades\DB::select('select distinct type from rooms;');
    $resultTypesListArr = [];
    foreach ($typeList7878 as $item){
        $resultTypesListArr[] = $item->type;
    }
    $typesInString = implode(', ', $resultTypesListArr);
    $typesPlaceholder = "Типы: $typesInString";
@endphp
<x-app-layout>
    <div class="flex justify-center pt-7 pb-40">
        <form method="post" action="{{route('rooms.create', ['hotelId'=>$hotelId])}}" class="w-3/6 space-y-5">
            <h2 class="text-2xl ">Создание комнаты</h2>
            @csrf
            <div >
                <x-input-label for="hotel_id">hotel_id</x-input-label>
                <x-input class="w-full" id="hotel_id" name="hotel_id" value="{{$hotelId}}" disabled="disabled"></x-input>
                <x-input-error :messages="$errors->get('hotel_id')" class="mt-1" />
            </div>
            <div >
                <x-input-label for="title">title</x-input-label>
                <x-input class="w-full" id="title" name="title" value="{{old('title')}}" placeholder="Название комнаты"></x-input>
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="description">description</x-input-label>
                <x-textarea class="w-full" rows="5" id="description" name="description" value="{{old('description')}}" placeholder="Описание"></x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="poster_url">poster_url</x-input-label>
                <x-textarea class="w-full" rows="3" id="poster_url" name="poster_url" value="{{old('poster_url')}}" placeholder="Ссылка на изображение"></x-textarea>
                <x-input-error :messages="$errors->get('poster_url')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="floor_area">floor_area</x-input-label>
                <x-input class="w-full" id="floor_area" name="floor_area" value="{{old('floor_area')}}" placeholder="Размер конмнаты кв/м"></x-input>
                <x-input-error :messages="$errors->get('floor_area')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="type">type</x-input-label>
                <x-input class="w-full" id="type" name="type" value="{{old('type')}}" placeholder="{{$typesPlaceholder}}"></x-input>
                <x-input-error :messages="$errors->get('type')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="price">price</x-input-label>
                <x-input class="w-full" id="price" name="price" value="{{old('price')}}" placeholder="Цена за сутки"></x-input>
                <x-input-error :messages="$errors->get('price')" class="mt-1" />
            </div>
            <div>

                <x-input-label>facilities</x-input-label>
                <div class="flex flex-col">
                    @foreach($facilityFullList as $facility)
                        <label for="faciliti_{{$facility->id}}"><input type="checkbox" name="facilities[]" id="faciliti_{{$facility->id}}" value="{{$facility->id}}" @if(gettype(old('facilities')) === 'array' && in_array($facility->id, old('facilities'))) checked @endif> {{$facility->title}}</label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('facilities')" class="mt-1" />
            </div>
            <div class="flex justify-end">
                <x-the-button>Сохранить</x-the-button>
            </div>
        </form>
    </div>
</x-app-layout>
