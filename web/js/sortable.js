$( function() {
    $( "#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable",
        receive: function( event, ui ) {
            var url = $(event.target).data('accion');
            var list = $(ui.item).data('list');
            var item = $(ui.item).data('item');
            console.log($(event.target));

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    list: list,
                    item: item
                }
            });
        }
    }).disableSelection();
} );
