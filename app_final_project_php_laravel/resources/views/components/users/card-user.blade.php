<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <p class="block text-grey-darkest mb-2 font-bold">{{ $user->name }}</p>
            <div class="text-xs">
                id - {{ $user->id }}
            </div>
            <div class="text-xs">
                email - {{ $user->email }}
            </div>
            <div class="text-xs">
                created_at - {{ $user->created_at }}
            </div>
            <div class="text-xs">
                updated_at - {{ $user->updated_at }}
            </div>
            <div class="text-xs">
                role - {{ $user->role->title }}
            </div>
            <div class="text-xs">
                bookings - {{ count($user->bookings) }}
            </div>
        </div>
        <div class="flex justify-end">
            <x-link-button href="{{ route('users.showBookings', ['id'=>$user->id]) }}">Бронирования</x-link-button>
        </div>
    </div>
</div>
