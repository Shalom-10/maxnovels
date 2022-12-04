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
@if (count($users) > 0)
    <div class = 'pagination p-2'>
        {{ $users->links() }}
    </div>
@endif