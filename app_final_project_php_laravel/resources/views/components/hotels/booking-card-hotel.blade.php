<div {{ $attributes->merge(['class' => 'flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8']) }}>
    <div class="flex flex-col justify-start items-start bg-gray-50 px-4 py-4 md:px-6 xl:px-8 w-full">
        <div class="flex justify-between w-full py-2 border-b border-gray-200">
            <div class="w-full flex flex-row justify-between">
                <div>
                    <p class="text-lg md:text-xl font-semibold leading-6 xl:leading-5 text-gray-800">Бронирование
                        #{{ $booking->id }}</p>
                    <p class="text-base font-medium leading-6 text-gray-600 ">{{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:space-x-6 w-full">
            <div class="pb-4 w-full md:w-2/5">
                <img class="w-full block" src="{{ \App\Models\Room::find($booking->room_id)->poster_url }}" alt="image"/>
            </div>
            <div
                class="md:flex-row flex-col flex justify-between items-start w-full md:w-3/5 pb-8 space-y-4 md:space-y-0">
                <div class="w-full flex flex-col justify-start items-start space-y-8">
                    <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800">{{ \App\Models\Room::find($booking->room_id)->title }}</h3>

                    <div class="flex justify-start items-start flex-col space-y-2">
                        <p class="text-sm leading-none text-gray-800"><span>Даты: </span>
                            {{ \Carbon\Carbon::parse($booking->started_at)->format('d.m.Y') }}
                            по
                            {{ \Carbon\Carbon::parse($booking->finished_at)->format('d.m.Y') }}</p>
                        <p class="text-sm leading-none text-gray-800"><span>Кол-во ночей: </span> {{ $booking->days }}</p>
                        <p></p>
                        <p></p>
                        <p class="text-sm leading-none text-gray-800"><strong>Пользователь: </strong> {{ \App\Models\User::find($booking->user_id)->name}}</p>
                        <p class="text-sm leading-none text-gray-800">id пользователя: {{ $booking->user_id }}</p>
                        <p class="text-sm leading-none text-gray-800"><span>id отеля: </span> {{ $hotelId }}</p>
                        <p class="text-sm leading-none text-gray-800"><span>id комнаты: </span> {{ $booking->room_id }}</p>

                    </div>
                </div>
                <div class="flex justify-end space-x-8 items-end w-full">
                    <p class="text-base xl:text-lg font-semibold leading-6 text-gray-800 whitespace-nowrap">
                        Стоимость: {{ $booking->price }} руб</p>
                </div>
            </div>

        </div>
        <div class="flex justify-end w-full relative">
            <x-link-button class="mr-1.5 bg-red-600 hover:bg-red-500 active:bg-red-400 absolute bottom-4" href="{{ route('hotels.deleteBooking', ['hotelId'=>$hotelId, 'bookId'=>$booking->id]) }}">Удалить бронирование</x-link-button>
        </div>
    </div>
</div>
