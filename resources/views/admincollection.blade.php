<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name = 'csrf-token' content = '{{ csrf_token() }}'>
    <link rel = 'stylesheet' href = 'styles/loader.css'><x-head /> <script src = 'scripts/loader.js' defer></script>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel = 'stylesheet' href = 'styles/variables.css'>
    <link rel = 'stylesheet' href = 'styles/btn.css'>
    <link rel = 'stylesheet' href = 'styles/icon_btn.css'>
    <link rel = 'stylesheet' href = 'styles/card.css'>
    <link rel = 'stylesheet' href = 'styles/nav.css'>
    <link rel = 'stylesheet' href = 'styles/mode.css'>
    <link rel = 'stylesheet' href = 'styles/modal.css'>
    <link rel = 'stylesheet' href = 'styles/flash_card.css'>
    <link rel = 'stylesheet' href = 'styles/scroll.css'>
    <link rel = 'stylesheet' href = 'styles/admin.css'>
    <link rel = 'stylesheet' href = 'styles/adminbooks.css'>

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    
    <script src = 'scripts/general.js' defer></script>
    <script src = 'scripts/collections.js' defer></script>
</head>

<body class = 'colors pixels'>

    <x-loader></x-loader>

    <div class = 'wrapper'>
<x-admin_menu />
        <div class = 'right_c full-w'>

            <div class = 'top flex-row flex-between'>
                <x-icon_btn icon='bi bi-list' onclick='toggle_itm(".left_c");'></x-icon_btn>
            </div>

            <div class = 'shelf_top flex-row flex-between p-2'>

                <div class = 'top_left'>

                    <div class = 'btn'>
                        <span>New Category</span>
                    </div>

                </div>

                <div class = 'top_right flex-row'>

                    <div class = 'search-box'>
                        <input type = 'text' name = 'search' placeholder="Type your search here..." onkeyup="collection_search()">
                    </div>

                    <div class = 'filter' onchange='collection_search();' name='filter'>
                        <select>
                            <option value = 'name'>Name</option>
                            <option value = 'book'>Book Name</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class = 'sh-c-box'>
                <div class = 'shelf full-w'>
                    
                    <div class = 'shelf_box p-rel'>
                        
                        <div class = 'shelf-item topp p-abs top-left full-w'>

                            <div class = 'item-title flex-center'>
                                Image
                            </div>
        
                            <div class = 'item-title flex-center'>
                                Name
                            </div>
        
                            <div class = 'item-title flex-center'>
                                Books
                            </div>

                            <div class = 'item-title flex-center'>
                                Read
                            </div>

                            <div class = 'item-title flex-center'>
                                Action
                            </div>
        
                        </div>


                        <div class = 'shelf-books'>
                            @foreach($collections as $collection)
                            <div class = 'shelf-item'>

                                <div class = 'item-image ov-hidden'>
                                    <img src = '/images/collections/{{ $collection->image }}' class = 'obj-fit'>
                                </div>

                                <div class = 'item-name flex-center'>
                                    {{$collection->name}}
                                </div>

                                <div class = 'item-author flex-center'>
                                    {{$collection->books}}
                                </div>

                                <div class = 'item-read flex-center'>
                                    {{$collection->reads}}
                                </div>

                                <div class = 'item-action flex-center'>
                                    <div class = 'btn' onclick = 'moderate("{{$collection->name}}", "{{$collection->image}}", {{$collection->id}}, this)'>
                                        Moderate
                                    </div>
                                </div>

                            </div>
                            @endforeach

                            <div class = 'pagination p-2'>
                                {{ $collections->links() }}
                            </div>
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
                </div>
            </div>





        </div>
    </div>

    <x-modal />
    <x-flash_card_sure />

</body>
<script>


    function collection_search() {
        let input = select('[name = "search"]').value;
        let filter = select('[name = "filter"]').value;

        activate_itm('.book_loading')
        deactivate_itm('.no-result');
        select('.shelf-books').innerHTML = ''
        console.log('shere');

        search(input, filter, '/admincollection_search', collection_callback)
    }

    function collection_callback(data) {
        console.log(data, 'here');
        deactivate_itm('.book_loading')
        if(data == '') activate_itm('.no-result');
        select('.shelf-books').innerHTML = data;

    }
</script>

</html>