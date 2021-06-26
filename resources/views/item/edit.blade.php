<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between flex-col xs:flex-row text-center xs:text-left">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Item edition") }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight underline justify-center xs:justify-start" :href="route('items.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <form class="flex pt-8 h-screen items-start justify-center" action="/items/{{$item->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid bg-white rounded-lg shadow-xl w-full md:w-3/4 lg:w-1/2">
            <div class="flex justify-center mt-2 sm:mt-5 p-2 sm:p-0 sm:mx-7">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Item Data</h1>
                </div>
            </div>
        
            <div class="grid grid-cols-1 sm:mt-5 p-2 sm:p-0 sm:mx-7">
                <label for="name" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Name</label>
                <input id="name" name="name" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Name" aria-label="Item Name" value="{{$item->name}}" />
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 sm:mt-5 p-2 sm:p-0 sm:mx-7">
                <div class="grid grid-cols-1">
                    <label for="cuisine" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cuisine</label>
                    <input id="cuisine" name="cuisine" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Cuisine" aria-label="Item Cuisine" value="{{$item->cuisine}}"/>
                </div>

                <div class="grid grid-cols-1">
                    <label for="cost" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Cost</label>
                    <input id="cost" name="cost" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Cost" aria-label="Item Cost" value="{{$item->cost}}"/>
                </div>
            </div>

            <div id="radio-inputs" class="flex flex-col sm:flex-row justify-between sm:mt-5 p-2 sm:p-0 sm:mx-7">
                <label class="inline my-1 sm:my-0 text-center uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Is vegetarian?
                    <input type="checkbox" id="is_vege" name="is_vege" class="mr-2 text-purple-300 rounded" {{$item->is_vege ? "checked" : ""}}/>
                </label>

                <label class="inline my-1 sm:my-0 text-center uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Is vegan?
                    <input type="checkbox" id="is_vegan" name="is_vegan" class="mr-2 text-purple-300 rounded" {{$item->is_vegan ? "checked" : ""}}/>
                </label>

                <label class="inline my-1 sm:my-0 text-center uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Is coeliac?
                    <input type="checkbox" id="is_coeliac" name="is_coeliac" class="mr-2 text-purple-300 rounded" {{$item->is_coeliac ? "checked" : ""}}/>
                </label>

                <label class="inline my-1 sm:my-0 text-center uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                    Has alcohol?
                    <input type="checkbox" id="has_alcohol" name="has_alcohol" class="mr-2 text-purple-300 rounded" {{$item->has_alcohol ? "checked" : ""}}/>
                </label>
            </div>
        
            <div id="picture_container" class="grid grid-cols-1 sm:mt-5 p-2 sm:p-0 sm:mx-7">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">
                    Upload Picture {{$item->picture != null ? "- Already loaded" : ""}}
                </label>
                
                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>

                        <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>Select a picture</p>
                    </div>

                    <input id="picture" name="picture" type='file' accept="image/png, image/jpeg, image/jpg" class="hidden"/>
                </label>
            </div>
        
            <div class="flex justify-between items-center">
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" href="/items/{{$item->id}}">Cancel</a>

                <button type="submit" class='w-auto m-4 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Accept</button>
            </div>      
        </div>
      </form>
</x-app-layout>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
    $('#picture')[0].addEventListener('change', (event) => {
        $('#picture_container')[0].append(`Succesfully uploaded!`);
    });
</script>