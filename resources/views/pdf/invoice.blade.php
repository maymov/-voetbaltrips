<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<style>
    .page-break {
        page-break-after: always;
    }
</style>
<table style="width:100%">
    <tbody>
        <tr>
            <th>
                {{ $full_name }}
            </th>
            <td rowspan="3" align="right">
                <img style="height: 100px" src="{{asset('assets/images/facebook-cover2.png')}}">
            </td>
        </tr>
        <tr>
            <td>
                {{$address}}
            </td>
        </tr>
        <tr>
            <td>
                {{$postal}} {{$city}}
            </td>
        </tr>
    </tbody>
</table>
<br />
<br />
<table style="width:100%">
    <tbody>
        <tr>
            <td><h2>Factuur {{$invoice_id}}</h2></td>
        </tr>
        <tr>
            <td valign="top" rowspan="6">Factuurdatum: {{$order_date}}</td>
            <th align="right">Online City Travel</th>
        </tr>
        <tr><td align="right">Herculesplein 25</td></tr>
        <tr><td align="right">3584AA Utrecht</td></tr>
        <tr><td align="right">Nederland</td></tr>
        <tr><td align="right">030-3690059</td></tr>

    </tbody>
</table>
<br />
<br />
<table style="width:100%">
<?php $subtotal        = 0; ?>
<?php
    $subtotalBedragPP  = 0;
    if (isset($hotel->price)) {
        $subtotalBedragPP += $hotel->price;
    }
    if (isset($match->price)) {
        $subtotalBedragPP += $match->price;
    }
    if (isset($flight[0]->price)) {
        $subtotalBedragPP += $flight[0]->price;
    }
    if (isset($flight[0]->price)) {
        $subtotalBedragPP += $flight[1]->price;
    }
    if (isset($hotel->quantity)) {
        $totalBedrag = $subtotalBedragPP * $hotel->quantity;
    } else {
        $totalBedrag = $subtotalBedragPP;
    }

    $subtotalBedragPP  = floatval($subtotalBedragPP);
    $totalBedrag       = floatval($totalBedrag);
?>

    <tr align="left">
        <th style="border-bottom: 1px solid lightgrey;">Omschrijving</th>
        <th style="border-bottom: 1px solid lightgrey; text-align: center;">Aantal</th>
        <th style="border-bottom: 1px solid lightgrey; text-align: center;">Bedrag p.p.</th>
        <th style="border-bottom: 1px solid lightgrey; text-align: center;">Totaal</th>
    </tr>
    @if(isset($match) && isset($hotel) && isset($flight))
        <tr align="left">
            <td style="border-bottom: 1px solid lightgrey">{{$match->home_club}} - {{$match->away_club}}</td>
            <td rowspan="4" style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold">{{$match->quantity}}</td>
            <td rowspan="4" style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold"><?php echo "&euro;".$subtotalBedragPP ?></td>
            <td rowspan="4" style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold"><?php echo "&euro;".$totalBedrag ?></td>
        </tr>
        <?php $subtotal += $match->quantity * $match->price; ?>
    @elseif(isset($match))
        <tr align="left">
            <td style="border-bottom: 1px solid lightgrey">{{$match->home_club}} - {{$match->away_club}}</td>
            <td style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold">{{$match->quantity}}</td>
            <td style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold"></td>
            <td style="border-bottom: 1px solid lightgrey; text-align: center; font-weight: bold">{{$total}}</td>
        </tr>
        <?php $subtotal += $total; ?>
    @endif
    @if(isset($hotel))
        <tr align="left">
            <td style="border-bottom: 1px solid lightgrey">{{$hotel->hotel_name}}</td>
        </tr>
        <?php $subtotal += $hotel->quantity * $hotel->price; ?>
    @endif
    @if(isset($flight))
        @foreach($flight as $flight)
            <tr align="left">
                <td style="border-bottom: 1px solid lightgrey">{{$flight->departure_airport}} - {{$flight->arrival_airport}}</td>
            </tr>
            <?php $subtotal += $flight->quantity * $flight->price; ?>
        @endforeach
    @endif
    @if(isset($options))
        @foreach($options as $option)
            <?php $subtotal += $option->quantity * $option->price; ?>
        @endforeach
    @endif
    <tr>
        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
    </tr>
    <tr align="left">
        <td colspan="2" style="border-bottom: 1px solid lightgrey" align="center">*Bijzondere regeling reisbureaus</td>
        <th style="border-bottom: 1px solid lightgrey">Subtotaal</th>
        <th style="border-bottom: 1px solid lightgrey">Totaal</th>
    </tr>

    <tr align="left">
        <td></td>
        <td></td>
        <td><?php if ($subtotal == 0) {$subtotal = $total;}else {$subtotal ="&euro;".$subtotal;} echo $subtotal; ?></td>
        <td>{{$total}}</td>
    </tr>

</table>
    <table style="position: absolute; width: 100%; bottom: 0">
        <tr>
            <td style="width: 33%;" align="center">KvK-nummer: 57257817</td>
            <td style="width: 33%;" align="center">BTW-nummer: NL852504561B01</td>
            <td style="width: 34%;" align="center">IBAN NL02 INGB0006702490</td>
        </tr>
    </table>
</body>
</html>
