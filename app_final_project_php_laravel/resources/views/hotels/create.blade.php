<x-app-layout>
    <div class="flex justify-center pt-7 pb-40">
        <form method="post" action="{{route('hotels.create')}}" class="w-3/6 space-y-5">
            <h2 class="text-2xl ">Создание отеля</h2>
            @csrf
            <div >
                <x-input-label for="title">title</x-input-label>
                <x-input class="w-full" id="title" name="title" value="{{old('title')}}" placeholder="Название отеля"></x-input>
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
{{--                @error('title')  @enderror--}}
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
                <x-input-label for="address">address</x-input-label>
                <x-textarea class="w-full" rows="" id="address" name="address" value="{{old('address')}}" placeholder="Адрес"></x-textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
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
