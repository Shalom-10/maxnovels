@props([
    'title' => "<h1 class = 'h2'>Our <span>Collection</span></h1>",
    'avatar' => false,
    'editable' => false,
    'image' => 'avatar',
])

<header class = 'short_header p-rel'>
    <div class = 'background p-abs top-left full-hw z-1 ov-hidden'>
        <img src = '/images/section_bg.jpg' class = 'obj-fit p-rel z-1'>
        <div class = 'overlay color p-abs top-left full-hw z-2'></div>
        <div class = 'overlay blur p-abs top-left full-hw z-3'></div>
    </div>

    <div class = 'content p-rel z-2 full-hw flex-center flex-col'>
        @if ($avatar)
            <div class = 'avatar ov-hidden round p-rel'>
                <img src = '/images/avatars/{{auth()->user()->avatar ?? 'avatar'}}' class = 'obj-fit p-rel z-1 avatar-image'>
                @if ($editable)
                    <div class = 'avatar_cover p-abs top-left full-hw z-2 flex-center pointer' onclick = 'document.querySelector(".avatar_image").click();'>
                        <i class = 'bi bi-camera'></i>
                    </div>
                    <input type = 'file' name = 'avatar_image' accept="images/*" style = 'visibility: hidden;' class = 'avatar_image' onchange="update_avatar(event, {{auth()->user()->id}});">
                @endif
            </div>
        @endif
        {!! $title !!}
    </div>
</header>

<x-flash_card_sure />

<script>
    function update_avatar(event, user_id) {
        let files = event.target.files;

        if(files.length > 0) {

            activate_itm('.avatar_cover');

            let image_data = new FormData();

            image_data.append('image', files[0]);
            image_data.append('user_id', user_id);

            if(files[0].size > 1000000) {
                flash_card_trigger('Image size is greater than 4MB, image can not be uploaded', 'warning', '', true);
                deactivate_itm('.avatar_cover');
                console.log('some');
                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/update_avatar',
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                data: image_data,
                success: (data) => {

                    console.log(data);
                    let url = URL.createObjectURL(files[0])
                    document.querySelector('.avatar-image').src = url;
                    deactivate_itm('.avatar_cover');

                }
            })

        }


    }
</script>