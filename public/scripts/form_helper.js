let list_inputs = [];
let list_values = {};


function prevent_enter(self) {
    self.preventDefault();
}

function form_submit(self) {

    list_inputs.forEach( input => {
        list_values[input] = [];

        let inputs = selectAll(`input[name = '${input}']`);
        let inputs_size = (inputs.length - 1);
        let new_input = inputs[inputs_size];

        let counter = 0;


        inputs.forEach( hidden_input => {
            list_values[input].push(hidden_input.value);

            if(counter < inputs_size) hidden_input.remove();

            counter++
        })

        new_input.value = list_values[input];
    })

    document.querySelector('form').submit();
}

function list_creator(self) {

    let parent = self.parentNode.parentNode;
    let name = parent.getAttribute('name');
    let input = parent.querySelector('input');
    let list  = parent.querySelector('.add-list');

    if(input.value.replaceAll(' ', '') == '') return false;

    if(list_inputs.indexOf(name) <= -1) {
        list_inputs.push(name); 
        list.querySelector('.first_input').remove();
        console.log('added');
    }

    let add_item = `
        <div class = 'add-item flex-row'>
            <div class = 'item'>
                {{value}}
            </div>
            <div class = 'icon flex-center round' onclick = 'remove_list_item(this)'>
                <i class = 'bi bi-dash'></i>
            </div>

            <input type='hidden' name = '{{name}}' value = '{{value}}' >
        </div>
    `;

    add_item = add_item.replaceAll('{{value}}', input.value);
    add_item = add_item.replaceAll('{{name}}', name);

    list.innerHTML += add_item;

    input.value = '';
}

function remove_list_item(self) {
    self.parentNode.remove();
}

function add_list(self, tag = false) {
    // console.log((tag && self.keyCode != 32));
    if( (self.key != 'Enter' && !tag) || ( tag && (self.keyCode != 32 && self.key != 'Enter')) ) return false;


    let element = self.target;
    list_creator(element);
}

function click_image(name = 'cover_image') {
    select(`input[name = '${name}']`).click();
}

function previewImage(self) {
    let images = self.target.files;
    

    if(images.length > 0) {
        let image_url = URL.createObjectURL(images[0]);
        select('.image-box').style.backgroundImage = `url('${image_url}')`;
    }
}


selectAll('select').forEach( select => {
    if(select.getAttribute('value') != '' && select.getAttribute('value') != null) {

        select.value = select.getAttribute('value');

    }
})