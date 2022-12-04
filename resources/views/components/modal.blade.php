
<div class = 'modal-case top-left full-hw p-abs flex-center'>
    <div class = 'modal'>
        <div class = 'modal-top flex-row flex-between'>
            <div class = 'modal-name'>
                <span>Modal Name</span>
            </div>

            <div class = 'close-btn flex-center pointer' onclick = 'deactivate_itm(".modal-case");'>
                <i class = 'bi bi-x-lg'></i>
            </div>
        </div>

        <div class = 'modal-content flex-row p-rel'>

            <div class = 'modal-right'>
                <div class = 'modal-image ov-hidden'>
                    <img src = '/images/avatars/avatar' class = 'obj-fit'>
                </div>
                <div class = 'modal-btn'>
                    <div class = 'btn flex-center' onclick = 'select("[name = \"modal-image\"]").click();'>
                        <span>Choose Image</span>
                    </div>
                    <input type='file' accept="images/*" name = 'modal-image' style = 'visibility: hidden;' onchange="change_image(event);">
                </div>
            </div>

            <div class = 'modal-left p-rel flex-col-center'>
                <div class = 'input flex-col'>
                    <label>Name</label>
                    <input type = 'text' name = 'modal-input'>
                </div>

                <div class = 'modal-btns flex-row p-abs btm-left full-w'>
                    <div class = 'btn-left flex-center'>
                        <span>update<span>
                    </div>
                    <div class = 'btn-right flex-center'>
                        <span>delete<span>
                    </div>
                </div>
            </div>

            <div class = 'modal-loading flex-center p-abs full-hw'>
                <div class = 'image'>
                </div>
            </div>
        
        </div>

        
    </div>
</div>