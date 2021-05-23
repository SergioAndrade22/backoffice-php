<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Order N° ".$order->id) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('orders.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div>
        <label for="" style="display:block;">
            <a href="/tables/{{$order->table->id}}">
                Table: {{$order->table->id}}
            </a>
        </label>

        <label for="" style="display:block;">
            Cost: ${{$order->total_cost}}
        </label>

        <ul>
            @foreach($order->items as $item)
                <li>
                    <a href="/items/{{$item->id}}">
                        {{$item->name}} : {{$item->pivot->amount}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>