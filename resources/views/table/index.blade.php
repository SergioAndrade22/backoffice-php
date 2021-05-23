<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tables') }}
            </h2>
            <x-button>
                Add Table
            </x-button>
        </div>
    </x-slot>

    <table>
        <tr>
            <th>Number</th>
            <th>People</th>
            <th>Description</th>
        </tr>
        <tbody>
            @foreach ($tables as $table)
                <tr>
                    <td>{{$table->id}}</td>
                    <td>{{$table->people}}</td>
                    <td>{{$table->description}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>