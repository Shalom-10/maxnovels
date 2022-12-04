
let current_column = null;

function moderate(id, self) {
    activate_itm(".modal-case");
    activate_itm(".modal-loading");
    let modal = select(".modal");
    current_column = self;

    modal.querySelector(".btn-left").setAttribute('onclick', `location.href = "/writeform/${id}";`);
    modal.querySelector(".btn-right").setAttribute('onclick', `flash_card_trigger('you are about to delete this book, are you sure you want to?', '', 'delete_book(${id});');`);
    deactivate_itm(".modal-loading");
    
} 

function delete_book(id) {
    deactivate_itm(".flash-case.sure");
    activate_itm(".modal-loading");


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/delete_book',
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