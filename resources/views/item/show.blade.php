<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($item->name) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('items.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div>
        <label style="display:block;">
            Cuisine: {{$item->cuisine}}
        </label>

        <label style="display:block;">
            Cost: {{$item->cost}}
        </label>

        <label style="display:block;">
            Is vege: {{$item->is_vege ? 'Yes' : 'No'}}
        </label>

        <label style="display:block;">
            Is vegan: {{$item->is_vegan ? 'Yes' : 'No'}}
        </label>

        <label style="display:block;">
            Is Coeliac: {{$item->is_coeliac ? 'Yes' : 'No'}}
        </label>

        <label style="display:block;">
            Has alcohol: {{$item->has_alcohol ? 'Yes' : 'No'}}
        </label>
    </div>
</x-app-layout>