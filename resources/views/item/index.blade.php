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

    @if ($message = Session::get('success'))
        <div id="toast" class="relative flex items-center bg-green-500 border-l-4 border-green-700 py-2 px-3 shadow-md mb-2">
            <!-- close button -->
            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50" onclick="hideToast()">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>
            <!-- icons -->
            <div class="text-green-500 rounded-full bg-white mr-3">
                <svg width="1.8em" height="1.8em" viewBox="0 0 16 16" class="bi bi-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                </svg>
            </div>
            <!-- message -->
            <div class="text-white max-w-xs ">
                {{$message}}
            </div>
        </div>
    @endif

    <div class="flex items-center justify-center">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
            @foreach ($items as $item)
            <a href="/items/{{$item->id}}" class="hover:border-gray-300">
                <div class="relative bg-white py-3 px-3 rounded-3xl w-64 shadow-xl text-center justify-center">
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
    </div>
</x-app-layout>

<script>
    const hideToast = (evt) => {
        document.getElementById('toast').style.display = 'none';
    }
</script>