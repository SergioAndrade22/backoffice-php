<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between flex-col xs:flex-row text-center xs:text-left">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tables') }}
            </h2>

            @can('tables.create')
                <x-link-button class="justify-center xs:justify-start" href="{{url('/tables/create')}}">
                    Add Table
                </x-link-button>
            @endcan
        </div>
    </x-slot>

    <div class="flex flex-col w-full pt-2 px-2 mx-auto overflow-auto">
        <table class="table-auto text-center divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-s font-medium tracking-widest text-gray-500 uppercase">
                        Number
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        People
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        Description
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($tables as $table)
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center text-sm font-medium text-gray-900 justify-center">
                            <a class="hover:border-gray-300 underline" href="/tables/{{$table->id}}">{{$table->id}}</a>
                        </div>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{$table->people}}</div>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{$table->description}}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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