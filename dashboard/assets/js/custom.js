// =============  Data Table - (Start) ================= //

$(document).ready(function(){
    
    var table = $('#parceiros').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']
        
    });
    
    
    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:eq(0)');

});


$(document).ready(function(){
    
    var table = $('#faturas').DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
        },
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']
        
    });
    
    
    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:eq(0)');

});



// =============  Data Table - (End) ================= //
