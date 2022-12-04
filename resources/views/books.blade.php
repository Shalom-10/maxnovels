<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel = 'stylesheet' href = '/styles/loader.css'><x-head /> 
    <script src = '/scripts/loader.js' defer></script>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel = 'stylesheet' href = '/styles/general.css'>
    <link rel = 'stylesheet' href = '/styles/variables.css'>
    <link rel = 'stylesheet' href = '/styles/btn.css'>
    <link rel = 'stylesheet' href = '/styles/card.css'>
    <link rel = 'stylesheet' href = '/styles/nav.css'>
    <link rel = 'stylesheet' href = '/styles/flash_card.css'>
    <link rel = 'stylesheet' href = '/styles/mode.css'>
    <link rel = 'stylesheet' href = '/styles/scroll.css'>
    <link rel = 'stylesheet' href = '/styles/books.css'>

    <script src = '/scripts/general.js' defer></script>
</head>
<body class = 'colors pixels'>
    <div class = 'wrapper'> <x-loader></x-loader>

        <x-navigation></x-navigation>

        <section class = 'book flex full-vw p-1'>

            <div class = 'left_content'>
                <h3 class = 'p-1 pointer' onclick = 'location.href = "/books"'>Categories</h3>

                @if(count($collections) > 0) 
                    @foreach ( $collections as $collection )
                        <div class = 'cat-item flex-row flex-between {{ isset($selected_collection) && $collection->name == $selected_collection ? 'active' : '' }}'
                             onclick = 'location.href = "/books/{{$collection->name}}";'>
                            <span>{{$collection->name}}</span>
                            <i class = 'bi bi-check-lg'></i>
                        </div>
                    @endforeach
                @endif
                {{-- <div class = 'cat-item flex-row flex-between p-1'>
                    <span>Action</span>
                    <i class = 'bi bi-check-lg'></i>
                </div>

                <div class = 'cat-item flex-row flex-between p-1'>
                    <span>Romance</span>
                    <i class = 'bi bi-check-lg'></i>
                </div>

                <div class = 'cat-item flex-row flex-between p-1'>
                    <span>Thriller</span>
                    <i class = 'bi bi-check-lg'></i>
                </div>

                <div class = 'cat-item flex-row flex-between p-1'>
                    <span>Romantic Suspense</span>
                    <i class = 'bi bi-check-lg'></i>
                </div> --}}
            </div>

            <div class = 'right_content'>
                <div class = 'top full-w flex-row flex-between p-1'>
                    
                    <div class = 'search ov-hidden '>
                        <input type = 'text' name = 'search' placeholder="Search for books here.." value = "{{ $search ?? ''}}">
                        
                    </div>

                    
                    <select name = 'filter' class = 'filter' value = "{{ $filter ?? ''}}">
                        <option selected disabled>Filtery By</option>
                        <option value = 'all'> All </option>
                        <option value = 'title'> Title </option>
                        <option value = 'category'> Category </option>
                        <option value = 'author' > Author </option>
                    </select>
                    
                    

                </div>

                <div class = 'categories'>
                    <x-scroll title=''>
                        <x-slot name='content'>

                            @if(count($collections) > 0) 
                                @foreach ( $collections as $collection )
                                    <div class = 'cat-item {{ isset($selected_collection) && $collection->name == $selected_collection ? 'active' : '' }}'
                                         onclick = 'location.href = "/books/{{$collection->name}}";'>
                                        <span>{{$collection->name}}</span>
                                    </div>
                                @endforeach
                            @endif

                            {{-- <div class = 'cat-item'>
                                <span>Suspense</span>
                            </div>

                            <div class = 'cat-item'>
                                <span>Romance</span>
                            </div>
                            
                            <div class = 'cat-item'>
                                <span>Romantic Suspense</span>
                            </div>

                            <div class = 'cat-item'>
                                <span>Science Fiction</span>
                            </div>

                            <div class = 'cat-item'>
                                <span>Thriller</span>
                            </div>

                            <div class = 'cat-item'>
                                <span>Dystopia</span>
                            </div>

                            <div class = 'cat-item'>
                                <span>Action</span>
                            </div> --}}
                            
                        </x-slot>
                    </x-scroll>
                </div>

                <div class = 'content p-rel'>

                    <x-book_list :books='$books' />

                    

                    {{-- <x-card></x-card>
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
                        title="The Time Traveler's handbook"
                    ></x-card> --}}

                    {{ $books->links() }}

                </div>
                

            </div>
        </section>
        

    </div>

    <x-mode></x-mode>

    @if (session()->has('signup'))
        <x-flash_card type='success' message='Registeration successfull, welcome to maxnovels, happy reading' />
        <?php session()->forget('signup'); ?>
    @endif

</body>
<x-search_script target='/booksearch' input='input[name = "search"]' output='.right_content .content'/>
<script>
    let selected_filter = document.querySelector('select[name = "filter"]').value = '{{ $filter ?? 'all' }}';
</script>
</html>