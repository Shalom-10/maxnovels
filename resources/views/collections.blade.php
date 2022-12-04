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
    <link rel = 'stylesheet' href = 'styles/mode.css'>
    <link rel = 'stylesheet' href = 'styles/flash_card.css'>
    <link rel = 'stylesheet' href = 'styles/footer.css'>
    <link rel = 'stylesheet' href = 'styles/collections.css'>

    <script src = 'scripts/general.js' defer></script>
</head>
<body class = 'colors pixels'>
    <div class = 'wrapper'> <x-loader></x-loader>
        <x-navigation></x-navigation>
        <x-short_header></x-short_header>

        <div class = 'search_box flex-center'>
            <div class ='search ov-hidden'>
                <input type = 'text' name = 'search' placeholder="Search our collection..." onkeyup = 'search_collection();'>
                <button onclick = 'search_collection();'>
                    <span>Search</span>
                    <i class = 'bi bi-search'></i>
                </button>
            </div>
        </div>

        <section class = 'collection-box p-rel'>

            @if(count($collections) > 0)

                @foreach ($collections as $collection)
                    
                    <div class = 'large_card ov-hidden p-rel pointer' onclick = 'location.href = "/books/{{$collection->name}}";'>
                        <div class = 'image'>
                            <img src = '/images/collections/{{ $collection->image }}' class = 'obj-fit'>
                        </div>
                        <div class = 'details p-abs btm-left full-w'>
                            <h2>{{$collection->name}}</h2>
                            <div class = 'flex-row'>
                                <div class = 'icon flex-center round ov-hidden'>
                                    <img src = '/images/book.png' class = 'obj-fit'>
                                </div>

                                <span>{{$collection->books}}</span>
                                

                            </div>
                        </div>
                    </div>

                @endforeach

                <div class = 'links full-w' style = 'bottom: -20px; grid-column: 1/-1;'>
                    {{ $collections->links() }}
                </div>

            @endif



        </section>

        <div class = 'no-result full-w p-3 flex-center flex-col '>
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

    function search_collection() {
        input = select('[name = "search"]');
        output = select('.collection-box');
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
            url: '/search_collection',
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