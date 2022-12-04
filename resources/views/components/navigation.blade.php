

<nav class = 'flex-between flex-row  full-w z-5 active p-fix top-left'>

    <div class = 'logo'>
        <span>Max</span><span>novels</span>
    </div>

    <div class = 'left flex-row'>

        <div class = 'nav_link flex-row flex-between p-rel desktop' onclick = 'location.href = "/";'>

            <div class = 'link'>
                <span>Home</span>
            </div>

            <div class = 'icon'>
                <!-- <i class = 'bi bi-chevron-down'></i> -->
            </div>

            <div class = 'line p-abs'></div>
        </div>

        <div class = 'nav_link flex-row flex-between p-rel desktop' onclick = 'location.href = "/collections";'>

            <div class = 'link'>
                <span>Our Collections</span>
            </div>

            {{-- <div class = 'icon'>
                <i class = 'bi bi-chevron-down'></i>
            </div> --}}

            <div class = 'line p-abs'></div>
        </div>

        <div class = 'nav_link flex-row flex-between p-rel desktop' onclick = 'location.href = "/books";'>

            <div class = 'link'>
                <span>Browse</span>
            </div>

            <div class = 'icon'>
                <!-- <i class = 'bi bi-chevron-down'></i> -->
            </div>

            <div class = 'line p-abs'></div>
        </div>

        @auth
            <div class = 'nav_link flex-row flex-between p-rel desktop' onclick = 'location.href = "/yourbooks";'>

                <div class = 'link'>
                    <span>Start Writing</span>
                </div>

                <div class = 'icon'>
                    <!-- <i class = 'bi bi-chevron-down'></i> -->
                </div>

                <div class = 'line p-abs'></div>
            </div>

            <form method='POST' action = '/logout'  class = 'nav_link flex-row flex-between p-rel desktop' onclick = 'this.submit();'>
                @csrf
                <div class = 'link'>
                    <span>Log Out</span>
                </div>

                <div class = 'icon'>
                    <!-- <i class = 'bi bi-chevron-down'></i> -->
                </div>

                <div class = 'line p-abs'></div>
            </form>
        @endauth

        @guest
            <div class = 'nav_link btn flex-row flex-between p-rel desktop sign_up_btn' onclick = 'location.href = "/login";'>

                <div class = 'link'>
                    <span>Log In</span>
                </div>

                <div class = 'icon'>
                    <!-- <i class = 'bi bi-chevron-down'></i> -->
                </div>

                <div class = 'line p-abs'></div>
            </div>

            <div class = 'nav_link btn hot flex-row flex-between p-rel desktop sign_up_btn' onclick = 'location.href = "/signup";'>

                <div class = 'link'>
                    <span>Sign Up</span>
                </div>

                <div class = 'icon'>
                    <!-- <i class = 'bi bi-chevron-down'></i> -->
                </div>

                <div class = 'line p-abs'></div>
            </div>
        @endguest

        <div class = 'toggle_btn flex-center' onclick = 'activate_itm(".mobile_nav")'>
            <i class = 'bi bi-list'></i>
            <i class = 'bi bi-list'></i>
        </div>
    </div>

    <div class="mobile_nav full-vh p-fix top-right">
        <div class = 'nav-top flex-row flex-end p-1'>
            <div class = 'close-btn flex-center round' onclick = 'deactivate_itm(".mobile_nav")'>
                <i class = 'bi bi-x-lg'></i>
            </div>
        </div>

        <div class = 'nav_item flex-row' onclick = 'location.href = "/";'>

            <div class = 'icon flex-center'>
                <i class = 'bi bi-house'></i>
            </div>

            <div class = 'name'>
                <span>Home</span>
            </div>

        </div>

        <div class = 'nav_item flex-row' onclick = 'location.href = "/collections";'>

            <div class = 'icon flex-center'>
                <i class = 'bi bi-collection'></i>
            </div>

            <div class = 'name'>
                <span>Our Collections</span>
            </div>

        </div>

        <div class = 'nav_item flex-row' onclick = 'location.href = "/books";'>

            <div class = 'icon flex-center'>
                <i class = 'bi bi-house'></i>
            </div>

            <div class = 'name'>
                <span>Browse</span>
            </div>

        </div>

        @auth
        <div class = 'nav_item flex-row' onclick = 'location.href = "/yourbooks";'>

            <div class = 'icon flex-center'>
                <i class = 'bi bi-pen'></i>
            </div>

            <div class = 'name'>
                <span>Start Writing</span>
            </div>

        </div>

        <form method='POST' action = '/logout' class = 'nav_item flex-row' onclick = 'this.submit();'>
            @csrf
            <div class = 'icon flex-center'>
                <i class = 'bi bi-pen'></i>
            </div>

            <div class = 'name'>
                <span>Log Out</span>
            </div>

        </form>
        
        @endauth

        @guest
            
            <div class = 'nav_item flex-row' onclick = 'location.href = "/login";'>

                <div class = 'icon flex-center'>
                    <i class = 'bi bi-box'></i>
                </div>

                <div class = 'name'>
                    <span>Log In</span>
                </div>

            </div>

            <div class = 'nav_item flex-row' onclick = 'location.href = "/signup";'>

                <div class = 'icon flex-center'>
                    <i class = 'bi bi-person'></i>
                </div>

                <div class = 'name'>
                    <span>Sign Up</span>
                </div>

            </div>
        @endguest
        



        

    </div> 
</nav>