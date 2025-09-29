@php
  if(isset(request()->start_date) && isset(request()->end_date)){
   $startDate = request()->get('start_date', \Carbon\Carbon::now()->format('Y-m-d'));
   $endDate = request()->get('end_date', \Carbon\Carbon::now()->addDay()->format('Y-m-d'));
}
@endphp

<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ $hotel->poster_url }}" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4 ">
                <div class="text-2xl font-bold mb-1">{{ $hotel->title }}</div>
                <div class="flex items-center mb-2">
                    {{ $hotel->address }}
                </div>
                <div class="mb-2">{{ $hotel->description }}</div>
                <div>
                    @if(isset($hotel->facilities))
                        @foreach($hotel->facilities as $facility)
                            <p><span>•</span> {{ $facility->title }}</p>
                        @endforeach
                        <p></p>
                    @endif
                </div>
            </div>
        </div>
        @can('admin')
            <div class="flex justify-end relative">
                <div class="absolute bottom-12">
                    <x-link-button class="bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-400" href="{{ route('rooms.create', ['hotelId' => $hotel->id]) }}">Добавить комнату</x-link-button>
                    <x-link-button class="bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-400" href="{{ route('hotels.update', ['id' => $hotel->id]) }}">Редактировать отель</x-link-button>
                    <x-link-button  href="{{ route('hotels.showBookings', ['id'=>$hotel->id]) }}">Посмотреть бронирования</x-link-button>
                </div>

            </div>
        @endcan
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <form method="get" action="{{ url()->current() }}">
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDate ?? \Carbon\Carbon::now()->format('Y-m-d') }}"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDate ?? \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
            @if((isset($startDate) && isset($endDate)))
                <div class="flex flex-col w-full lg:w-4/5">
                    @foreach($rooms as $room)
                        <x-rooms.room-list-item :room="$room" class="mb-4"/>
                    @endforeach
                </div>
            @elseif(Auth::user()->can('admin'))
                <div class="flex flex-col w-full lg:w-4/5">
                    @foreach($rooms as $room)
                        <x-rooms.room-list-item :room="$room" :adminRead="true"  class="mb-4"/>
                    @endforeach
                </div>
            @else
                <div></div>
            @endif
        </div>
    </div>
</x-app-layout>
