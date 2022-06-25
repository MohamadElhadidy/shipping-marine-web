<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="https://marine-co.online/ops/favicon.png">
    <title>معدلات عملية الشحن</title>
<style>
        @import url("https://fonts.googleapis.com/css2?family=Changa:wght@600&display=swap");

        html,
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Changa", sans-serif;
            font-size: 62.5%;
            font-size: 10px;
            direction: rtl;
            width: 100%;
            height: 100%;
            overflow: visible;
            position: absolute;
        }



        #myVideo {
            position: fixed;
            z-index: -1;
            /*filter: grayscale();*/
        }

        @media (min-aspect-ratio: 16/9) {
            #myVideo {
                width: 100%;
                height: auto;
            }
        }

        @media (max-aspect-ratio: 16/9) {
            #myVideo {
                width: auto;
                height: 100%;
            }
        }

        .img {
            width: 95vw;
            margin-right: 2.5vw !important;
        }

        .vessel__detail {
            width: 95vw;
            margin-right: 2.5vw !important;
            text-align: center;
        }

        .vessel__detail td,
        .vessel__detail th {
            border: 1px solid #000;
        }

        .vessel__detail th {
            background-color: #80808075;
            color: #fff;
        }

        .vessel__detail td {
            background-color: #FFF8DCA3;
            color: #000;
        }

        .cars__count {
            width: 95vw;
            margin-right: 2.5vw !important;
            text-align: center;
        }

        .cars__count th {
            border: 1px solid #000;
            background-color: #FFF8DCA3;
            color: #220acc;
        }

        .cars__count span {
            color: #d71111;
        }


        .total__time {
            width: 95vw;
            margin-right: 2.5vw !important;
            text-align: center;
        }

        .total__time th {
            border: 1px solid #000;
            background-color: #FFF8DCA3;
            color: #660033;
        }

        .total__time span {
            color: #419e3b;
        }

        .total__now {
            width: 95vw;
            margin-right: 2.5vw !important;
            text-align: center;
        }

        .total__now th {
            border: 1px solid #000;
            background-color: #b359008a;
            color: #ffffff;
        }

        .total__now span {
            color: #419e3b;
        }

        .total__now td {
            background-color: #FFFFFF82;
        }

        .count__moves {
            color: #1919ff !important;
        }

        .quantity {
            color: #d71111;
        }

        .jumbo {
            color: #419e3b;
        }
    .small td,
        .small th {
            padding: 0px !important;
        }
        /* .small {
            width: 30vw;
            margin-right: 2.5vw;
            text-align: center;
            display: inline-table
        }

    

        .small th {
            color: #fff;
        }

        .small td {
            background-color: rgba(255, 255, 255, 0.439);
            color: #000000;
        }

        .dataTable {
            width: 30vw !important;
            margin: .8vh 2.5vw 0 0 !important;
        }


        .dataTables_wrapper::after {
            display: inline !important;
        }

        .dataTables_wrapper {
            display: inline;
        } */

        .blue__detail th {
            background-color: #0a8fdb;
        }

        .orange__detail th {
            background-color: #ff8000;
        }

        .green__detail th {
            background-color: #008000;
        }

       

        .total__cars__quantity td,
        .total__cars__quantity th {
            border: 1px solid #000;
        } 

        .total__cars__quantity th {
            color: #fff;
            background-color: #008000;
        }

        table.dataTable tbody tr {
            background-color: rgba(255, 255, 255, 0.439) !important;
            color: #000000 !important;
        }
        table.dataTable{
            width: 95vw !important;
        }
        table.dataTable tbody th, table.dataTable tbody td{
        padding: 0px !important;
                 }
                 table.dataTable thead th, table.dataTable thead td{
        padding: 0px !important;

         }
        @media only screen and (max-width: 885px) {}

        @media only screen and (max-width: 750px) {
            /* .dataTable {
                width: 90vw !important;
                margin: .8vh 5vw 0 0 !important;
            } */
        }

        @media only screen and (max-width: 685px) {}
        .img{
            display: none;
        }
        @media print {

            table th{
                font-size:1rem;
            }
             table td{
                font-size:1rem;
            }
             .small td,
        .small th {
            font-size: 1rem !;
                    }
            #myVideo {
             display: none;
            }
            .small{
                width: 45vw;
            }

            table.dataTable tbody th, table.dataTable tbody td{
              font-size:1rem;
                     }
                     table.dataTable thead th, table.dataTable thead td{
              font-size:1rem;
                    
                    }
                 
              .vessel__detail th {
                        background-color: #808080 !important;
                        color: #fff !important;
                    }
                    .headerss th{
            background-color: #aa2929 !important;
            }
            .img{
                display: block;
            }
        }
        .headerss th{
        background-color: #aa292975 ;
        }
        .black th{
            background: #000;
        }
        .black th:nth-child(2){
             background: rgb(155, 6, 6);
        }
       

         .black th:nth-child(3){
             background: rgb(5, 109, 48);
        }
        

</style>
</head>

<body>
    <video autoplay muted loop id="myVideo">
        <source src="{{ asset('images/background.mp4') }}" type="video/mp4">
    </video>
    <div class="wrapper">
    <img class="img" src="{{ asset('images/report.png') }}" width="100%">

        <table class="vessel__detail">
            <thead>
                <tr>
                    <th> اسم الباخره </th>
                    <th> العميل</th>
                    <th>رقم الرصيف </th>
                    <th> الصنف</th>
                    <th> الكمية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $vessel->name }}</td>
                    <td>{{ $vessel->client }}</td>
                    <td>{{ $vessel->quay }}</td>
                    <td>{{ $vessel->type }}</td>
                    <td>{{ $vessel->qnt }}</td>
                </tr>
            </tbody>
        </table>
        @NoAccessWithType(['client'])
        @if ($total_cars != 0)
            <table class="cars__count ">
                <thead>
                    <tr>
                        <th> إجمالي السيارات من البدايه : <span>{{ $total_cars }}</span></th>
                        @if ($vessel->done == 0)
                            <th> السيارات الحاليه : <span>{{ $active_cars }}</span></th>
                        @endif
                        @if ($toktok_cars != 0)
                            <th> سـ توكتوك : <span>{{ $toktok_cars }}</span></th>
                        @endif
                        @if ($qlab_cars != 0)
                            <th> سـ قلاب : <span>{{ $qlab_cars }}</span></th>
                        @endif
                        @if ($company_cars != 0)
                            <th> سـ شركة : <span>{{ $company_cars }}</span></th>
                        @endif
                        @if ($grar_cars != 0)
                            <th> سـ جرار : <span>{{ $grar_cars }}</span></th>
                        @endif
                    </tr>
                </thead>
            </table>
        @endif
        @endNoAccessWithType
        <table class="total__time">
            <thead>
                <tr>
                    <th colspan="1"> مدة التشغيل </th>
                    {{-- @if ($days != 0)
                        <th> <span> {{ $days }} يوم</span></th>
                    @endif --}}
                    @if ($hours != 0)
                        <th colspan="2"><span>{{ $hours }} ساعة </span></th>
                    @endif
                    {{-- @if ($minutes != 0)
                        <th> <span>{{ $minutes }} دقيقة </span></th>
                    @endif --}}
                </tr>
            </thead>
        </table>
        @if ($move_sum->moves_count != 0)
            <table class="total__now headerss">
                <thead>
                    <tr>
                        <th>نقلات شُحِنت </th>
                        <th>الرصيد الآن </th>
                        @if ($move_sum->total_jumbo != 0)
                            <th>جامبو</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="count__moves">{{ $move_sum->moves_count }}</span></td>
                        <td><span class="quantity"> { {{ number_format($loading_sum->total_qnt , 3, '.', '')}} } </span>
                            <span class="count__moves"> { {{ $loading_sum->moves_count }} } </span>
                            @if ($loading_sum->total_jumbo != 0)
                                <span class="jumbo"> { {{ $loading_sum->total_jumbo }} } </span>
                            @endif
                        </td>
                        @if ($move_sum->total_jumbo != 0)
                            <td><span class="jumbo">{{ $move_sum->total_jumbo }}</span></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        @endif
        @if ($room_sum->isNotEmpty())
            <table class="blue__detail small table">
                <thead>
                    <tr>
                        <th>رقم العنبر</th>
                        <th>عدد النقلات </th>
                        <th> اجمالي الكمية </th>
                        <th> سعة العنبر</th>
                        <th> المتبقي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room_sum as $room)
                        <tr>
                            <td>{{ $room->room_no }}</td>
                            <td>{{ $room->moves_count }}</td>
                            <td>{{ number_format($room->total_qnt , 3, '.', '')  }}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($seer_sum->where('seer', '!=', 'بدون سيور شحن')->count() != 0)
            <table class="blue__detail small table">
                <thead>
                    <tr>
                        <th>رقم السير</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seer_sum as $seer)
                        @if ($seer->seer != 'بدون سيور شحن')
                            <tr>
                                <td>{{ $seer->seer }}</td>
                                <td>{{ $seer->moves_count }}</td>
                                <td>{{  number_format($seer->total_qnt , 3, '.', '') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($seer_sum->where('seer', '!=', 'بدون سيور شحن')->count() != 0)
            <table class="blue__detail small table">
                <thead>
                    <tr>
                        <th>رقم السير</th>
                        @foreach ($room_sum as $room)
                            <th>{{ $room->room_no }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $seer_sum->count(); $i++)
                        @if ($seer_sum[$i]->seer != 'بدون سيور شحن')
                            <tr>
                                <td>{{ $seer_sum[$i]->seer }}</td>
                                @for ($s = 0; $s < count($room_sum); $s++)
                                    <td>  
                                        @if ($seer_room[$i][$s][0]->total_qnt !== null)
                                                ({{  number_format($seer_room[$i][$s][0]->total_qnt , 3, '.', '') }})
                                        @else
                                            <span></span>
                                        @endif
                                        @if ($seer_room[$i][$s][0]->moves_count !== 0)
                                            <span style="color: blue">
                                                ({{ $seer_room[$i][$s][0]->moves_count }})</span>
                                        @else
                                            <span>----</span>
                                        @endif
                                    </td>

                                @endfor
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        @endif
        {{-- @if ($hla_sum->where('hla1', '!=', 'بدون حِلل')->count() != 0)
            <table class="blue__detail small">
                <thead>
                    <tr>
                        <th>رقم الحله</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hla_sum as $hla)
                        @if ($hla->hla1 != 'بدون حِلل')
                            <tr>
                                <td>{{ $hla->hla1 }}</td>
                                <td>{{ $hla->moves_count }}</td>
                                <td>{{ $hla->total_qnt }}</td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($hla2_sum as $hla2)
                        @if ($hla2->hla2 != 'بدون حِلل')
                            <tr>
                                <td>{{ $hla2->hla2 }}</td>
                                <td>{{ $hla2->moves_count }}</td>
                                <td>{{ $hla2->total_qnt }}</td>
                            </tr>
                        @endif
                    @endforeach
        </tbody>
        </table>
        @endif --}}
        @if ($crane_sum->where('crane', '!=', 'بدون أوناش')->count() != 0)
            <table class="blue__detail small table" id="">
                <thead>
                    <tr>
                        <th>رقم الونش</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($crane_sum as $crane)
                        @if ($crane->crane != 'بدون أوناش')
                            <tr>
                                <td>{{ $crane->crane }}</td>
                                <td>{{ $crane->moves_count }}</td>
                                <td>{{number_format($crane->total_qnt , 3, '.', '')   }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($crane_sum->where('crane', '!=', 'بدون أوناش')->count() != 0)
            <table class="blue__detail small table">
                <thead>
                    <tr>
                        <th>رقم الونش</th>
                        @foreach ($room_sum as $room)
                            <th>{{ $room->room_no }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>



                    @for ($i = 0; $i < $crane_sum->count(); $i++)
                        @if ($crane_sum[$i]->crane != 'بدون أوناش')
                            <tr>
                                <td>{{ $crane_sum[$i]->crane }}</td>
                                @for ($s = 0; $s < count($room_sum); $s++)
                                    <td>
                                        @if ($crane_room[$i][$s][0]->total_qnt !== null)
                                                ({{  number_format($crane_room[$i][$s][0]->total_qnt , 3, '.', '') }})
                                        @else
                                            <span></span>
                                        @endif
                                        @if ($crane_room[$i][$s][0]->moves_count !== 0)
                                            <span style="color: blue">
                                                ({{ $crane_room[$i][$s][0]->moves_count }})</span>
                                        @else
                                            <span>----</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        @endif
        @if ($kbsh_sum->where('kbsh', '!=', 'بدون كباشات أوناش')->count() != 0)
            <table class="blue__detail small table">
                <thead>
                    <tr>
                        <th>رقم الكباش</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kbsh_sum as $kbsh)
                        @if ($kbsh->kbsh != 'بدون كباشات أوناش')
                            <tr>
                                <td>{{ $kbsh->kbsh }}</td>
                                <td>{{ $kbsh->moves_count }}</td>
                                <td>{{number_format($kbsh->total_qnt, 3, '.', '')  }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($store_no_sum->count() != 0)
            <table class="orange__detail small table">
                <thead>
                    <tr>
                        <th>رقم المخزن</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($store_no_sum as $store_no)
                        <tr>
                            <td>{{ $store_no->store_no }}</td>
                            <td>{{ $store_no->moves_count }}</td>
                            <td>{{number_format($store_no->total_qnt , 3, '.', '') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($type_sum->count() != 0)
            <table class="orange__detail small table">
                <thead>
                    <tr>
                        <th>الصنف</th>
                        <th>عدد النقلات</th>
                        <th>اجمالي الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($type_sum as $type)
                        <tr>
                            <td>{{ $type->type }}</td>
                            <td>{{ $type->moves_count }}</td>
                            <td>{{ number_format($type->total_qnt , 3, '.', '')  }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($type_sum->count() != 0)
            <table class="orange__detail small table">
                <thead>
                    <tr>
                        <th>الصنف</th>
                        @foreach ($room_sum as $room)
                            <th>{{ $room->room_no }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < $type_sum->count(); $i++)
                        @if ($type_sum[$i]->type)
                            <tr>
                                <td>{{ $type_sum[$i]->type }}</td>
                                @for ($s = 0; $s < count($room_sum); $s++)
                                    <td> 
                                        @if ($type_room[$i][$s][0]->total_qnt !== null)
                                                ({{  number_format($type_room[$i][$s][0]->total_qnt , 3, '.', '') }})
                                        @else
                                            <span></span>
                                        @endif
                                        @if ($type_room[$i][$s][0]->moves_count !== 0)
                                            <span style="color: blue">
                                                ({{ $type_room[$i][$s][0]->moves_count }})</span>
                                        @else
                                            <span>----</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endif
                    @endfor
                </tbody>
            </table>
        @endif
        @canView('stats_cars')
        @NoAccessWithType(['client'])
        @if ($cars->count() != 0)
            <table class="green__detail small table black">
                <thead>
                    <tr>
                        <th>المقاول</th>
                        <th>عدد </th>
                        <th >  الآن</th>
                        <th>  نقلات </th>
                        <th>  الكمية </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($car_owners as $car_owner)
                        <tr>
                            <td>{{ $car_owner->car_owner }}</td>
                            <td>{{ $car_owner->limits }}</td>
                            <td>{{ $car_owner->now }}</td>
                            <td>{{ $car_owner->vacant }}</td>
                            <td>{{  number_format($car_owner->mehwer , 3, '.', '')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if ($cars->count() != 0)
            <table class="total__cars__quantity table">
                <thead>
                    <tr>
                        <th>كود </th>
                        <th>رقم السيارة</th>
                        <th>النوع</th>
                        <th>المقاول</th>
                        <th>نقلات</th>
                        <th>الكميه</th>
                        <th>المتوسط</th>
                        <th>رقم الحله</th>
                        <th>وزن المحاور</th>
                        <th>وزن الفارغ </th>
                        <th>حد الحمولة</th>
                        <th>دخول</th>
                        <th>خروج</th>
                    </tr>
                </thead>
                <tbody>
                    @php $color = '';@endphp
                    @foreach ($cars as $car)
                        @if ($car->status == 'خرجت')
                            @php
                                $color = '#ff000070  !important';
                            @endphp
                        @else
                            @php
                                $color = '#FFFFFF82  !important';
                            @endphp
                        @endif
                        <tr style="background-color: {{ $color }}">
                            <td><span class="count__moves">{{ $car->sn }}</span></td>
                            <td><span class="count__moves">{{ $car->car_no }}</span></td>
                            <td><span class="count__moves">{{ $car->car_type }}</span></td>
                            <td><span class="count__moves">{{ $car->car_owner }}</span></td>
                            <td><span class="count__moves">{{ $car->moves_count }}</span></td>
                            <td><span class="count__moves">{{ $car->qnts }}</span></td>
                            <td><span class="count__moves">{{ $car->avg }}</span></td>
                            <td><span class="count__moves">{{  $car->hla }}</span></td>
                            <td><span class="count__moves">{{ number_format($car->mehwer , 3, '.', '')  }}</span></td>
                            <td><span class="count__moves">{{number_format($car->vacant , 3, '.', '') }}</span></td>
                            <td><span class="count__moves">{{number_format($car->limits , 3, '.', '')  }}</span></td>
                            <td><span class="count__moves">{{ $car->start_date }}</span></td>
                            <td><span class="count__moves">{{ $car->exit_date }}</span></td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @enduserType
        @endcanView
    </div>
    <script>
        $('.total__cars__quantity').DataTable({
            responsive: true,
            bLengthChange: false,
            searching: false,
            bPaginate: false,
            bInfo: false,
            ordering: false
        });
    </script>

</body>

</html>
