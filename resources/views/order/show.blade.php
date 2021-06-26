<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Order N° ".$order->id) }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight" :href="route('orders.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <div class="w-3/4 md:w-1/2 lg:w-1/4 m-4 p-4 rounded-lg flex flex-col justify-center my-4 mx-auto border bg-white">
        <label class="text-center mt-2 mb-2">
            <a href="/tables/{{$order->table->id}}">
                Table: {{$order->table->id}}
            </a>
        </label>

        <label class="text-center mb-2">
            Cost: ${{$order->total_cost}}
        </label>

        <div class="mt-2 mx-auto">
            <label class="block">
                Items:
            </label>
            @foreach($order->items as $item)
                <div class="flex flex-col sm:flex-row text-center sm:text-left m-2 border-b-2 border-gray  justify-between">
                    <label>
                        <a class="underline px-2" href="/items/{{$item->id}}">
                            {{$item->name}}
                        </a>
                    </label>
                    <label class="px-2">
                        Amount: {{$item->pivot->amount}}
                    </label>
                </div>
            @endforeach
        </div>

        <form class="flex w-full px-2 mt-4 justify-between" action={{action("App\Http\Controllers\OrderController@destroy", [$order->id])}} method="POST">
            @csrf
            @method('DELETE')
            <a class="w-20 my-2 text-base text-indigo-600 hover:text-indigo-900 font-semibold whitespace-nowrap text-sm font-medium" href="/orders/{{$order->id}}/edit">Edit</a>

            <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" onclick="toggleModal('modal-id');">Delete</a>

            <x-confirmation-dialog></x-confirmation-dialog>
        </form>
    </div>
</x-app-layout>