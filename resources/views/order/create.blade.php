<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-between flex-col xs:flex-row text-center xs:text-left">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Order Creation") }}
            </h2>

            <x-nav-link class="font-semibold text-xl text-gray-800 leading-tight underline justify-center xs:justify-start" :href="route('orders.index')">Back to list</x-nav-link>
        </div>
    </x-slot>

    <form class="flex pt-8 h-screen items-start justify-center overflow-auto" action="/orders" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            <div class="flex justify-center mt-5">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Order Data</h1>
                </div>
            </div>

            <x-auth-validation-errors class="m-4" :errors="$errors" />

            <div class="grid grid-cols-1 justify-items-center mt-2">
                <div class="w-7/8 xs:w-full px-2 justify-center inline-flex">
                    <select id="table_id" name="table_id" value="{{old('table_id')}}" class="w-full border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" required>
                        <optgroup label="Select a Table">
                            @foreach ($tables as $table)
                                <option class="uppercase" value="{{$table->id}}">{{$table->id.": ".strtoupper($table->description)}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row w-full sm:w-3/4 justify-between mx-auto mt-4 items-baseline">
                <div class="w-full sm:w-auto px-2">
                    <label for="autocomplete" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Select Items:</label>
                    <input id="autocomplete" class="w-full sm:w-auto px-3 rounded-lg border-2 border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text">
                </div>

                <button class="mx-2 mt-2 sm:m-0 rounded-lg border-2 border-purple-300 text-purple-300 focus:outline-none focus:ring-2 h-fit p-1" type="button" onclick="addItem()">
                    Add Item
                </button>
            </div>

            <div id="table-container" class="flex flex-col w-full pt-2 mx-auto overflow-auto">
                <table id="item-container" class="table-auto text-center divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th colspan="2" class="px-4 py-3 text-s font-medium tracking-widest text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">Id</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">Amount</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">Actions</th>
                            <th class="px-4 py-3 text-xs font-medium tracking-widest text-gray-500 uppercase">Total Cost</th>
                        </tr>
                    </thead>
                    <tbody id="item-container-body">
                        @if (old('items'))
                            @foreach(old('items') as $key=>$item)
                                <tr id="{{$key.'-name'}}">
                                    <td colspan="2" class="px-4 py-4 whitespace-nowrap text-left"><button class="rounded-full leading-3 p-1 text-center bg-red-400" type="button" onclick="remove('{{$key.'-name'}}')">-</button> <label>{{$key}}</label></td>
                                    <td class="px-4 py-4 whitespace-nowrap"><input class="text-right outline-none" name="items[{{$item['id']}}][id]" value="{{$item['id']}}" readonly/></td>
                                    <td class="text-right px-4 py-4 whitespace-nowrap"><input class="text-right outline-none" id="{{$key.'-name'.'-amount'}}" name="items[{{$item['id']}}][amount]" value="{{$item['amount']}}" readonly/></td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex justify-between">
                                            <button class="rounded-full leading-3 p-1 text-center bg-gray-100 outline-none" type="button" onclick="substractAmount('{{$key.'-name'}}', {{$item['cost']/$item['amount']}})">-</button>
                                            <button class="rounded-full leading-3 p-1 text-center bg-gray-100 outline-none" type="button" onclick="addAmount('{{$key.'-name'}}', {{$item['cost']/$item['amount']}})">+</button>
                                        </div>
                                    </td>
                                    <td class="text-right px-4 py-4 whitespace-nowrap"><input class="text-right outline none" id="{{$key.'-name'.'-cost'}}" name="items[{{$item['id']}}][cost]" value="{{$item['cost']}}" readonly/></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-between items-center">
                <a class="w-20 my-2 text-base text-red-600 hover:text-red-900 text-right font-semibold whitespace-nowrap text-sm font-medium cursor-pointer" href="/orders/">Cancel</a>

                <button type="submit" class='w-auto m-4 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Accept</button>
            </div>
        </div>
      </form>
</x-app-layout>

<script type="text/javascript">
    var items;

    $.ajax({
        url: "/api/items/autocomplete",
        type: "GET",
        dataType: 'json'
    }).done(data => {
        this.items = data;
        $('#autocomplete').autocomplete({
            source: data.map(item => item.name)
        });
        document.querySelectorAll('tbody>tr').forEach(tableRow => {
            this.items.forEach(item => {
                if (item.id == tableRow.id.split('-')[0])
                    tableRow.firstElementChild.lastElementChild.innerText = item.name;
            })
        });
    });

    function addItem() {
        var item;
        for(item$ of items) {
            if (item$.name === $('#autocomplete')[0].value)
                item = item$;
        }
        $('#item-container-body').append(
            `<tr id="${item.name.split(' ')[0]}">
                <td colspan="2" class="px-4 py-4 whitespace-nowrap text-left"><button class="rounded-full leading-3 p-1 text-center bg-red-400" type="button" onclick="remove('${item.name.split(' ')[0]}')">-</button> ${item.name}</td>
                <td class="px-4 py-4 whitespace-nowrap"><input class="text-right outline-none" name="items[${item.id}][id]" value="${item.id}" readonly/></td>
                <td class="text-right px-4 py-4 whitespace-nowrap"><input class="text-right outline-none" id="${item.name.split(' ')[0]+'-amount'}" name="items[${item.id}][amount]" value="1" readonly/></td>
                <td class="px-4 py-4 whitespace-nowrap">
                    <div class="flex justify-between">
                        <button class="rounded-full leading-3 p-1 text-center bg-gray-100 outline-none" type="button" onclick="substractAmount('${item.name.split(' ')[0]}', ${item.cost})">-</button>
                        <button class="rounded-full leading-3 p-1 text-center bg-gray-100 outline-none" type="button" onclick="addAmount('${item.name.split(' ')[0]}', ${item.cost})">+</button>
                    </div>
                </td>
                <td class="text-right px-4 py-4 whitespace-nowrap"><input class="text-right outline none" id="${item.name.split(' ')[0]+'-cost'}" name="items[${item.id}][cost]" value="${item.cost}" readonly/></td>
            </tr>`  
        );
    }

    function remove(itemName) {
        $('#'+itemName).remove();
    }

    function addAmount(itemName, itemCost) {
        var amountInput = $('#'+itemName+'-amount')[0];
        var amountValue = parseInt(amountInput.value);

        var costInput = $('#'+itemName+'-cost')[0];
        var costValue = parseInt(costInput.value);

        costInput.value = itemCost * (++amountValue);
        amountInput.value = amountValue;
    }

    function substractAmount(itemName, itemCost) {
        var amountInput = $('#'+itemName+'-amount')[0];
        var amountValue = parseInt(amountInput.value);

        var costInput = $('#'+itemName+'-cost')[0];
        if (amountValue > 1){
            costInput.value = itemCost * (--amountValue);
            amountInput.value = amountValue;
        }
    }
</script>