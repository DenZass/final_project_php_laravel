<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="text-2xl text-center md:text-start font-bold mb-5">Список пользователей</div>
        <div class="mb-5">
            {{$users->links()}}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($users as $user)
                <x-users.card-user :user="$user"></x-users.card-user>
            @endforeach
        </div>
        <div class="mt-5">
            {{$users->links()}}
        </div>
    </div>
</x-app-layout>
