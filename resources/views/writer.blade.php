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
    <link rel = 'stylesheet' href = '/styles/writer.css'>

    <script src = '/scripts/general.js' defer></script>
    <script src = '/scripts/writer.js' defer></script>
</head>

<body class = 'colors pixels'>
    <x-loader></x-loader>

    <div class = 'wrapper'>

        <nav class = 'flex-row flex-between p-1'>

            <div class = 'flex-row'>
                <x-icon_btn icon='bi bi-chevron-left'></x-icon_btn>

                <h2>
                    The Time Traveler's Handbook
                </h2>

            </div>

            <div class = 'flex-row'>
                <div class = 'btn'>
                    <span>Publish</span>
                </div>

                <div class = 'btn'>
                    <span>Preview</span>
                </div>
            </div>
        </nav>

        <section>

            <div class = 'title full-w'>
                <input type = 'text' name = 'title' placeholder='Type Your Chapter Title Here..' class = 'full-w p-1 text-center' value = '{{ $chapter->title ?? ''}}'>
            </div>
    
            <div class = 'writer-box'>
                <div class = 'written-content'></div>
                <textarea name = 'writer' class = 'full-w' placeholder="Begin your text here..." onkeydown="create_item(event, 1);"></textarea>
            </div>

        </section>

        <div class = 'tool-box p-fix flex-col flex-center'>

            <div class = 'tool flex-center'>
                <i class = 'bi bi-camera'></i>
            </div>

            <div class = 'tool flex-center'>
                <i class = 'bi bi-camera-video'></i>
            </div>

        </div>

    </div>

</body>

</html>