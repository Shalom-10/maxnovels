@props([
    'title' => 'The Good Surgeon',
    'author' => 'Richard Sanchez',
    'image' => '/images/book_cover_8.jpg',
])

<?php

    $str = $title;

    if( strlen( $str) > 20) {
        $str = explode( "\n", wordwrap( $str, 20));
        $str = $str[0] . '...';
    }

    $title = $str;

    $str = $author;

    if( strlen( $str) > 20) {
        $str = explode( "\n", wordwrap( $str, 20));
        $str = $str[0] . '...';
    }

    $author = $str;
 ?>
<div {{$attributes->merge(['class' => 'card p-rel'])}}>

    <div class="image-box">
        <div class = 'image p-abs ov-hidden'>

            <img src = '{{ $image }}' class = 'obj-fit'>

            <div class="line right top-right p-abs full-h"></div>
            <div class="line left top-left p-abs full-h"></div>
        </div>
    </div>

    <div class="details p-1 text-center">
        <h5>{{ $title }}</h5>
        <small> <span>By</span> {{ $author }}</small>

        <div class = 'btn start_reading'>
            <span>Start Reading</span>
        </div>

        <div class = 'btn continue_reading'>
            <span>Continue Reading</span>
        </div>
    </div>
</div>