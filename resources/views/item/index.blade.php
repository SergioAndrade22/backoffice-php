<x-app-layout>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Cost</th>
                </tr>
            </thead>            
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->cost}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>
</x-app-layout>