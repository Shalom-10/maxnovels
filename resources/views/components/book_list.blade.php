@props(['books', 'location' => 'library'])

@if(count($books) > 0)
@foreach ($books as $book)

    @if (gettype($book->author) == 'NULL')
        <x-card
            image='/images/cover_images/{{ $book->cover_image}}'
            title='{{$book->title}}'
            author='Anonymous'
            onclick="location.href = '/preview/{{$book->id}}'"
        >
        </x-card>
    @else

        <x-card
            image='/images/cover_images/{{ $book->cover_image}}'
            title='{{$book->title}}'
            author='{{$book->authors ?? $book->author->first_name . " " .  $book->author->last_name }}'
            onclick="location.href = '/preview/{{$book->id}}'"
        >
        </x-card>

    @endif
@endforeach

@else

<div class = 'not_found p-abs flex-col flex-center'>
    <div class = 'image'>
        <i class = 'bi bi-emoji-frown-fill'></i>
    </div>
    <p>Search not found</p>
</div>

@endif

@if ($location == 'library')
    <div class = 'book_loading p-abs full-hw top-left flex-center'>
        <div class = 'image'></div>
    </div>
@endif
