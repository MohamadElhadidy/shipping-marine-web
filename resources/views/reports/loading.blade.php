@extends('layouts.app')
@section('title', ' تقرير التحميل من المخازن ')
@section('style')

    <link href="{{ asset('css/cars.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .header {
            visibility: hidden !important;
            opacity: 0 !important;
        }
table.dataTable tfoot th, table.dataTable tfoot td {
  background: #161a1a;
  color: #fff;
}
    </style>
@endsection
@section('content')
    <div class="wrapper">
        <div>
            <p style='color:orange;'>{{ $vessel->name }}</p>
            <p style='margin-top: -15px;' class="title"> تقرير التحميل من المخازن </p>
        </div>
        <input type="text" name="datetimes" id="datetimes"  readonly/>
        <button class="btn btn-primary" onclick="search()">ابحث</button>
        <table id='table'>
            <thead>
                <tr>
                    <th>كود السيارة</th>
                    <th>رقم السيارة</th>
                    <th>وقت التحميل</th>
                    <th> الصنف</th>
                    <th>رقم المخزن</th>
                    <th>الكمية </th>
                    <th>جامبو</th>
                    <th>اسم الموظف</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
             <tfoot>
            <tr>
               <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td></td>
                    <td> </td>
                    <td></td>
            </tr>
        </tfoot>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
     
        $(function() {
  $('input[name="datetimes"]').daterangepicker({
    timePicker:true,
    timePicker24Hour: true,
    opens: 'center',
    startDate: moment().startOf('day').subtract(10, 'day'),
    endDate: moment().startOf('day').add(10, 'day'),
    locale: {
        format: 'Y-MM-DD H:mm:00',
        applyLabel: "موافق",
        cancelLabel: "إلغاء",
    }
    });
});
        // CREATE
        @php
        $url = 'DLoading/' . request()->id;
        @endphp
        var dt = $('#table').DataTable({
             footerCallback: function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total1 = api
                .column(5)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            total = (Math.round(total1 * 100) / 100).toFixed(3);
            total2 = api
                .column(6)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
 
            // Update footer
            $(api.column(5).footer()).html(total + ' طن ' );
            $(api.column(6).footer()).html(total2 );
        },
            dom: 'lBfrtip',
            responsive: true,
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            "language": {
                "searchPlaceholder": "ابحث",
                "sSearch": "",
                "sProcessing": "جاري التحميل...",
                "sLengthMenu": "أظهر مُدخلات _MENU_",
                "sZeroRecords": "لم يُعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مُدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجلّ",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "الأول",
                    "sPrevious": "السابق",
                    "sNext": "التالي",
                    "sLast": "الأخير"
                }
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "الكل"]
            ],
            processing: true,
            serverSide: true,
            //bLengthChange: false,
            ajax: {
                    url: '{{ url($url) }}',
                    data: function(d) {
                            d.datetimes =  $( "#datetimes" ).val();
                        }
                    },
            columns: [{
                    data: 'sn',
                    name: 'sn'
                },
                {
                    data: 'car_no',
                    name: 'car_no'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'store_no',
                    name: 'store_no'
                },
                {
                    data: 'qnt',
                    name: 'qnt'
                },
                {
                    data: 'jumbo',
                    name: 'jumbo'
                },
                {
                    data: 'ename',
                    name: 'ename'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },

            ],
            buttons: [

                {
                    extend: 'excelHtml5',
                    footer: true,
                    text: '<i class="fas fa-file-excel"></i> excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    },
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"> طباعة',
                    messageTop: '<img src="/images/load.png" style="position:relative;width:100%;" />',
                    autoPrint: true,
                    title:'',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    customize: function(win) {
                       $(win.document.body).find('table.dataTable tbody td')
                            .css('text-align', 'center')
                            .css('padding', '0px')
                            .css('font-size', '1rem');
                        $(win.document.body).find('table.dataTable thead th')
                            .css('text-align', 'center')    
                            .css('padding', '0px')
                            .css('font-size', '1rem');
                            $(win.document.body).find('table.dataTable')
                            .css('width', '100%');

                    }
                },
            ]
        });
        var Pchannel = pusher.subscribe('loading');
        Pchannel.bind('report', function(data) {
            if (data.message == JSON.parse("{{ json_encode($vessel->vessel_id) }}")) {
                $('#table').DataTable().ajax.reload();
            }
        });

        function search() {
                $('#table').DataTable().ajax.reload();
            }
    </script>


@endsection
