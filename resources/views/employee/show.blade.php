<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between flex-col xs:flex-row text-center xs:text-left">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($employee->first_name." ".$employee->last_name ) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight underline justify-center xs:justify-start" :href="route('employees.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div class="w-4/5 md:w-1/3 sm:w-1/2 xs:w-2/3 mx-auto my-4 p-4 rounded-lg flex flex-col justify-center border bg-white">
        <label class="text-center mt-2 mb-2">
            Username: {{$employee->user->name}}
        </label>

        <label class="text-center mb-2">
            Email: {{$employee->user->email}}
        </label>

        <label class="text-center mb-2">
            Position: {{$employee->getPositionAttribute()}}
        </label>

        <form class="flex w-full px-2 mt-4 justify-between" action={{action("App\Http\Controllers\EmployeeController@destroy", [$employee->id])}} method="POST">
            @csrf
            @method('DELETE')

            @can('employees.edit')
                <a class="w-20 my-2 text-base text-indigo-600 hover:text-indigo-900 font-semibold whitespace-nowrap text-sm font-medium" href="/employees/{{$employee->id}}/edit">Edit</a>
            @endcan

            @can('employees.destroy')
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" onclick="toggleModal('modal-id');">Delete</a>
            @endcan
            <x-confirmation-dialog></x-confirmation-dialog>
        </form>
    </div>
</x-app-layout>