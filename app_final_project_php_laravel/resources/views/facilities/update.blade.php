<x-app-layout>
    <div class="flex justify-center pt-7 pb-40">
        <form method="post" action="{{route('facilities.update', ['id'=> $facility->id])}}" class="w-3/6 space-y-5">
            <h2 class="text-2xl ">Редактирование удобства</h2>
            @csrf
            <div>
                <x-input-label for="title">title</x-input-label>
                <x-textarea class="w-full pl-1" rows="3" id="title" name="title" value="{{$facility->title}}" placeholder="Введтите текст"></x-textarea>
            </div>

            <div class="flex justify-end">
                <x-the-button>Сохранить</x-the-button>
            </div>
        </form>
    </div>
</x-app-layout>
