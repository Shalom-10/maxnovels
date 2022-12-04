<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel = 'stylesheet' href = '/styles/footer.css'>
    <link rel = 'stylesheet' href = '/styles/home.css'>

    <script src = '/scripts/general.js' defer></script>
</head>
<body class = 'colors pixels'>
    <div class = 'wrapper'> <x-loader></x-loader>
        <x-navigation></x-navigation>
        <x-header></x-header>

        @if(count($books) > 0)
        <x-scroll>
            <x-slot name='content'>
                <x-book_list :books='$books' location='home'/>

                <x-card></x-card>
                <x-card
                    image='/images/book_cover_1.jpeg'
                ></x-card>
                <x-card
                    image='/images/book_cover_5.jpeg'
                ></x-card>
                <x-card
                    image='/images/book_cover_6.jpg'
                ></x-card>
                <x-card
                    image='/images/book_cover_8.jpg'
                ></x-card>
                <x-card
                    image='/images/book_cover_2.jpg'
                ></x-card>
            </x-slot>
        </x-scroll>
        @endif

        <x-grid_4></x-grid_4>

        <x-banner></x-banner>

        
        <x-footer></x-footer>

        <div class = 'mode-btn flex-center p-fix round' onclick = 'toggle_itm("html", "lightmode");'>
            <i class = 'bi bi-sun-fill'></i>
            <i class = 'bi bi-moon-fill'></i>
        </div>

    </div>
</body>
</html>