@push('css')
<style type="text/css">
td{
    padding: 1em;
    vertical-align: middle;
    display: table-cell;
    border-top: 1px solid #cecece;
    cursor: move;
}
.hidden-td{
  display: none;
  height: 100px;
}
.placeholder-style{
  background-color: grey !important;
}
</style>
@endpush
@push('js')
<script src="https://code.jquery.com/ui/jquery-ui-git.js"></script>
<script>
    function tableSortable(){
        $('tbody').sortable({
            items: ">tr",
            appendTo: "parent",
            opacity: 2,
            //axis: "y",
            //containment: "document",
            placeholder: "placeholder-style",
            cursor: "move",
            delay: 150,
            start: function(event, ui) {
                $(this).find('.placeholder-style td:nth-child(2)').addClass('hidden-td')
            ui.helper.css('display', 'table')
            },
            stop: function(event, ui) {
                ui.item.css('display', '');
                update();
            }
        });
    }
    function update(){

        var url_ =  "{{$updateLink}}";
        var offset = 1;
        var page = $(".paginate_button.active a").html();
        var size = $('select[name="serverSideDataTable_length"]').val();
        offset = (page-1) * size + 1;
        $.ajax({
            url:url_,
            type:'post',
            data: {
               "_token": "{{ csrf_token() }}",
               order:$(".itemIDs").serialize(),
               offset:offset,
            },
            success:function(result){

            }
        });
    }
    $(document).ready(function () {
        tableSortable();
    });
</script>
@endpush
