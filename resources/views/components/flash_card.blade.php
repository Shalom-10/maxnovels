@props([
    'message' => 'flash message for all to see and not to comment on, I wonder what would happen if the flash message is longer than 2 lines',
    'type' => '',
    'icon' => '',
])

<div class = 'flash-case p-fix top-left full-vhw z-5 flex-center active'>
    <div class = 'flash-card'>

        <div class = 'flash-top flex-row flex-end'>
            <div class = 'close-btn pointer' onclick = 'deactivate_itm(".flash-case");'>
                <i class = 'bi bi-x-lg'></i>
            </div>
        </div>

        <div class = 'flash-content flex-col text-center'>
            <div class = 'flash-icon full-w flex-center'>
                @if ($type == 'success') 
                    <i class = 'bi bi-check2'></i>
                @elseif ($type == 'error')
                    <i class = 'bi bi-x-lg red'></i>
                @elseif ($type == 'custom')
                    <i class = '{{$icon}}'></i>
                @else 
                    <i class = 'bi bi-info'></i>
                @endif
            </div>
            <p>
                {{$message}}
            </p>
        </div>
    </div>
</div>