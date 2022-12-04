<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '/styles/loader.css'>
    <x-head /> <script src = '/scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/icon_btn.css'>
    <link rel = 'stylesheet' href = '/styles/btn.css'>
    <link rel = 'stylesheet' href = '/styles/flash_card.css'>
    <link rel = 'stylesheet' href = '/styles/writer.css'>

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/writer.js' defer></script>


    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    {{-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet"> --}}
    
</head>

<body class = 'colors pixels'>
    <x-loader></x-loader>

    <div class = 'wrapper'>

        <nav class = 'flex-row flex-between p-1'>

            <div class = 'flex-row'>

                <x-icon_btn icon='bi bi-chevron-left' onclick='location.href="/chapters/{{ $chapter->book_id }}";'></x-icon_btn>

                <h2>
                    The Time Traveler's Handbook
                </h2>

            </div>

            <div class = 'flex-row'>
                
                <div class = 'btn link'>
                    <span>Preview</span>
                </div>

                <div class = 'btn link' onclick = 'publish_preview();'>
                    <span>Publish</span>
                </div>

                <div class = 'btn link' onclick = 'delete_preview();'>
                    <span>Delete</span>
                </div>
            </div>
        </nav>


        <div class = 'title full-w'>
            <input type = 'text' name = 'title' placeholder='Type Your Chapter Title Here..' class = 'full-w p-1 text-center' value = '{{ $chapter->title ?? ''}}'>
        </div>

        <section>
    
            <div id = 'toolbar'></div>
            <div class = 'writer-box'>
            </div>

        </section>


    </div>

    <form method = 'POST' style = 'visibility: hidden;' action = '/writer/{{ $chapter->book_id }}/{{ $chapter->id }}'>
        @csrf
        <input type = 'text' name = 'chapter_content'>
        <input tyep = 'text' name = 'chapter_title'>
        <input tyep = 'text' name = 'type'>
    </form>

    <div class = 'btn link p-fix' onclick = 'save();'>
        <span>save</span>
    </div>

    <x-flash_card_sure />


</body>

<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
{{-- <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> --}}

<?php
    $get_data = json_decode($chapter->draft_content);

?>

<script>
    // var options = {
    //     debug: 'info',
    //     modules: {
    //         toolbar: '#toolbar'
    //     },
    //     placeholder: 'Compose an epic...',
    //     // readOnly: true,
    //     theme: 'snow'
    // };
    // var editor = new Quill('.writer-box', options);

    var toolbarOptions = [

        [ 'bold', 'italic', 'underline', 'strike', ],
        [{ 'script': 'super' }, { 'script': 'sub' }],
        [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
        [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
        [ {'direction': 'rtl'}, { 'align': [] }],
        [ 'link', 'image', 'video'],
        [ 'clean' ]

    ];

    var quill = new Quill('.writer-box', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Write something amazing...',
        theme: 'snow'
    });

    quill.format('color', 'white');

    let get_data = <?php echo json_encode($get_data) ?>;

    quill.setContents(get_data);


</script>

</html>