$(document).ready(function() {
    var t = $('#example-table').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
                
    t.on( 'draw.dt', function () {
    var PageInfo = $('#example-table').DataTable().page.info();
         t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        } );
    } );
} );

$(document).ready(function() {
    $(".js-example-basic-single").select2();
});