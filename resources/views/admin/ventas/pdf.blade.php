<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
            color: #333
        }

        .table {
            width: 100%,
                margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #000000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }

        .table-bordered thead th {
            border-bottom-width: 2px;
        }
    </style>
    <title>ExpertSell</title>
</head>

<body>
    <div style="border: 1px solid #000000; border-bottom: none;">
        <p style="text-align: center; font-size: 14pt; margin: 0; padding: 10px 0;"><b>ORIGINAL</b></p>
    </div>

    <table style="border: 1px solid #000000; border-bottom: none; border-collapse: collapse;" width="100%">
        <tr style="margin-top: 0px; margin-bottom: 0px;">
            <td width="310px" style="text-align: center; font-size: 12pt"><b>{{ $empresa->nombre_empresa }}</b></td>
            <td width="75px"
                style="border: 1px solid #000000; padding: 10px 0; text-align: center; vertical-align: middle;">
                <p style="font-size: 20pt; margin: 0; line-height: 1;"><b>C</b></p>
                <p style="text-align: center; margin: 0; padding-bottom: 2px;"><b>COD. 011</b></p>
            </td>
            <td width="280px" style="font-size: 16pt; padding-left: 30px;"><b>FACTURA</b></td>
        </tr>
    </table>

    <table width="100%" style="border: 1px solid #000000; border-top: none;" cellspacing="0" cellpadding="0">
        <thead>
            <th width="50%" style="border-right: 1px solid #000000"></th>
            <th width="50%"><b>Punto de Venta: 0001 &nbsp;&nbsp;&nbsp;&nbsp; Compr. Nro:
                    {{ str_pad($venta->id, 8, "0", STR_PAD_LEFT) }}</b>
            </th>
        </thead>
        <tbody>
            <tr>
                <td style="padding-left: 10px; border-right: 1px solid #000000">
                    <b>Razón Social:</b> {{ $empresa->nombre_empresa }}
                </td>
                <td style="padding-left: 55px">
                    <b>Fecha de Emisión: {{ date('d/m/Y', strtotime($venta->fecha)) }}</b>
                </td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #000000">&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp; </td>
            </tr>
            <tr>
                <td style="padding-left: 10px; border-right: 1px solid #000000"><b>Domicilio Comercial:
                    </b>{{ $empresa->direccion }}</td>
                <td style="padding-left: 55px"><b>CUIT: </b>{{ $empresa->identificacion_tributaria }}</td>
            </tr>
            <tr>
                <td style="border-right: 1px solid #000000">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="padding-left: 55px"><b>Ingresos Brutos: </b> {{ $empresa->identificacion_tributaria }}</td>
            </tr>
            <tr>
                <td style="padding-left: 10px; border-right: 1px solid #000000"><b>Condición Frente al IVA: Responsable
                        Monotributo</b></td>
                <td style="padding-left: 55px"><b>Fecha de Inicio de Actividades:
                    </b>{{ date('d/m/Y', strtotime($empresa->created_at)) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="border: 1px solid #000000; margin: 1px 0">
        <table width="100%">
            <td style="padding-left: 10px">
                <b>Período Facturado Desde: </b> {{ date('d/m/Y', strtotime($venta->fecha)) }}
            </td>
            <td>
                <b>Hasta: </b> {{ date('d/m/Y', strtotime($venta->fecha)) }}
            </td>
            <td>
                <b>Fecha de Vto. para el pago: </b> {{ date('d/m/Y', strtotime($venta->fecha)) }}
            </td>
        </table>
    </div>

    <div style="border: 1px solid #000000; margin: 2px 0">
        <table width="100%">
            <td width="35%" style="padding-left: 10px">
                <b>CUIT/CUIL: </b> {{ $venta->cliente->identificacion_tributaria }}
            </td>
            <td width="65%" style="padding-left: 25px">
                <b>Apellido y Nombre / Razón Social:</b> {{ $venta->cliente->nombre_cliente }}
            </td>
        </table>
        <table width="100%">
            <td width="50%" style="padding-left: 10px">
                <b>Condición frente al IVA: </b> Consumidor Final
            </td>
            <td width="50%" style="padding-left: 35px">
                <b>Domicilio: </b>
            </td>
        </table>
        <table width="100%">
            <td width="50%" style="padding-left: 10px;">
                <b>Condición de Venta: </b> Contado
            </td>
            <td width="50%" style="padding-left: 35px;">
                <b>Remito: </b> 0001-{{ str_pad($venta->id, 8, "0", STR_PAD_LEFT) }}
            </td>
        </table>
    </div>
    @php $cantidad = 0;
    $total = 0; @endphp
    <table cellspacing="0" cellpadding="0">
        <thead style="font-size: 7pt; ">
            <th width="20px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>Código</b></th>
            <th width="180px" scope="col"
                style="background-color: #cccccc;text-align: left; padding-left: 5px; border: 1px solid #000000;">
                <b>Producto / Servicio</b></th>
            <th width="70px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>Cantidad</b></th>
            <th width="80px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>U. Medida</b></th>
            <th width="90px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>Precio Uni.</b></th>
            <th width="40px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>% Bonif</b></th>
            <th width="70px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>Imp. Bonif.</b></th>
            <th width="80px" scope="col"
                style="background-color: #cccccc;text-align: center; border: 1px solid #000000;"><b>Subtotal</b></th>
        </thead>
        <tbody style="font-size: 7pt">
            @foreach ($venta->detalles as $detalle)
                <tr>
                    <td style="text-align: center">{{ $detalle->producto->codigo }}</td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td style="text-align: right">{{ $detalle->cantidad }}</td>
                    <td style="text-align: center"> unidades </td>
                    <td style="text-align: right">{{ $detalle->producto->precio_venta }}</td>
                    <td style="text-align: center"> 0,00 </td>
                    <td style="text-align: right"> 0,00 </td>
                    <td style="text-align: right">
                        {{ $costo = $detalle->producto->precio_venta * $detalle->cantidad }}
                    </td>
                </tr>
                @php
                    $cantidad += $detalle->cantidad;
                    $total += $costo;
                @endphp
            @endforeach
        </tbody>
    </table>
    
    <div style="position: absolute; bottom: 0; width: 100%; height: 250px;">
        <div style="border: 1px solid #000000; margin: 1px 0; padding-bottom: 10px; paddin-top: 10px;">
            <table width="100%">
                <tr>
                    <td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="38%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="12%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="38%" style="text-align: right;"><b>Subtotal: $</b></td>
                    <td width="12%" style="text-align: right; padding-right: 10px;"><b>{{ $total }}</b></td>
                </tr>
                <tr>
                    <td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="38%" style="text-align: right;"><b>Importe Otros Tributos: $</b></td>
                    <td width="12%" style="text-align: right; padding-right: 10px;"><b>0,00</b></td>
                </tr>
                <tr>
                    <td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="38%" style="text-align: right; "><b>Importe Total: $</b></td>
                    <td width="12%" style="text-align: right; padding-right: 10px;"><b>{{ $total }}</b></td>
                </tr>
            </table>
        </div>

    <table width="100%" style="vertical-align: bottom; margin-top: 30px;">
        <tr>
            <!--
            <td width="50%" style="text-align: left;">
                <img src="{{ public_path('img/logo_arca.png') }}" style="width: 120px; margin-bottom: 5px;"><br>
                <p style="font-size: 7pt; color: #555; margin: 5px 0;">Comprobante Autorizado</p>
                
                <img src="https://chart.googleapis.com" 
                    style="border: 1px solid #ccc; padding: 3px;">
            </td>
            -->

            <td width="50%" style="text-align: right; font-size: 9pt; padding-bottom: 10px;">
                <p style="margin: 2px 0;"><b>CAE N°: </b> 71021234567890</p>
                <p style="margin: 2px 0;"><b>Fecha de Vto. de CAE: </b> {{ date('d/m/Y', strtotime('+10 days')) }}</p>
            </td>
        </tr>
    </table>
    </div>
</body>

</html>