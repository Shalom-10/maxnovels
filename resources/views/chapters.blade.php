<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel = 'stylesheet' href = '/styles/loader.css'><x-head /> <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/nav.css'>
    <link rel = 'stylesheet' href = '/styles/btn.css'>
    <link rel = 'stylesheet' href = '/styles/header.css'>
    <link rel = 'stylesheet' href = '/styles/scroll.css'>
    <link rel = 'stylesheet' href = '/styles/card.css'>
    <link rel = 'stylesheet' href = '/styles/grid_4.css'>
    <link rel = 'stylesheet' href = '/styles/banner.css'>
    <link rel = 'stylesheet' href = '/styles/mode.css'>
    <link rel = 'stylesheet' href = '/styles/flash_card.css'>
    <link rel = 'stylesheet' href = '/styles/footer.css'>
    <link rel = 'stylesheet' href = '/styles/chapters.css'>

    <script src = '/scripts/general.js' defer></script>
    

</head>
<body class = 'colors pixels'>
    <div class = 'wrapper'> <x-loader></x-loader>
        <x-navigation></x-navigation>

        <div class = 'btn-case flex-row'>

            <div class = 'btn' onclick = 'location.href = "/writer/{{$book_id}}/new"'>
                <span>Add New</span>
            </div>

            <div class = 'btn' onclick = 'location.href = "/writeform/{{$book_id}}"'>
                <span>Book Details</span>
            </div>

            <div class = 'btn' onclick = 'publish();'>
                <span> Publish All</span>
            </div>
            
        </div>

        <form method = 'POST' style = 'visibility: hidden' class = 'publish-form'>
            @csrf
        </form>

        <section class = 'chapter-list' onchange='sort_chapters();' book = '{{$book_id}}'>
            @foreach($chapters as $chapter)
            <div class = 'chapter flex-row' order='{{$chapter->order}}' onclick="location.href = '/writer/{{$book_id}}/{{$chapter->id}}'">
                <div class = 'icon'>
                    <i class = 'bi bi-box'></i>
                </div>
                <div class = 'content full-w'>
                    <div class = 'title'>
                        <h3>{{ $chapter->title }}</h3>
                    </div>

                    <div class = 'state flex-row flex-between full-w'>
                        <span>{{ $chapter->state . $chapter->order }}</span>
                        <span>{{ $chapter->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

    </div>

    <x-flash_card_sure />
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

<script>
    let list = document.querySelector('.chapter-list');
    let sortable = new Sortable(list, {
        animation: 400,
    });

    function sort_chapters() {

        let book_id = document.querySelector('.chapter-list').getAttribute('book');
        let chapters = document.querySelectorAll('.chapter');
        let chapters_size = chapters.length - 1;
        let count = 0;

        let order_list = '';

        chapters.forEach( chapter => {
            order_list += chapter.getAttribute('order');

            if(count < chapters_size) {
                order_list += ',';
            }

            count++
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/sortchapters',
            data: {'book_id': book_id, 'chapters': order_list},
            success: (data) => {
                console.log(data);
            }
        })
    }

    function publish() {
        activate_itm('.flash-case.sure');
        flash_card_trigger('You are about to publish all draft work in your chapters are you sure you want to do this?', '', 'select(".publish-form").submit();');
    }
</script>
</html>