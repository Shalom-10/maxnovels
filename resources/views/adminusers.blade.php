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
    <script src = 'scripts/adminuser.js' defer></script>
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
                        <span>New User</span>
                    </div>

                </div>

                <div class = 'top_right flex-row'>

                    <div class = 'search-box'>
                        <input type = 'text' name = 'search' placeholder="Type your search here..." onkeyup="user_search();">
                    </div>

                    <div class = 'filter'>
                        <select name = 'filter' onchange = 'user_search();'>
                            <option value = 'name'>Name</option>
                            <option value = 'email'>Email</option>
                            <option value = 'date'>Date</option>
                            <option value = 'age_greater_than'>Age Greater Than</option>
                            <option value = 'age_less_than'>Age Less Than</option>
                            <option value = 'age'>Age Equal to</option>
                            <option value = 'active'>Active</option>
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
                                email
                            </div>

                            <div class = 'item-title flex-center'>
                                Read
                            </div>

                            <div class = 'item-title flex-center'>
                                Action
                            </div>
        
                        </div>

                        <div class = 'shelf-books'>
                            @foreach($users as $user)
                            <div class = 'shelf-item'>

                                <div class = 'item-image ov-hidden p-rel'>
                                    <img src = '/images/avatars/{{$user->avatar}}' class = 'obj-fit'>
                                    @if(Cache::has('user-is-online-'. $user->id))
                                        <div class = 'is-online p-abs btm-right round' style = 'background: var(--electric); height: 10px; width: 10px;'></div>
                                    @endif
                                </div>

                                <div class = 'item-name flex-center'>
                                    {{$user->first_name}} {{$user->last_name}}
                                </div>

                                <div class = 'item-author flex-center'>
                                    {{$user->email}}
                                </div>

                                <div class = 'item-read flex-center'>
                                    {{$user->reads}}
                                </div>

                                <div class = 'item-action flex-center'>
                                    <div class = 'btn' onclick = 'moderate("{{$user->role}}", "{{$user->avatar}}", {{$user->id}}, this)'>
                                        Moderate
                                    </div>
                                </div>

                            </div>
                            @endforeach
                    
                            <div class = 'pagination p-2'>
                                {{ $users->links() }}
                            </div>
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


        <x-user_modal />
        <x-flash_card_sure />

</body>
<script>


function user_search() {
    let input = select('[name = "search"]').value;
    let filter = select('[name = "filter"]').value;

    activate_itm('.book_loading')
    deactivate_itm('.no-result');
    select('.shelf-books').innerHTML = ''
    console.log('shere');

    search(input, filter, '/adminuser_search', user_callback)
}

function user_callback(data) {
    console.log(data, 'here');
    deactivate_itm('.book_loading')
    if(data == '') activate_itm('.no-result');
    select('.shelf-books').innerHTML = data;

}
</script>

</html>