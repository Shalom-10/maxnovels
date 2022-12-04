
@foreach($collections as $collection)
<div class = 'shelf-item'>

    <div class = 'item-image ov-hidden'>
        <img src = '/images/collections/{{ $collection->image }}' class = 'obj-fit'>
    </div>

    <div class = 'item-name flex-center'>
        {{$collection->name}}
    </div>

    <div class = 'item-author flex-center'>
        {{$collection->books}}
    </div>

    <div class = 'item-read flex-center'>
        {{$collection->reads}}
    </div>

    <div class = 'item-action flex-center'>
        <div class = 'btn' onclick = 'moderate("{{$collection->name}}", "{{$collection->image}}", {{$collection->id}}, this);'>
            Moderate
        </div>
    </div>

</div>
@endforeach
@if (count($collections) > 0)
    <div class = 'pagination p-2'>
        {{ $collections->links() }}
    </div>
@endif