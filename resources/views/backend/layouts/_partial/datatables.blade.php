@push('datatables')
 <!-- DataTables  & Plugins -->
<script src="{{asset('assets/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/pdfmake/pdfmake.js"></script>
<script src="{{asset('assets/backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('assets/backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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
                    extend: 'colvis',
                    text: "إظهار وإخفاء",
                },
                // {
                //     extend: 'pdfHtml5',
                //     text: 'Pdf',
                //     footer: true,
                //     header: true,
                //     filename: 'dt_custom_pdf',
                //     pageSize: 'A4',
                //     exportOptions: {
                //         alignment: "center",
                //         orthogonal: "PDF",
                //         columns: [12,11,10,9,8,7,6,5,4,3,2,1,0 ],
                //         modifier: {order: 'index', page: 'current'}

                //     },

                //     customize: function ( doc ) {
                //         doc.content.splice(0, 0, {
                //         text: [{
                //             text: 'الاتحاد الكويتى لكرة السلة \n',
                //             bold: true,
                //             fontSize: 14
                //         }, {
                //             text: ' عضو الاتحاد الدولى \n',
                //             bold: true,
                //             fontSize: 14
                //         }],
                //         margin: [0, -30, 0, 10],
                //             alignment: 'center'
                //         });
                //         doc.content.splice(0, 0, {
                //         text: [{
                //             text: 'Kuwait Basketball Association \n',
                //             bold: true,
                //             fontSize: 14
                //         }, {
                //             text: ' Member Of FIBA 1958 \n',
                //             bold: true,
                //             fontSize: 14
                //         }],
                //         margin: [0, 0, 0, 0],
                //             alignment: 'left'
                //         });
                //         // doc.styles.message.alignment = "right";
                //         // doc.styles.tableBodyEven.alignment = "center";
                //         // doc.styles.tableBodyOdd.alignment = "center";
                //         // doc.styles.tableFooter.alignment = "center";
                //         // doc.styles.tableHeader.alignment = "center";
                //         //doc.content[0]['text'] = doc.content[0]['text'].split(' ').reverse().join(' ');
                //         doc.content[1].margin = 0;
                //         doc.content[2].margin = 0;
                //         // for (var i = 0; i < doc.content[2].table.body.length; i++) {
                //         //     // console.log(doc.content[1].table.body[i].length);
                //         //     for (var j = 0; j < doc.content[2].table.body[i].length; j++) {
                //         //         doc.content[2].table.body[i][j]['text'] = doc.content[2].table.body[i][j]['text'].split(' ').reverse().join(' ');
                //         //     }
                //         // }

                //         doc['footer']=(function(page, pages) {
                //             return {
                //                 columns: [
                //                     {
                //                         alignment: 'center',
                //                         text: [
                //                             { text: page.toString(), italics: true },
                //                             ' من ',
                //                             { text: pages.toString(), italics: true }
                //                         ]
                //                     }
                //                 ],
                //                 margin: [10, 0]
                //             }
                //         });

                //     }
                // },
                {
                    extend: 'excel',
                    text: "تصدير إكسل",
                    title:document.title,
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [':visible'],
                        stripHtml: true,
                        //columns: 'th:not(:last-child)'
                    },
                    text:"طباعه",
                    title: function(){
                        return '';
                    },
                    messageTop: function () {
                        var row = '<div class="row">';
                        if($("#Family").length && $("#Family").val()){
                            var  rows2 = table.rows().count();
                            row += '<div class="col-md-3"><h4 style="font-weight: bold;">النادى: '+$("#Family option:selected").text()+'</h4></div>';
                            row += '<div class="col-md-3"><h4 style="font-weight: bold;">اجمالى عدد اللاعبين: '+$("#playerCount").val()+'</h4></div>';
                        }
                        // if($("#Category").length && $("#Category").val()){
                        //     row += '<div class="col-md-3"><h4 style="font-weight: bold;">اللقب: '+$("#Category option:selected").text()+'</h4></div>';
                        // }
                        if($("#Group").length && $("#Group").val()){
                            row += '<div class="col-md-3"><h4 style="font-weight: bold;">درجة اللاعب: '+$("#Group option:selected").text()+'</h4></div>';
                        }
                        // if($("#Status").length && $("#Status").val()){
                        //     row += '<div class="col-md-3"><h4 style="font-weight: bold;">حالة اللاعب: '+$("#Status option:selected").text()+'</h4></div>';
                        // }
                        // if($("#Region").length && $("#Region").val()){
                        //     row += '<div class="col-md-3"><h4 style="font-weight: bold;">التشكيل: '+$("#Region option:selected").text()+'</h4></div>';
                        // }
                        // if($("#Nationality").length && $("#Nationality").val()){
                        //     row += '<div class="col-md-3"><h4 style="font-weight: bold;">الجنسية: '+$("#Nationality option:selected").text()+'</h4></div>';
                        // }
                        row += '<div class="col-md-3"><h4 style="font-weight: bold;">التاريخ: '+ new Date().toLocaleDateString('ar-EG')+'</h4></div>';
                        row += '</div>';
                        var row2 = '<div class="row" style="margin-bottom: 20px;margin-top: 20px;"> <div class="col-md-4"> <img style="max-width: 80%;" src="{{ asset('logo.png') }}"> </div> <div class="col-md-4"> <h4 style="margin-top: 60px;text-align: center;">الاتحاد الكويتى لكرة السلة</h4> <h4 style="text-align: center;"> عضو الاتحاد الدولى</h4> </div> <div class="col-md-4"> <h4 style="margin-top: 60px;float:left">Kuwait Basketball Association</h4> <h4 style="float:left">Member Of FIBA 1958</h4> </div> <div class="col-md-12 text-center"> <h2>'+document.title+'</h2> </div> </div>';

                        return row2+row;
                    },
                    messageBottom: function () {
                        var date = new Date().toLocaleDateString('ar-EG');
                        var message = '<div style="margin-top: 10px;" class="row">';
                        message+=  '<div class="col-md-6"><h4 style="font-weight: bold;">التاريخ: '+date+'</div>';
                        if($("#playerCount").length){
                            message+=  '<div class="col-md-6"><h4 style="font-weight: bold;">عدد اللاعبين: '+$("#playerCount").val()+'</div>';
                        }
                        return message;
                    },
                    //className: 'btn-primary',
                    // repeatingHead: {
                    //     logo: "https://www.google.co.in/logos/doodles/2018/world-cup-2018-day-22-5384495837478912-s.png",
                    //     logoPosition: 'left',
                    //     logoStyle: 'width:140px;margin-right: 10px; margin-top: -5px;position: absolute;top:35px;left:10px;',
                    //     title: '<h4 style="float:left;">'+curday('-')+'</h4><h4 style="font-weight: bold;">برنامج أدارة الأعضاء</h4><h4 style="font-weight: bold;">مركز البدرشين محافظ الجيزة</h4><h4 style="font-weight: bold;">01061048481</h4>'+
                    //     '<h1 class="text-center"> تقرير الأعضاء</h1>',
                    //     messageTop: 'This print was produced using the Print button for DataTables'
                    // },

                    // exportOptions: {
                    //     columns: [':visible'],
                    //     stripHtml: true,
                    //     columns: 'th:not(:last-child)'
                    // },
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
                        $(document.title).html("test");
                        $("head").append('<style>@media print { html, body {overflow: hidden; } } </style>');
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    }
                }
            ],

            // "footerCallback": function (row, start, end, display)
            // {
            //     var api = this.api(),data;
            //     // Remove the formatting to get integer data for summation
            //     $(api.column(0).footer()).html("");
            //     // Update footer
            //     $(api.column(1).footer()).html("عدد اللاعبين: "+$("#playerCount").val());
            // },
            // columnDefs: [ {
            //     targets: -1,
            //     visible: false
            // } ],

        };
        if($('#clientSideDataTable').length){
            table = $('#clientSideDataTable').DataTable(dataTableDefaultOption);
        }
        if($('#serverSideDataTable').length){
            function getData(){
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++)
                {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }
            var parm = getData();
            let filter = [];
            parm.forEach(element => {
                if(parm[element]){
                    filter.push(element+"="+parm[element]);
                }
            });
            let dataFilter = filter.join("&");
            table = $('#serverSideDataTable').DataTable({
                dom: 'Blfrtip',
                pageLength: 25,
                responsive: true,
                lengthMenu: [[25, 50, 100, 200, 500, 800, -1], [25, 50, 100, 200, 500, 800, "All"]],
                order: [[0, "desc" ]],
                serverSide: true,
                "processing": true,
                'language': {
                    "url": "{{  asset('assets/backend/plugins/Arabic.json') }}",
                        'loadingRecords': '&nbsp;',
                        'processing': '<i class="fa fa-cog fa-spin fa-3x "></i><span class="sr-only">Loading...</span> '
                },
                buttons: [
                    {
                        extend: 'colvis',
                        text: "إظهار وإخفاء",
                    },
                    {
                        extend: 'excel',
                        text: "تصدير إكسل",
                        title:document.title,
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [':visible'],
                            stripHtml: true,
                            //columns: 'th:not(:last-child)'
                        },
                        text:"طباعه",
                        title: function(){
                            return '';
                        },
                        messageTop: function () {
                            var row = '<div class="row">';
                            if($("#Family").length && $("#Family").val()){
                                var  rows2 = table.rows().count();
                                row += '<div class="col-md-3"><h4 style="font-weight: bold;">النادى: '+$("#Family option:selected").text()+'</h4></div>';
                                row += '<div class="col-md-3"><h4 style="font-weight: bold;">اجمالى عدد اللاعبين: '+$("#playerCount").val()+'</h4></div>';
                            }
                            if($("#Group").length && $("#Group").val()){
                                row += '<div class="col-md-3"><h4 style="font-weight: bold;">درجة اللاعب: '+$("#Group option:selected").text()+'</h4></div>';
                            }
                            row += '<div class="col-md-3"><h4 style="font-weight: bold;">التاريخ: '+ new Date().toLocaleDateString('ar-EG')+'</h4></div>';
                            row += '</div>';
                            var row2 = '<div class="row" style="margin-bottom: 20px;margin-top: 20px;"> <div class="col-md-4"> <img style="max-width: 80%;" src="{{ asset('logo.png') }}"> </div> <div class="col-md-4"> <h4 style="margin-top: 60px;text-align: center;">الاتحاد الكويتى لكرة السلة</h4> <h4 style="text-align: center;"> عضو الاتحاد الدولى</h4> </div> <div class="col-md-4"> <h4 style="margin-top: 60px;float:left">Kuwait Basketball Association</h4> <h4 style="float:left">Member Of FIBA 1958</h4> </div> <div class="col-md-12 text-center"> <h2>'+document.title+'</h2> </div> </div>';

                            return row2+row;
                        },
                        messageBottom: function () {
                            var date = new Date().toLocaleDateString('ar-EG');
                            var message = '<div style="margin-top: 10px;" class="row">';
                            message+=  '<div class="col-md-6"><h4 style="font-weight: bold;">التاريخ: '+date+'</div>';
                            if($("#playerCount").length){
                                message+=  '<div class="col-md-6"><h4 style="font-weight: bold;">عدد اللاعبين: '+$("#playerCount").val()+'</div>';
                            }
                            return message;
                        },
                        action  : function(e, dt, button, config) {
                            $(document.title).html("test");
                            $("head").append('<style>@media print { html, body {overflow: hidden; } } </style>');
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
                    }
                ],
                "processing": true,
                ajax: {
                    url: pageUrl+"?"+dataFilter
                },
                fnDrawCallback: function () {
                    $('#playerCount').val(this.api().page.info().recordsTotal);
                    //self.QtdOcorrenciasAgendadosHoje = this.api().page.info().recordsTotal;
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
        div#serverSideDataTable_processing {
            top: 75px!important;
            color: #0879fa;
            font-weight: bold;
            font-size: 30px;
            width: 400px;
            background: #c2c7d0;
        }
       .flex-wrap {
            float: left;
        }
   </style>
@endpush
