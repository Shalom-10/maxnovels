@props([
    'input'  => '.search',
    'filter' => 'select.filter',
    'output' => '.content',
    'target' => '',
])

<script>

    let element = '{!! $input !!}';
    let filter = '{!! $filter !!}';
    let value = '';

    $(element).on('keyup', () => {

        value = $(element).val();
        filter_val = $(filter).val();
        activate_itm('.book_loading');
        activate_itm('.content .card');

        $.ajax({
            method: 'get',
            url: '{!! $target !!}?search=' + value + '&' + 'filter=' + filter_val,
            // data: {search: value, filter: filter_val},
            success: (data) => {
                let output = $('{!! $output !!}');
                output.empty();
                output.html(data);

                console.log(filter_val);
            }
        })
    })

</script> 