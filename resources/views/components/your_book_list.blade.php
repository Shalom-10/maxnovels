@props([
    'books' => []
])

@if(count($books) > 0)

@foreach($books as $book)
    <div class = 'writer_card' onclick = 'location.href = "/chapters/{{$book->id}}"'>
        <div class = 'image ov-hidden p-rel'>
            <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>
            <div class = 'details p-abs btm-left full-w'>
                <h4 class = 'full-hw flex-center text-center'>{{ $book->title}}</h4>
            </div>
        </div>
        <div class = 'btn-case flex-row full-w ov-hidden'>
            <div class = 'card-btn flex-center'>
                <span>Continue Writing</span>
            </div>
            <div class = 'card-btn flex-center'>
                <i class = 'bi bi-trash3'></i>
            </div>
        </div>
    </div>
@endforeach
<div class = 'links full-w' style = 'bottom: -20px; grid-column: 1/-1;'>
    {{ $books->links() }}
</div>
@else


@endif

