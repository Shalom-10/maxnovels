@props([
    'icon' => 'bi bi-house',
    'onclick' => '',
])


<div class = 'menu-btn flex-center' onclick = '{{ $onclick }}'>
    <i class = '{{ $icon }}'></i>
</div>