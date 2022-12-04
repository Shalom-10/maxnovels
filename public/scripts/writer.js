/*
let enter_count = {};
let tem_count = 0;
function create_item(event, id, main = true) {

    resize_area();
    empty_area(event, main);

    if(event.key == 'Enter') {
        enter_count[id] = (typeof(enter_count[id]) == 'undefined') ? 0 : enter_count[id] + 1;
    }
    else {
        enter_count[id] = 0;
        return false;
    }

    if(enter_count[id] == 2) {
        let writer_box = select('.writer-box .written-content');
        let writer = main ? select('textarea[name = "writer"]') : select(`[item_id = "${id}"]`);
        let new_item = 
        `
            <textarea class = 'item full-w' value = '${writer.value}' item_id = '${tem_count}_temp' onkeyup = 'create_item(event, "${tem_count}_temp", false)'>${writer.value}</textarea>
        `;

        post_new_item(`${tem_count}_temp`);

        if(main) writer_box.insertAdjacentHTML('beforeend', new_item);
        else {
            writer.insertAdjacentHTML('beforebegin', new_item);
        }

        resize_area();
    
        writer.value = '';
        writer.innerHTML = '';
        writer.placeholder = 'Continue writing here...'
        writer.focus;

    }
}



function resize_area() {
    let textareas = selectAll('textarea');

    textareas.forEach(textarea => {
        console.log(textarea.scrollHeight);
        textarea.style.height = `${textarea.scrollHeight}px`;
    });
}

function post_new_item($temporary_id) {

}

function empty_area(event, main) {
    let target = event.target;
    if(target.value.replaceAll(' ', '') == '' && !main) target.remove();
}
*/

function create_item(event, id, main = true) {
    resize_area();
}

function resize_area() {
    let textareas = selectAll('textarea');

    textareas.forEach(textarea => {
        console.log(textarea.scrollHeight);
        textarea.style.height = `${textarea.scrollHeight}px`;
    });
}

function post_new_item($temporary_id) {

}

function empty_area(event, main) {
    let target = event.target;
    if(target.value.replaceAll(' ', '') == '' && !main) target.remove();
}

parent = select('.wrapper');

parent.onscroll = () => {
    console.log(parent.scrollTop);
    if(parent.scrollTop > 350) {
        activate_itm('.ql-toolbar');
        return true;
    }

    deactivate_itm('.ql-toolbar');
    return false;
}

function get_details() {
    let contents = quill.getContents();
    let form = select('form');
    let title = select('form input[name = "chapter_title"]');
    let content = select('form input[name = "chapter_content"]');
    
    contents = JSON.stringify(contents);
    title.value = select('input[name = "title"]').value;
    content.value = contents;

    return form;

}

function save() {
    let form = get_details();

    let type = select('form input[name = "type"]');

    type.value = 'save';
    form.submit();
}

function publish() {
    let form = get_details();
    
    let type = select('form input[name = "type"]');

    type.value = 'publish';
    form.submit();
}

function delete_chapter () {
    let form = get_details();
    
    let type = select('form input[name = "type"]');

    type.value = 'delete';
    form.submit();
}

function publish_preview() {
    activate_itm('.flash-case.sure');
    flash_card_trigger('You are about to publish this chapter, are you sure you want to do this?', '', 'publish();');
}

function delete_preview() {
    activate_itm('.flash-case.sure');
    flash_card_trigger('You are about to delete this chapter, are you sure you want to do this?', 'warning', 'delete_chapter();');
}