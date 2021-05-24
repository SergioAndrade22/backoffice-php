<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($item->name) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('items.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div class="w-full flex flex-col justify-center my-4 mx-auto bg-white">
        <label class="text-center mt-2 mb-2">
            Cuisine: {{$item->cuisine}}
        </label>

        <label class="text-center mb-2">
            Cost: {{$item->cost}}
        </label>

        <label class="text-center mb-2">
            Is vege: {{$item->is_vege ? 'Yes' : 'No'}}
        </label>

        <label class="text-center mb-2">
            Is vegan: {{$item->is_vegan ? 'Yes' : 'No'}}
        </label>

        <label class="text-center mb-2">
            Is Coeliac: {{$item->is_coeliac ? 'Yes' : 'No'}}
        </label>

        <label class="text-center mb-2">
            Has alcohol: {{$item->has_alcohol ? 'Yes' : 'No'}}
        </label>

        @if ($item->picture)
            <img class='h-auto md:w-1/5 w-2/3 mb-2 mx-auto rounded-lg' src='data:image/jpeg;base64,{{$item->picture}}'  alt='Item picture'>
        @else
            <img class='h-auto md:w-1/5 w-2/3 mb-2 mx-auto rounded-lg' src='{{asset('img/no-picture.png')}}'  alt='No picture'>
        @endif

        <form class="flex w-full px-2 justify-between" action={{action("App\Http\Controllers\ItemController@destroy", [$item->id])}} method="POST" onsubmit="return toggleModal('modal-id');">
            @csrf
            @method('DELETE')
            <a class="w-20 my-2 text-base text-indigo-600 hover:text-indigo-900 font-semibold whitespace-nowrap text-sm font-medium" href="/items/{{$item->id}}/edit">Edit</a>

            <x-button>
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 font-semibold whitespace-nowrap text-sm font-medium">Delete</a>
            </x-button>
        </form>
    </div>

    <x-confirmation-dialog></x-confirmation-dialog>
    
</x-app-layout>
