<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '/styles/loader.css'>
    <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/icon_btn.css'>
    <link rel = 'stylesheet' href = '/styles/btn.css'>
    <link rel = 'stylesheet' href = '/styles/scroll.css'>
    <link rel = 'stylesheet' href = '/styles/card.css'>
    <link rel = 'stylesheet' href = '/styles/nav.css'>
    <link rel = 'stylesheet' href = '/styles/preview.css'>

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/signup.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader></x-loader>

    <div class = 'wrapper'>
        <x-navigation></x-navigation>
        <header>
            <div class = 'left full-hw p-2 flex-col-center'>
                <h1>
                    {{$book->title}}
                </h1>

                <p>
                    {{$book->description}}
                </p>

                <small>By <span>{{$book->authors ?? $book->author->first_name . ' ' . $book->author->last_name}}</span> </small>
                
                <div class = 'btn' onclick = 'location.href = "/reader/{{$book->id}}"'>
                    <span>Start Reading</span>
                </div>

            </div>
            <div class = 'right full-hw p-rel'>
                <div class = 'book-case p-abs ov-hidden z-2'>
                    <img src = '/images/book_cover_5.jpeg' class = 'obj-fit'>
                </div>
            </div>
        </header>

        
            <section>
                @if (count($related_books) > 0)
                <x-scroll title="<span>Related</span> Reads">
                    <x-slot name='content'>
                        <x-book_list :books='$related_books' />
                    </x-slot>
                </x-scroll>
                @endif
            </section>

        <x-footer></x-footer>
    </div>
</body>

</html>