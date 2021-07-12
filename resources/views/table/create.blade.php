<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between flex-col xs:flex-row text-center xs:text-left">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Table Creation") }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight underline justify-center xs:justify-start" :href="route('tables.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <form class="flex pt-8 h-screen items-start justify-center" action="/tables" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            <div class="flex justify-center mt-5">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Table Data</h1>
                </div>
            </div>

            <x-auth-validation-errors class="m-4" :errors="$errors" />

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label for="people" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">People</label>
                <input id="people" name="people" value="{{old('people')}}" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="People" aria-label="Item People" required/>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label for="description" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Description</label>
                <input id="description" name="description" value="{{old('description')}}" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Description" aria-label="Item Description" required/>
            </div>

            <div class="flex justify-between items-center">
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" href="/tables/">Cancel</a>

                <button type="submit" class='w-auto m-4 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Accept</button>
            </div>
        </div>
      </form>
</x-app-layout>