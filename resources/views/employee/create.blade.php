<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Employee Creation") }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('employees.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <form class="flex pt-8 h-screen items-start justify-center" action="/employees" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            <div class="flex justify-center mt-5">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Employee Data</h1>
                </div>
            </div>
        
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label for="first_name" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">First Name</label>
                    <input id="first_name" name="first_name" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="First Name" aria-label="Employee first name"/>
                </div>

                <div class="grid grid-cols-1">
                    <label for="last_name" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Last Name</label>
                    <input id="last_name" name="last_name" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Last Name" aria-label="Employee last name"/>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1 justify-items-center">
                    <div class="w-2/3 justify-center inline-flex">
                        <select id="position" name="position" class="w-full border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                            <optgroup label="Select a Position">
                                @foreach ($positions as $key => $value)
                                    <option class="uppercase" value="{{$key}}">{{strtoupper($value)}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 justify-items-center">
                    <div class="w-2/3 justify-center inline-flex">
                        <select id="user" name="user" class="w-full border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                            <optgroup label="Select a User">
                                @foreach ($users as $user)
                                    <option class="uppercase" value="{{$user}}">{{strtoupper($user->name)}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" href="/employees/">Cancel</a>

                <button type="submit" class='w-auto m-4 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Save changes</button>
            </div>      
        </div>
      </form>
</x-app-layout>