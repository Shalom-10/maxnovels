@props([
    'message' => 'flash message for all to see and not to comment on, I wonder what would happen if the flash message is longer than 2 lines',
    'type' => '',
    'icon' => '',
    'function' => '',

])

<div class = 'flash-case sure p-fix top-left full-vhw z-5 flex-center'>
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

            <div class = 'btn' onclick = '{{ $function }}'>
                <span>Continue</span>
            </div>
        </div>
    </div>
</div>

<script>

    function flash_card_trigger(message, type, function_str, remove = false) {

        let card = document.querySelector('.flash-case.sure');
        let icon = document.querySelector('.flash-case.sure .flash-icon');
        let button = document.querySelector('.flash-case.sure .btn');
        let p = document.querySelector('.flash-case.sure p');

        
        if(type == 'success') icon.innerHTML = "<i class = 'bi bi-check2'></i>";
        else if(type == 'error') icon.innerHTML = "<i class = 'bi bi-x-lg red'></i>";
        else if(type == 'warning') icon.innerHTML = "<i class = 'bi bi-exclamation-triangle red'></i>";
        
        button.setAttribute('onclick', function_str);
        if(remove) button.style.display = 'none';
        else button.style.display = 'flex';
        p.innerHTML = message;

        card.classList.add('active');
        
    }
</script>