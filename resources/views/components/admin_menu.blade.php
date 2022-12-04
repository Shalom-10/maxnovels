<div class = 'left_c'>
    <div class = 'top flex-col flex-center p-rel'>
        <div class = 'avatar round ov-hidden'>
            <img src = '/images/avatars/{{ auth()->user()->avatar}}' class = 'obj-fit'>
        </div>

        <div class = 'avatar-name'>
            <span>{{ auth()->user()->first_name . " " . auth()->user()->last_name}}</span>
        </div>

        <div class = 'p-abs top-right p-1 pointer' onclick = 'toggle_itm(".left_c");'>
            <i class = 'bi bi-x-lg'></i>
        </div>
    </div>

    <div class = 'menu-content'>
        <div class = 'menu-item flex-row' onclick = 'location.href="/admin";'>
            <div class = 'icon'>
                <i class = 'bi bi-house'></i>
            </div>
            <div class = 'name'>
                Dashboard
            </div>
        </div>

        <div class = 'menu-item flex-row' onclick = 'location.href="/admin_books";'>
            <div class = 'icon'>
                <i class = 'bi bi-book'></i>
            </div>
            <div class = 'name'>
                Books
            </div>
        </div>

        <div class = 'menu-item flex-row' onclick = 'location.href="/admin_collection";'>
            <div class = 'icon'>
                <i class = 'bi bi-collection'></i>
            </div>
            <div class = 'name'>
                Categories
            </div>
        </div>

        @if (auth()->user()->role == 'super')
            <div class = 'menu-item flex-row' onclick = 'location.href="/admin_users";'>
                <div class = 'icon'>
                    <i class = 'bi bi-people'></i>
                </div>
                <div class = 'name'>
                    Users
                </div>
            </div>
        @endif
    </div>
</div>