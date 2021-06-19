<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>

            <x-link-button href="{{url('/employees/create')}}">
                Add Employee
            </x-link-button>
        </div>
    </x-slot>

    <div class="flex flex-col w-full pt-2 px-2 mx-auto">
        <table class="table-auto text-center divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-s font-medium tracking-widest text-gray-500 uppercase">
                        First Name
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        Last Name
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        Username
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        Position
                    </th>

                    <th scope="col" class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">
                        Email
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($employees as $employee)
                <tr>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center text-sm font-medium text-gray-900 justify-center">
                            <a class="hover:border-gray-300" href="/employees/{{$employee->id}}">{{$employee->first_name}}</a>
                        </div>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{$employee->last_name}}</div>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap">
                        <span class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{$employee->user->name}}
                        </span>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="text-sm text-gray-900">
                            {{$employee->getPositionAttribute()}}
                        </div>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="text-sm text-gray-900">
                            {{$employee->user->email}}
                        </div>
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
