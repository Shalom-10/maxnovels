<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel = 'stylesheet' href = 'styles/loader.css'>
    <x-head /> <script src = 'scripts/loader.js' defer></script>

    <link rel = 'stylesheet' href = 'styles/general.css'>
    <link rel = 'stylesheet' href = 'styles/variables.css'>
    <link rel = 'stylesheet' href = 'styles/btn.css'>
    <link rel = 'stylesheet' href = 'styles/icon_btn.css'>
    <link rel = 'stylesheet' href = 'styles/card.css'>
    <link rel = 'stylesheet' href = 'styles/nav.css'>
    <link rel = 'stylesheet' href = 'styles/mode.css'>
    <link rel = 'stylesheet' href = 'styles/scroll.css'>
    <link rel = 'stylesheet' href = 'styles/admin.css'>
    <link rel = 'stylesheet' href = 'styles/adminhome.css'>

    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    
    <script src = 'scripts/general.js' defer></script>
</head>

<body class = 'colors pixels'>

    <x-loader></x-loader>
    <x-search_script />

    <div class = 'wrapper'>
<x-admin_menu />
        <div class = 'right_c full-w'>

            <div class = 'top flex-row flex-between'>
                <x-icon_btn icon='bi bi-list' onclick='toggle_itm(".left_c");'></x-icon_btn>
            </div>

            <div class = 'rounded_stat'>
               
                <div>
                    <div class = 'card-content flex-center flex-col full-hw'>
                        <span>
                            {{$total_users}}
                        </span>
                        <div class = 'desc'>
                            Number of users
                        </div>
                    </div>
                </div>

                <div>
                    <div class = 'card-content flex-center flex-col full-hw'>
                        <span>
                            {{$total_books}}
                        </span>
                        <div class = 'desc'>
                            Number of Books
                        </div>
                    </div>
                </div>

                <div>
                    <div class = 'card-content flex-center flex-col full-hw'>
                        <span>
                            {{$total_authors}}
                        </span>
                        <div class = 'desc'>
                            Number of Authors
                        </div>
                    </div>
                </div>

                <div>
                    <div class = 'card-content flex-center flex-col full-hw'>
                        <span>
                            {{$total_reads}}
                        </span>
                        <div class = 'desc'>
                            Number of Reads
                        </div>
                    </div>
                </div>
            </div>
            
            <section class = 'activity'>
                
                <div class = 'active_user'>
                    <div class = 'active_top flex-row flex-between'>
                        <div>
                            <span>Active Users</span>
                        </div>

                        <div>
                            <div class = 'btn'>
                                <span>View All</span>
                            </div>
                        </div>
                    </div>

                    <div class = 'active_content'>
                        <?php $users_online = false; ?>

                        @foreach($users as $user)
                            @if(Cache::has('user-is-online-'. $user->id))
                                <div class = 'active_item flex-row p-1'>
                                    <div class = 'icon round p-rel'>
                                        <img src = '/images/avatar.jpeg' class = 'obj-fit round'>
                                    </div>
                                    <div class = 'name'>
                                        <span>{{$user->first_name}} {{$user->last_name}}</span>
                                    </div>
                                    <?php $users_online = true; ?>
                                </div>
                            @endif
                        @endforeach

                        @if(!$users_online) 

                            <div class = 'no-users p-abs top-left full-hw flex-center flex-col'>
                                <div class = 'icon'>
                                    <i class = 'bi bi-person'></i>
                                </div>
                                <span>No active User</span>
                            </div>

                        @endif

                    </div>
                </div>

                <div class = 'active_user'>
                    
                    <div class = 'active_top p-1' style = 'padding: .87rem 1rem'>
                        <div>
                            <span>Genre Statistics</span>
                        </div>
                    </div>
                    <div class = 'active_content flex-center' 
                    style = 'padding: 0;
                             height: 88%;'
                    >
                        <canvas id = 'pie' class = 'full-hw'></canvas>
                    </div>
                </div>



            </section>

            <div class = 'contents full-w'>
                <x-scroll>
                    <x-slot name='content'>
                    
                        @foreach($books as $book)

                            @if (gettype($book->author) == 'NULL')
                                <x-card
                                    image='/images/cover_images/{{ $book->cover_image}}'
                                    title='{{$book->title}}'
                                    author='Anonymous'
                                >
                                </x-card>
                            @else

                            <x-card
                                image='/images/cover_images/{{ $book->cover_image}}'
                                title='{{$book->title}}'
                                author='{{$book->authors ?? $book->author->first_name . " " .  $book->author->last_name }}'
                            >
                            </x-card>

                            @endif

                        @endforeach

                    </x-slot>
                </x-scroll>
            </div>

        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js" ></script>
<script defer>

    const data = {
        labels: [
        
        @foreach( $category_stat as $stat )
            
            '{{$stat->name}}',
        @endforeach
        ],
        datasets: [{
            data: [
                @foreach( $category_stat as $stat )
            
                    {{$stat->reads == 0? 1 : $stat->reads}},
                @endforeach
            ],
            Color: 'white',
            hoverOffset: 4
        }]
    };

    const ctx = document.getElementById('pie').getContext('2d');
    Chart.defaults.color = '#fff';
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
    });

    
</script>

</html>