<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Orders') }}
            </h2>
            <x-button>
                Add Order
            </x-button>
        </div>
    </x-slot>

    <table>
        <tr>
            <th>Number</th>
            <th>Total Cost</th>
            <th>Items</th>            
        </tr>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="/orders/{{$order->id}}">{{$order->id}}</a>
                    </td>

                    <td>
                        {{$order->total_cost}}
                    </td>

                    <td>
                        {{$order->items}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>