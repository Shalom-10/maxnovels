@props([
    'title' => 'Top <span>Reads</span>',
])

<section class = 'scroll-box full-w p-rel'>

    <div class = 'scroll-top flex-row flex-between'>
        <h2 class = 'content-padding h2'>{!! $title !!}</h2>
    </div>

    <div class = 'scroll'>
        <div class = 'contents flex-row'>
            {{ $content }}
        </div>
    </div>

    <div class = 'scroll-btn left p-abs round flex-center' onclick = 'scroll_horizontal(this.parentElement.querySelector(".scroll"));'>
        <i class = 'bi bi-chevron-left'></i>
    </div>

    <div class = 'scroll-btn right p-abs round flex-center' onclick = 'scroll_horizontal(this.parentElement.querySelector(".scroll"), false);'>
        <i class = 'bi bi-chevron-right'></i>
    </div>
    
</section>