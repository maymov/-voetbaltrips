<html>
<head>
    <title>Invoice</title>
    <style type="text/css">
        #page-wrap {
            width: 700px;
            margin: 0 auto;
        }
        .center-justified {
            text-align: justify;
            margin: 0 auto;
            width: 30em;
        }
        table.outline-table {
            border: 1px solid;
            border-spacing: 0;
        }
        tr.border-bottom td, td.border-bottom {
            border-bottom: 1px solid;
        }
        tr.border-top td, td.border-top {
            border-top: 1px solid;
        }
        tr.border-right td, td.border-right {
            border-right: 1px solid;
        }
        tr.border-right td:last-child {
            border-right: 0px;
        }
        tr.center td, td.center {
            text-align: center;
            vertical-align: text-top;
        }
        td.pad-left {
            padding-left: 5px;
        }
        tr.right-center td, td.right-center {
            text-align: right;
            padding-right: 50px;
        }
        tr.right td, td.right {
            text-align: right;
        }
        .grey {
            background:grey;
        }
    </style>
</head>
<body>
<div id="page-wrap">
    <table width="100%">
        <tbody>
        <tr>
            <td width="30%">
                {{--<img src="{{asset('assets/images/logo.png')}}"> <!-- your logo here -->--}}
                Voetbaltrips
            </td>
            <td width="70%">
                <h2>Factuur</h2><br>
                <strong>Datum:</strong> <?php echo date('d/M/Y');?><br>
                <strong>Factuurnummer:</strong> {!! $invoice->id !!}<br>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="left">
                    <strong>Aan:</strong> Persoon
                    <strong>Bedrag:</strong> &euro; 300
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <table width="100%" class="outline-table">
        <tbody>
        <tr class="border-bottom border-right grey">
            <td colspan="3"><strong>Voetbaltrip</strong></td>
        </tr>
        <tr class="border-bottom border-right center">
            <td width="60%"><strong>Onderdeel</strong></td>
            <td width="20%"><strong>BTW</strong></td>
            <td width="20%"><strong>Bedrag (EURO)</strong></td>
        </tr>

        @foreach($invoice->lines as $invoiceLine)

        <tr class="border-right">
            <td class="pad-left">{!! $invoiceLine->product_amount !!} {!! $invoiceLine->product_title !!}</td>
            <td class="center">BTW (21%)</td>
            <td class="right-center">&euro; {!! $invoiceLine->product_price !!}</td>
        </tr>
        @endforeach
        <tr class="border-right">
            <td class="pad-left">&nbsp;</td>
            <td class="right border-top">Subtotaal</td>
            <td class="right border-top">&euro; {{ $invoice_total_excl }}</td>
        </tr>
        <tr class="border-right">
            <td class="pad-left">&nbsp;</td>
            <td class="right border-top">BTW</td>
            <td class="right border-top">&euro; {{ $invoice_total_vat }}</td>
        </tr>
        <tr class="border-right">
            <td class="pad-left">&nbsp;</td>
            <td class="right border-top">Totaal</td>
            <td class="right border-top">&euro; {{ $invoice_total_incl }}</td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>


    <table width="100%">
        <tbody>
        <tr>
            <td width="50%">
                <div class="center-justified">
                    <strong>Gegevens</strong><br>
                    <strong>Bankrekening:</strong> 234234234<br>
                    <strong>Belastingnummer:</strong> 2012343434<br>
                </div>
            </td>
            <td width="50%">
                <div class="center-justified">
                    <strong>Adres</strong><br>
                    Straat<br>
                    Dordrecht<br>
                    </div>
            </td>
        </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <table>
        <tbody>
        <tr>
            <td>
               Wij wensen u een prettig verblijf en een spannende wedstrijd.
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>