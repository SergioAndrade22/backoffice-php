<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Items') }}
            </h2>
            <x-link-button href="{{url('/items/create')}}">
                Add Item
            </x-link-button>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 gap-6 justify-center justify-items-center mt-4 md:mx-16 mx-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
        @foreach ($items as $item)
        <a href="/items/{{$item->id}}" class="hover:border-gray-300">
            <div class="relative bg-white py-3 rounded-3xl w-64 shadow-xl text-center justify-center">
                <div class="h-full grid grid-cols-1 grid-rows-8 justify-center justify-items-center">
                    <p class="text-xl font-semibold my-2">{{$item->name}}</p>

                    <div class="flex space-x-2 text-gray-400 text-sm justify-center ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p>{{$item->cuisine}}</p> 
                    </div>

                    <div class="flex space-x-2 text-gray-900 text-sm my-3 w-5/6 justify-center border-b-2">
                            <p>Vegetarian: {{$item->is_vege ? 'Yes' : 'No'}}</p> 
                    </div>

                    <div class="flex space-x-2 text-gray-900 text-sm my-3 w-5/6 justify-center border-b-2">
                        <p>Vegan: {{$item->is_vegan ? 'Yes' : 'No'}}</p> 
                    </div>

                    <div class="flex space-x-2 text-gray-900 text-sm my-3 w-5/6 justify-center border-b-2">
                        <p>Coeliac: {{$item->is_coeliac ? 'Yes' : 'No'}}</p> 
                    </div>

                    <div class="flex space-x-2 text-gray-900 text-sm my-3 w-5/6 justify-center border-b-2">
                        <p>Alcohol: {{$item->has_alcohol ? 'Yes' : 'No'}}</p> 
                    </div>

                    <div class="flex space-x-2 text-gray-900 text-sm my-3 w-5/6 justify-center border-b-2">
                        <p>Cost: {{$item->cost}}</p> 
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    @if ($message = Session::get('success'))
        <x-success-toast>
            {{$message}}
        </x-success-toast>
    @endif

    @if ($message = Session::get('error'))
        <x-error-toast>
            {{$message}}
        </x-error-toast>
    @endif

</x-app-layout>