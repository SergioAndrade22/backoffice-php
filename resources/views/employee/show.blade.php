<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($employee->first_name." ".$employee->last_name ) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('employees.index')">Back to list</x-nav-link>
        </div>
    </x-slot>
</x-app-layout>