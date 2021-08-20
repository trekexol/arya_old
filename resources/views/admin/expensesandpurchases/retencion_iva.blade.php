
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<title>Retencion Iva</title>
<style>
  table, td, th {
    border: 1px solid black;
  }
  
  table {
    border-collapse: collapse;
    width: 100%;
  }
  
  th {
    
    text-align: left;
  }
  </style>
</head>

<body>
  <br><br>
<h3 style="text-align: center;">COMPROBANTE DE RETENCIÓN AL IMPUESTO AL VALOR AGREGADO</h3>
<h5 style="">Ley IVA Art. 11: Serán responsables del pago de impuesto en calidad de agente de retención, los compradores o adquirientes de
determindados bienes muebles y los receptores de ciertos servicios, a quienes la administración tribuitaria los designe como tal
</h5>
  
<table>
  <tr>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">NOMBRE O RAZON SOCIAL DEL AGENTE DE RETENCIÓN</th>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">RIF DEL AGENTE DE RETENCIÓN</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">Nro DE COMPROBANTE</th>
  </tr>
  <tr>
    <td style="font-size: x-small;">{{ $company->razon_social ?? ''}}</td>
    <td style="font-size: x-small;">{{ $company->code_rif ?? ''}}</td>
    <td style="font-size: x-small;">{{ $expense->id ?? ''}}</td>
  </tr>
  
</table>
<br>
<table>
  <tr>
    <th style="font-size: x-small; width: 80%; border-bottom-color: white;">DIRECCIÓN FISCAL DEL AGENTE DE RETENCIÓN</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">FECHA DE EMISIÓN</th>
  </tr>
  <tr>
    <td style="font-size: x-small;">{{ $company->address ?? ''}}</td>
    <td style="font-size: x-small;">{{ $datenow ?? ''}}</td>
  </tr>
  
</table>
<br>
<table>
  <tr>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">NOMBRE O RAZON SOCIAL DEL SUJETO RETENIDO</th>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">RIF DEL SUJETO RETENIDO</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">PERIODO FISCAL</th>
  </tr>
  <tr>
    <td style="font-size: x-small;">{{ $provider->razon_social ?? ''}}</td>
    <td style="font-size: x-small;">{{ $provider->code_provider ?? ''}}</td>
    <td style="font-size: x-small;">{{ $period ?? ''}}</td>
  </tr>
  
</table>
<br>
<table>
  <tr>
    <th style="font-size: x-small; width: 80%; border-bottom-color: white;">DIRECCION DEL SUJETO RETENIDO</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">TELÉFONOS DEL SUJETO RETENIDO</th>
  </tr>
  <tr>
    <td style="font-size: x-small;">{{ $provider->city ?? ''}} , {{ $provider->direction ?? ''}}</td>
    <td style="font-size: x-small;">{{ $provider->phone1 ?? ''}} / {{ $provider->phone2 ?? ''}}</td>
  </tr>
  
</table>

<table>
  <tr>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">Oper</th>
    <th style="font-size: x-small; width: 40%; border-bottom-color: white;">Fecha</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">No Factura</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">No Control Serie</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">No Nota Debito</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">No Nota Crédito</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">No Factura Afectada</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">Total Compra</th>
    <th style="font-size: x-small; width: 20%; border-bottom-color: white;">Compra sin Derecho a Crédito Fiscal</th>
  </tr>
  <tr>
    <td style="font-size: x-small;">{{ $provider->razon_social ?? ''}}</td>
    <td style="font-size: x-small;">{{ $provider->code_provider ?? ''}}</td>
    <td style="font-size: x-small;">{{ $period ?? ''}}</td>
  </tr>
  
</table>
</body>
</html>
