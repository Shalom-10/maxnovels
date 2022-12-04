
@foreach($books as $book)
<div class = 'shelf-item'>

    <div class = 'item-image ov-hidden'>
        <img src = '/images/cover_images/{{$book->cover_image}}' class = 'obj-fit'>
    </div>

    <div class = 'item-name flex-center'>
        {{$book->title}}
    </div>

    <div class = 'item-author flex-center'>
        @if (gettype($book->author) == 'NULL')
            Anonymous
        @else
            {{$book->authors ?? $book->author->first_name . " " . $book->author->last_name}}
        @endif
    </div>

    <div class = 'item-read flex-center'>
        {{$book->reads}}
    </div>

    <div class = 'item-action flex-center'>
        <div class = 'btn' onclick = 'moderate({{$book->id}}, this)'>
            Moderate
        </div>
    </div>

</div>
@endforeach
@if (count($books) > 0)
    <div class = 'pagination p-2'>
        {{ $books->links() }}
    </div>
@endif