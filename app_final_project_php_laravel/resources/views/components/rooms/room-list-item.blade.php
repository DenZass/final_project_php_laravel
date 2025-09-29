<div {{ $attributes->merge(['class' => 'flex flex-col md:flex-row shadow-md']) }}>
    <div class="h-full w-full md:w-2/5">
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url({{ $room->poster_url }})">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between">
        <div class="pb-2">
            <div class="text-xl font-bold mb-2">
                {{ $room->id }} {{ $room->title }}
            </div>
            <div class="mb-2">
                {{ $room->description }}
            </div>
            <div class="mb-2">
                <span>Размер комнаты -</span> {{ $room->floor_area }} м
            </div>
            <div class="mb-2">
                <span>Тип комнаты -</span> {{ $room->type }}
            </div>
            <div>
                @foreach($room->facilities as $facility)
                    <p>• {{ $facility->title }} </p>
                @endforeach
            </div>
        </div>
        @can('admin')
            <div>
                <x-link-button class="bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-400" href="{{ route('rooms.showFormUpdate', ['hotelId' => $room->hotel->id, 'roomId' => $room->id]) }}"> Редактировать</x-link-button>
                <x-link-button class="bg-red-600 hover:bg-red-500 active:bg-red-400" href="{{ route('rooms.delete', ['hotelId' => $room->hotel->id, 'roomId' => $room->id]) }}"> Удалить</x-link-button>
            </div>
        @endcan
        <hr class="mt-2">
        <div class="flex justify-end pt-2">
            <div class="flex flex-col">
                <span class="text-lg font-bold">{{ $room->price }} руб.</span>
                <span>за ночь</span>
            </div>
            <form class="ml-4" method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <input type="hidden" name="started_at" value="{{ request()->get('start_date', \Carbon\Carbon::now()->format('d-m-Y')) }}">
                <input type="hidden" name="finished_at" value="{{ request()->get('end_date', \Carbon\Carbon::now()->format('d-m-Y')) }}">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="price" value="{{ $room->price }}">
                @if(!$adminRead)
                    <x-the-button class=" h-full w-full">{{ __('Book') }}</x-the-button>
                @endif
            </form>
        </div>
    </div>
</div>
