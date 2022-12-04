
let current_column = null;

function moderate(name, image, id, self) {
    activate_itm(".modal-case");
    activate_itm(".modal-loading");
    let modal = select(".modal");
    current_column = self;

    modal.querySelector('[name = "modal-input"]').value = name;
    modal.querySelector('img').src = `/images/avatars/${image}`;

    modal.querySelector(".btn-left").setAttribute('onclick', `flash_card_trigger('you are about to update this user, are you sure you want to?', '', 'update(${id});');`);
    modal.querySelector(".btn-right").setAttribute('onclick', `flash_card_trigger('you are about to delete this user, are you sure you want to?', '', 'delete_user(${id});');`);
    deactivate_itm(".modal-loading");
    
} 

function change_image(event) {

    let images = event.target.files[0];
    let url = URL.createObjectURL(images);

    if(images.size < 4000000) {
        select(".modal").querySelector('img').src = url;
    }
    else {
        flash_card_trigger('large image size, please use an image with a small size', '', '', true);
    }
}

function update(id) {
    deactivate_itm(".flash-case.sure");
    activate_itm(".modal-loading");
    
    let collection_data = new FormData();
    let image = select('[name = "modal-image"]').files[0];

    if(typeof(image) != 'undefined')
    collection_data.append('image', image);

    collection_data.append('role', document.querySelector('[name = "modal-input"]').value);
    collection_data.append('id', id);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/update_user',
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        data: collection_data,
        success: (data) => {

            console.log(data);

            if(typeof(image) != 'undefined') {
                let url = URL.createObjectURL(image);
                current_column.parentNode.parentNode.querySelector('.item-image img').src = url;
            }

            current_column.setAttribute('onclick', `moderate("${data.role}", "${data.image}", ${id}, this);`);

            deactivate_itm(".modal-loading");
        }
    });

}

function delete_user(id) {
    deactivate_itm(".flash-case.sure");
    activate_itm(".modal-loading");


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/delete_user',
        data: {id: id},
        success: (data) => {

            console.log(data);

            if(data.response)
            {
                current_column.parentNode.parentNode.remove();
                deactivate_itm(".modal-case");
            }

            deactivate_itm(".modal-loading");
        }
    });

}