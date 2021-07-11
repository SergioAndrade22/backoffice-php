<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Family Size Restaurant')
                <img src="{{asset('img/logo.png')}}" class="logo" alt="Family Size Logo">
            @else
                {{$slot}}
            @endif
        </a>
    </td>
</tr>
