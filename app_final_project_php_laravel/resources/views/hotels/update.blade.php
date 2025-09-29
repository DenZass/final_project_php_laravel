<x-app-layout>
    <div class="flex justify-center pt-7 pb-40">
        <form method="post" action="{{route('hotels.update', ['id' => $hotel->id])}}" class="w-3/6 space-y-5">
            <h2 class="text-2xl ">Редактирование отеля</h2>
            @csrf
            <div >
                <x-input-label for="id">id</x-input-label>
                <x-input class="w-full" id="id" name="id" value="{{old('id') ?? $hotel->id}}" disabled="disabled"></x-input>
                <x-input-error :messages="$errors->get('id')" class="mt-1" />
            </div>
            <div >
                <x-input-label for="created_at">created_at</x-input-label>
                <x-input class="w-full" id="created_at" name="created_at" value="{{old('created_at') ?? $hotel->created_at}}" disabled="disabled"></x-input>
                <x-input-error :messages="$errors->get('created_at')" class="mt-1" />
            </div>
            <div >
                <x-input-label for="updated_at">updated_at</x-input-label>
                <x-input class="w-full" id="updated_at" name="updated_at" value="{{old('updated_at') ?? $hotel->updated_at}}" disabled="disabled"></x-input>
                <x-input-error :messages="$errors->get('updated_at')" class="mt-1" />
            </div>
            <div >
                <x-input-label for="title">title</x-input-label>
                <x-input class="w-full" id="title" name="title" value="{{old('title') ?? $hotel->title}}"></x-input>
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="description">description</x-input-label>
                <x-textarea class="w-full" rows="5" id="description" name="description" value="{{old('description') ?? $hotel->description}}"></x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="poster_url">poster_url</x-input-label>
                <x-textarea class="w-full" rows="3" id="poster_url" name="poster_url" value="{{old('poster_url') ?? $hotel->poster_url}}"></x-textarea>
                <x-input-error :messages="$errors->get('poster_url')" class="mt-1" />
            </div>
            <div>
                <x-input-label for="address">address</x-input-label>
                <x-textarea class="w-full" rows="" id="address" name="address" value="{{old('address') ?? $hotel->address}}"></x-textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>
            <div>

                <x-input-label>facilities</x-input-label>
                <div class="flex flex-col">
                    @foreach($facilityFullList as $facility)
                        <label for="faciliti_{{$facility->id}}">
                            <input type="checkbox" name="facilities[]" id="faciliti_{{$facility->id}}" value="{{$facility->id}}"
                                   @if(gettype(old('facilities')) === 'array' && in_array($facility->id, old('facilities'))) checked
                                   @elseif(gettype(old('facilities')) !== 'array' && in_array($facility->id, $haveFacilitiesIdArray)) checked
                                   @endif
                            > {{$facility->title}}</label>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('title')" class="mt-1" />
            </div>
            <div class="flex justify-end">
                <x-the-button>Сохранить</x-the-button>
            </div>
        </form>
    </div>
</x-app-layout>
