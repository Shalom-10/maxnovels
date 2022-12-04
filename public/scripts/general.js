function select(target) {
    return document.querySelector(target);
}

function selectAll(target) {
    return document.querySelectorAll(target);
}

function remove_itm(target, victim) {
    if(typeof(target) == 'string')
    if(select(target) != null)    
    select(target).querySelectorAll(victim).forEach( victim => {
            victim.remove();
        })
        
    else target.querySelectorAll(victim).forEach( victim => {
        victim.remove();
    });
}

function activate_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.add(class_name);
}

function deactivate_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.remove(class_name);
}

function deactivateAll(target, class_name = 'active') {
    selectAll(target).forEach(victim => {
        victim.classList.remove(class_name);
    });
}

function toggle_itm(target, class_name = 'active') {
    if(select(target) != null)
    select(target).classList.toggle(class_name);
}

function year_generator(start_year, end_year) {

    let select = document.createElement('select');
    let option = document.createElement('option');

    select.setAttribute('name', 'year');


    option.value = 'Year';
    option.innerHTML = 'Year';

    select.appendChild(option);

    while(start_year <= end_year) {
        option = document.createElement('option');
        option.value = start_year;
        option.innerHTML = start_year;

        select.appendChild(option);

        start_year++;
    }

    return select;
}

function day_generator(start_day, end_day) {

    let select = document.createElement('select');
    let option = document.createElement('option');

    select.setAttribute('name', 'day');

    option.value = 'Day';
    option.innerHTML = 'Day';

    select.appendChild(option);

    while(start_day <= end_day) {
        option = document.createElement('option');
        option.value = start_day;
        option.innerHTML = start_day;

        select.appendChild(option);

        start_day++;
    }

    return select;
}

function scroll_horizontal(target, left = true) {

    if(left)
    target.scrollBy({left: -250, behavior: "smooth"});
    
    else 
    target.scrollBy({left: 250, behavior: "smooth"});
    
}

function search(search_value, search_filter, search_url, search_callback) {

    $.ajax({
        method: 'GET',
        url: search_url,
        data: {search: search_value, filter: search_filter},
        success: (data) => {
            search_callback(data);
        }
    })

}