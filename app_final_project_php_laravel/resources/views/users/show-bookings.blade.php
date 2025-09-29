<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h3 class="text-xl xl:text-2xl font-semibold leading-6 text-gray-800 bg-white p-4 mb-5">Бронирования пользователя: {{ $user->name }}</h3>
                @if($bookings->isNotEmpty())
                    @foreach($bookings as $booking)
                        <x-users.booking-card-user class="mb-4" :booking="$booking" :userId="$user->id"/>
                    @endforeach
                @else
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800">Нет бронирований</h1>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
