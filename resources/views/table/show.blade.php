<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Table N° ".$table->id) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('tables.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div class="w-4/5 md:w-1/3 sm:w-1/2 xs:w-2/3 mx-auto my-4 p-4 rounded-lg flex flex-col justify-center border bg-white">
        <label class="text-center mt-2 mb-2">
            People: {{$table->people}}
        </label>

        <label class="text-center mb-2">
            Description: {{$table->description}}
        </label>

        <div class="mt-2">
            <label class="block">
                Orders:
            </label>
            @foreach($table->orders as $order)
                <div class="flex flex-col sm:flex-row text-center sm:text-left justify-evenly m-2 border-b-2 border-gray">
                    <label>
                        <a class="underline" href="/orders/{{$order->id}}">
                            Order N°: {{$order->id}}
                        </a>
                    </label>
                    <label>
                        Cost: ${{$order->total_cost}}
                    </label>
                </div>
            @endforeach
        </div>

        <form class="flex w-full px-2 mt-4 justify-between" action={{action("App\Http\Controllers\TableController@destroy", [$table->id])}} method="POST">
            @csrf
            @method('DELETE')

            @can('tables.edit')
                <a class="w-20 my-2 text-base text-indigo-600 hover:text-indigo-900 font-semibold whitespace-nowrap text-sm font-medium" href="/tables/{{$table->id}}/edit">Edit</a>
            @endcan

            @can('tables.destroy')
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" onclick="toggleModal('modal-id');">Delete</a>
            @endcan
            <x-confirmation-dialog></x-confirmation-dialog>
        </form>
    </div>
</x-app-layout>