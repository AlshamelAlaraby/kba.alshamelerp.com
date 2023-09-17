@push('datatables')
    <script src="{{asset('assets/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    

    
    <script>
        
        var curday = function(sp){
            today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //As January is 0.
            var yyyy = today.getFullYear();

            if(dd<10) dd='0'+dd;
            if(mm<10) mm='0'+mm;
            date =  (dd+sp+mm+sp+yyyy);
            return date;
        };
        var dataTableDefaultOption = {
            dom: 'Blfrtip',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
             'processing': true,
             "columnDefs": [{
                "visible": true,
                "targets": -1
            }],
             'language': {
                "url": "{{  asset('assets/backend/plugins/Arabic.json') }}",
                    'loadingRecords': '&nbsp;',
                    'processing': '<div class="spinner"></div>'
            },
            buttons: [
                {
                    extend: 'excel',
                    text: "تصدير إكسل",
                    title:document.title,
                },
                {
                    extend: 'print',
                    text:"طباعه",
                    title: '<img style="width: 150px;float:left;" src="{{\Illuminate\Support\Facades\Storage::disk('public')->url('logo/'.$settings['logo'])}}"/><h2>{{ $settings['name']??'' }}</h2><h4>{{ $settings['address']??'' }}</h4><h4>{{ $settings['mobile']??'' }}</h4>'+
                        '<h2 class="text-center">'+document.title+'</h2>',
                    //className: 'btn-primary',
                    // repeatingHead: {
                    //     logo: "https://www.google.co.in/logos/doodles/2018/world-cup-2018-day-22-5384495837478912-s.png",
                    //     logoPosition: 'left',
                    //     logoStyle: 'width:140px;margin-right: 10px; margin-top: -5px;position: absolute;top:35px;left:10px;',
                    //     title: '<h4 style="float:left;">'+curday('-')+'</h4><h4>برنامج أدارة الأعضاء</h4><h4>مركز البدرشين محافظ الجيزة</h4><h4>01061048481</h4>'+
                    //     '<h1 class="text-center"> تقرير الأعضاء</h1>',
                    //     messageTop: 'This print was produced using the Print button for DataTables'
                    // },
                    
                    exportOptions: {
                        columns: [':visible'],
                        stripHtml: true,
                        columns: 'th:not(:last-child)'
                    },
                    // customize: function ( win ) {
                    //     $(win.document.body)
                    //         .css( 'font-size', '10pt' )
                    //         .prepend(
                    //             '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                    //         );
    
                    //     $(win.document.body).find( 'table' )
                    //         .addClass( 'compact' )
                    //         .css( 'font-size', 'inherit' );
                    // }
                    // customize: function (win) {
                    //     var tit = 'تقريرى يا تقريرى';//$(win.document.body).find('.boxTiT').html();
                    //     if(tit != undefined)
                    //         $(win.document.body).find('h4:last').after('<h4 class="text-center">'+tit+'</h4>');
                    //     $(win.document.body).find('table').css('direction', 'rtl');
                    // },
                    action  : function(e, dt, button, config) {
                        $("head").append('<style>@media print { html, body {overflow: hidden; } } </style>');
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                }
            ] 
        };
        if($('#clientSideDataTable').length){
            table = $('#clientSideDataTable').DataTable(dataTableDefaultOption);
        }
        if($('#serverSideDataTable').length){
            table = $('#serverSideDataTable').DataTable({
                responsive: true,
                order: [[0, "desc" ]],
                serverSide: true,
                ajax: {
                    url: pageUrl
                },
                columns:columns
            });
        }
    </script>
@endpush
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap4.min.css">
    <!-- DataTables -->
   <style>
       .flex-wrap {
            float: left;
        }
   </style>
@endpush
