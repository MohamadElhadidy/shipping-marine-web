@foreach ($vessels as $vessel)
    @canView($vessel->vessel_id)
    <table class="blue__detail small" onclick="javascript:location.href='vessels/{{ $vessel->vessel_id }}'">
        <tr>
            <td class='head'> اسم الباخره </td>
            <td>{{ $vessel->name }} </td>
        </tr>
        <tr>
            <td class='head'>الصنف</td>
            <td>{{ $vessel->type }}</td>
        </tr>
        <tr>
            <td class='head'>العميل</td>
            <td>{{ $vessel->client }}</td>
        </tr>

        <tr>
            <td class='head'>الكمية</td>
            <td> {{ $vessel->qnt }} طن </td>
        </tr>
        <tr>
            <td class='head'>رقم الرصيف</td>
            <td>{{ $vessel->quay }}</td>
        </tr>
        <tr>
            <td class='head'>مُدة التشغيل</td>
            <td style="height:25px;">    {{ $vessel->hours }}  ساعة </td>
        </tr>
        <tr>
            <td class='head'>السيارات الحالية</td>
            <td class="moves">{{ $vessel->done }}
            </td>
        </tr>
        <tr>
            <td class='head'>نقلات شُحِنت</td>
            <td class="moves">{{ $vessel->notes }}
            </td>
        </tr>
        <tr>
            <td class='head'> الرصيد الأن </td>
            <td class="qnt"><span style="color: red;">{{ $vessel->quantity }}</span>
                <span>{{ $vessel->archive }}</span>
                <span style="color: #054605;">{{ $vessel->phones }}</span>
            </td>
        </tr>
    </table>
    @endcanView
@endforeach
