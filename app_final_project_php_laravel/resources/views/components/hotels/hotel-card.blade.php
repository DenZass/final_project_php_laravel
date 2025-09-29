<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="{{ route('hotels.show', ['id' => $hotel->id]) }}">{{ $hotel->title }}</a>
            <div class="text-xs">
                {{ $hotel->id }} {{ $hotel->address }}
            </div>
        </div>
        @if($hotel->rooms()->min('price'))
            <div class="pt-2">
                <span class="text-2xl text-grey-darkest">₽{{ $hotel->rooms()->min('price') }}</span>
                <span class="text-lg"> за ночь</span>
            </div>
        @endif
        @if($hotel->facilities->isNotEmpty())
            <div class="flex items-center py-2">
                @foreach($hotel->facilities->take(2) as $facility)
                    <div class="pr-2 text-xs">
                        <span>•</span> {{ $facility->title }}
                    </div>
                @endforeach
            </div>
        @endif
        <div class="flex justify-end">
            <x-link-button href="{{ route('hotels.show', ['id'=>$hotel->id]) }}">Подробнее</x-link-button>
        </div>
        @can('admin')
            <div class="flex justify-end mt-1.5">
                <x-link-button class="mr-1.5 bg-red-600 hover:bg-red-500 active:bg-red-400" href="{{ route('hotels.delete', $hotel->id) }}">Удалить</x-link-button>
                <x-link-button class="bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-400" href="{{ route('hotels.update', ['id' => $hotel->id]) }}">Редактировать</x-link-button>
            </div>
        @endcan
    </div>
</div>
