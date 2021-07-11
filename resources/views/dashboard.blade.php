<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count(Auth::user()->getRoleNames()) != 0)
                        Welcome back <span class="capitalize">{{ Auth::user()->name }}!</span>
                    @else
                        You still have no role assigned, contact your manager or sysadmin!
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('error'))
        <x-error-toast>
            {{$message}}
        </x-error-toast>
    @endif
</x-app-layout>
