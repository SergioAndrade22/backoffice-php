<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Table N° ".$table->id) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('tables.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div>
        @foreach($table->orders as $order)
            <div>
                <label style="display: block;">
                    <a href="/orders/{{$order->id}}">
                        Order N°: {{$order->id}}
                    </a>
                </label>
                <label style="display: block;">
                    Cost: ${{$order->total_cost}}
                </label>
            </div>
        @endforeach
    </div>
</x-app-layout>