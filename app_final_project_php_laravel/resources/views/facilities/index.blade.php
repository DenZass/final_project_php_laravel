<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold mb-10">Список удобств</div>

            <div class="mb-5">
                <x-link-button class="bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-400" href="{{ route('facilities.showFormCreate') }}">Добавить удобство</x-link-button>
            </div>

            @if(isset($facilities) && count($facilities) !== 0)
                <table class="table-fixed">
                    <thead align="left">
                    <tr class="border-b">
                        <th class="pr-5">id</th>
                        <th class="w-4/5">Название удобства</th>
                        <th  >Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($facilities as $key => $facilitiy)
                        <tr class="border-b @if($key % 2 == 0) bg-white bg-opacity-40 @endif">
                            <td>{{$facilitiy->id}}</td>
                            <td>{{$facilitiy->title}}</td>
                            <td class="flex justify-around ">
                                <x-link-button class="mr-1.5 bg-red-600 hover:bg-red-500 active:bg-red-400" href="{{route('facilities.delete', ['id' => $facilitiy->id])}}">Удалить</x-link-button>
                                <x-link-button class="bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-400" href="{{route('facilities.showFormUpdate', ['id' => $facilitiy->id])}}">Редактировать</x-link-button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-xl text-center md:text-start font-bold">Удобства не найдены</div>
            @endif
        </div>
    </div>
</x-app-layout>
