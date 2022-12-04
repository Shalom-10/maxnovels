
<x-book_list :books='$books' />

{{ $books->appends(['search' => $search, 'filter' => $filter])->links() }}