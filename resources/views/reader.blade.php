<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel = 'stylesheet' href = '/styles/loader.css'>
    <x-head /> <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/reader.css'>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/signup.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader></x-loader>

    <div class = 'wrapper flex-row full-w'>


        <div class = 'left full-hw p-1 z-5'>
            <div class = 'left-top flex-col flex-center p-rel'>
                <div class = 'image-box round ov-hidden'>
                    <img src = '/images/avatars/{{auth()->user()->avatar}}' class = 'obj-fit'>
                </div>

                <div class = 'name'>
                    <span>{{$book->authors ?? $book->author->first_name . ' ' . $book->author->last_name}}</span>
                </div>

                <div class = 'close-btn p-abs top-right flex-center' onclick = 'toggle_itm(".wrapper");'>
                    <i class = 'bi bi-x-lg'></i>
                </div>
            </div>

            <div class = 'menu-box'>
                @foreach($book->chapters->where('state', 'published') as $chapterr)
                <div class = 'menu-item flex-row {{$chapter->title == $chapterr->title? 'active' : ''}}' onclick = 'location.href = "/reader/{{$book->id}}/{{$chapterr->order}}"'>

                    <div class = 'icon flex-center'>
                        <i class = 'bi bi-box'></i>
                    </div>

                    <div class = 'name'>
                        <span>{{$chapterr->title}}</span>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        <div class = 'right full-hw'>
            <div class = 'top-bar full-w p-1 flex-between'>
                <div class = 'flex-row'>
                    <div class = 'menu-btn flex-center' onclick = 'toggle_itm(".wrapper");'>
                        <i class = 'bi bi-list'></i>
                    </div>

                    <div class = 'book-title'>
                        <h2>{{$book->title}}</h2>
                    </div>
                </div>

                <div>
                    <div class = 'menu-btn flex-center bookmark {{ $bookmark ? 'active' : ''}}' onclick = 'bookmarker();'>
                        <i class = 'bi bi-bookmark'></i>
                    </div>
                </div>

                
            </div>

            <div class = 'content full-w p-2'>
                <div class = 'title text-center'>
                    <h1>{{$chapter->title}}</h1>
                </div>

                <div class = 'reader-slate'>
                    @for($i = 0; $i < 10; $i++)
                    <div class = 'reader-item'>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur incidunt eius quisquam perferendis! Aliquid, ad asperiores sint ratione recusandae, fugiat blanditiis eius eaque sapiente quis iste. Quos fugiat laborum architecto ad vitae eum voluptates itaque optio, beatae natus doloribus! Dicta beatae mollitia natus consectetur sit explicabo in excepturi deserunt dolor?
                        </p>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class = 'controls p-fix flex-row'>
            <div class = 'menu-btn flex-center' onclick = 'location.href = "/reader/{{$book->id}}/{{$next}}";'>
                <i class = 'bi bi-chevron-left'></i>
            </div>
            <div class = 'menu-btn flex-center' onclick = 'location.href = "/reader/{{$book->id}}/{{$prev}}";'>
                <i class = 'bi bi-chevron-right'></i>
            </div>
        </div>
    </div>

</body>

<?php
    $get_data = json_decode($chapter->draft_content);

?>

<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
{{-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> --}}

<script>


    var quill = new Quill('.reader-slate', {
        readOnly: true,
        theme: 'bubble'
    });

    quill.format('color', 'white');

    let get_data = <?php echo json_encode($get_data) ?>;

    quill.setContents(get_data);

    let bookmark = false;

    function bookmarker() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: bookmark? '/unbookmark' : '/bookmark',
            data: {'user_id': {{ auth()->user()->id }}, 'chapter_id': {{ $chapter->id }}, 'book_id': {{ $book->id }}},
            success: (data) => {
                console.log(data);
                if(data.response == true) document.querySelector('.bookmark').classList.toggle('active');
            }
        })
    }
</script>

</html>