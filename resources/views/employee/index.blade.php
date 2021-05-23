<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>
            <x-button>
                Add Employee
            </x-button>
        </div>
    </x-slot>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        <a class="hover:border-gray-300" href="/employees/{{$employee->id}}">{{$employee->first_name}}</a>
                    </td>

                    <td>
                        {{$employee->last_name}}
                    </td>

                    <td>
                        {{$employee->username}}
                    </td>

                    <td>
                        {{$employee->getRoleAttribute()}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>