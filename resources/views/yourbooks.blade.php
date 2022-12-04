<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel = 'stylesheet' href = 'styles/loader.css'><x-head /> <script src = 'scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel = 'stylesheet' href = 'styles/variables.css'>
    <link rel = 'stylesheet' href = 'styles/nav.css'>
    <link rel = 'stylesheet' href = 'styles/btn.css'>
    <link rel = 'stylesheet' href = 'styles/flash_card.css'>
    <link rel = 'stylesheet' href = 'styles/footer.css'>
    <link rel = 'stylesheet' href = 'styles/collections.css'>
    <link rel = 'stylesheet' href = 'styles/yourbooks.css'>

    <script src = 'scripts/general.js' defer></script>
</head>
<body class = 'colors pixels'>
    <div class = 'wrapper'> <x-loader></x-loader>
        <x-navigation></x-navigation>
        <?php
            $avatar = true;
            $editable = true;
        ?>
        <x-short_header title="<h1 class = 'h2'>Your <span>Books</span></h1>" :avatar='$avatar' :editable='$editable'></x-short_header>

        <div class = 'search_box flex-center'>
            <div class ='search ov-hidden'>
                <input type = 'text' name = 'search' placeholder="Search your collection..." onkeyup = 'search_yourbooks();'>
                <button>
                    <span>Search</span>
                    <i class = 'bi bi-search'></i>
                </button>
            </div>
        </div>

        <div class = 'add-btn-box full-w'>
            <div class = 'add-btn text-center' onclick = 'location.href = "/writeform"'>
                <span>Add New</span>
                <i class = 'bi bi-plus'></i>
            </div>
        </div>

        <div class = 'writer-card-box p-rel' >


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

            <div class = 'links '>
                {{ $books->links() }}
            </div>

        </div>

        <div class = 'no-result full-w p-3 flex-center flex-col'>
            <div class = 'icon'>
                <i class = 'bi bi-emoji-frown'></i>
            </div>
            
            <p class = 'text-center'>
                Oops, no result for your search..
            </p>
        </div>

        <div class = 'book_loading flex-center'>
            <div class = 'image'></div>
        </div>

        <x-footer></x-footer>

        <x-mode></x-mode>

    </div>
</body>

<script>
    function search_yourbooks() {
        input = select('[name = "search"]');
        output = select('.writer-card-box');
        search = input.value;

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        activate_itm('.book_loading')
        deactivate_itm('.no-result');
        output.innerHTML = '';
    
        $.ajax({
            method: 'GET',
            url: '/search_your_books',
            data: {'search': search,},
            success: (data) => {
                deactivate_itm('.book_loading')
                if(data == '') activate_itm('.no-result');
                console.log(data);
                output.innerHTML = data;
            }
        })

    }
</script>
</html>