@props(['label', 'value'])
<div>
    <span style="font-weight: bold">{{$label}}</span>

    @if($slot->isNotEmpty())
        {{$slot}}
    @else
        &nbsp;{{$value}}
    @endif

</div>
