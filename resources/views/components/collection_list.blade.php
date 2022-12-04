@props([
    'collections' => []
])

@if(count($collections) > 0)

@foreach ($collections as $collection)
    <div class = 'large_card ov-hidden p-rel' onclick = 'location.href = "/books/{{$collection->name}}";'>
        <div class = 'image'>
            <img src = '/images/collections/{{ $collection->image }}' class = 'obj-fit'>
        </div>
        <div class = 'details p-abs btm-left full-w'>
            <h2>{{$collection->name}}</h2>
            <div class = 'flex-row'>
                <div class = 'icon flex-center round ov-hidden'>
                    <img src = '/images/book.png' class = 'obj-fit'>
                </div>

                <span>{{$collection->reads}}</span>
                 
            </div>
        </div>
    </div>
@endforeach
<div class = 'links full-w' style = 'bottom: -20px; grid-column: 1/-1;'>
    {{ $collections->links() }}
</div>
@else


@endif

