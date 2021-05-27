
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
<title>Documento sin título</title>
<style>
  table, td, th {
    border: 1px solid black;
    font-size: x-small;
  }
  
  table {
    border-collapse: collapse;
    width: 50%;
  }
  
  th {
   
    text-align: left;
  }
  </style>
</head>

<body>


  <br><br><br><br><br><br><br><br><br>
  <h6 style="color: black">FACTURA NRO: {{ str_pad($expense->id, 6, "0", STR_PAD_LEFT)}}</h6>

 
   
 
<table>
  <tr>
    <th style="font-weight: normal; width: 40%;">Concesión Postal:</th>
    <th style="">N 10-000</th>
   
  </tr>
  <tr>
    @if (isset($expense->credit_days))
      <td style="width: 40%;">Fecha de Emisión:</td>
      <td style="">{{ $expense->date_billing }} | Dias de Crédito: {{ $expense->credit_days }}</td>
    
    @else
      <td style="width: 40%;">Fecha de Emisión:</td>
      <td style="">{{ $expense->date_billing }}</td>
    @endif
    
  </tr>
  
</table>




<table style="width: 100%;">
  <tr>
    <th style="font-weight: normal; ">Nombre / Razón Social: &nbsp;  {{ $expense->clients['name'] }}</th>
  </tr>
  <tr>
    <td >Domicilio Fiscal: &nbsp;  {{ $expense->clients['direction'] }}</td>
  </tr>
  
</table>




<table style="width: 100%;">
  <tr>
    <th style="text-align: center; " >Teléfono</th>
    <th style="text-align: center; ">RIF/CI</th>
    <th style="text-align: center; ">N° Control / Serie</th>
    <th style="text-align: center; ">Nota de Entrega</th>
    <th style="text-align: center; ">Transporte</th>
   
  </tr>
  <tr>
    <td style="text-align: center; ">{{ $expense->clients['phone1'] }}</td>
    <td style="text-align: center; ">{{ $expense->clients['cedula_rif'] }}</td>
    <td style="text-align: center; ">{{ $expense->serie }}</td>
    <td style="text-align: center; ">{{ $expense->note }}</td>
    <td style="text-align: center; ">{{ $expense->transports['placa'] }}</td>
    
    
  </tr>
  
</table>

<table style="width: 100%;">
  <tr>
  <th style="font-weight: normal; ">Observaciones: &nbsp; {{ $expense->observation }} </th>
</tr>
  
</table>
  @if (empty($payment_expenses))
      

      <br>
      <table style="width: 100%;">
        <tr>
          <th style="text-align: center; width: 100%;">Condiciones de Pago</th>
        </tr> 
      </table>

      <table style="width: 100%;">
        <tr>
          <th style="text-align: center; ">Tipo de Pago</th>
          <th style="text-align: center; ">Cuenta</th>
          <th style="text-align: center; ">Referencia</th>
          <th style="text-align: center; ">Dias de Credito</th>
          <th style="text-align: center; ">Monto</th>
        </tr>

        @foreach ($payment_expenses as $var)
        <tr>
          <th style="text-align: center; font-weight: normal;">{{ $var->payment_type }}</th>
          @if (isset($var->accounts['description']))
            <th style="text-align: center; font-weight: normal;">{{ $var->accounts['description'] }}</th>
          @else    
            <th style="text-align: center; font-weight: normal;"></th>
          @endif
          <th style="text-align: center; font-weight: normal;">{{ $var->reference }}</th>
          <th style="text-align: center; font-weight: normal;">{{ $var->credit_days }}</th>
          <th style="text-align: center; font-weight: normal;">{{ number_format($var->amount, 2, ',', '.')}}</th>
        </tr> 
        @endforeach 
        
      </table>
  @endif
<br>
<table style="width: 100%;">
  <tr>
    <th style="text-align: center; width: 100%;">Productos</th>
  </tr> 
</table>
<table style="width: 100%;">
  <tr>
    <th style="text-align: center; ">Código</th>
    <th style="text-align: center; ">Descripción</th>
    <th style="text-align: center; ">Cantidad</th>
    <th style="text-align: center; ">P.V.J.</th>
    <th style="text-align: center; ">Desc</th>
    <th style="text-align: center; ">Total</th>
  </tr> 
  @foreach ($inventories_expenses as $var)
      <?php
      $percentage = (($var->price * $var->amount_expense) * $var->discount)/100;

      $total_less_percentage = ($var->price * $var->amount_expense) - $percentage;
      ?>
    <tr>
      <th style="text-align: center; font-weight: normal;">{{ $var->code_comercial }}</th>
      <th style="text-align: center; font-weight: normal;">{{ $var->description }}</th>
      <th style="text-align: center; font-weight: normal;">{{ number_format($var->amount_expense, 0, '', '.') }}</th>
      <th style="text-align: center; font-weight: normal;">{{ number_format($var->price, 2, ',', '.')  }}</th>
      <th style="text-align: center; font-weight: normal;">{{ $var->discount }}%</th>
      <th style="text-align: right; font-weight: normal;">{{ number_format($total_less_percentage, 2, ',', '.') }}</th>
    </tr> 
  @endforeach 
</table>


<?php
  $iva = ($expense->base_imponible * $expense->iva_percentage)/100;

  $total = $expense->sub_total_factura + $iva;

  $total_petro = ($total - $expense->anticipo)/ 159765192.04;
?>

<table style="width: 100%;">
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">Sub Total</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($expense->sub_total_factura, 2, ',', '.') }}</th>
  </tr> 
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">Base Imponible</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($expense->base_imponible, 2, ',', '.') }}</th>
  </tr> 
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">Ventas Exentas</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($expense->ventas_exentas, 2, ',', '.') }}</th>
  </tr> 
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">I.V.A.{{ $expense->iva_percentage }}%</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($iva, 2, ',', '.') }}</th>
  </tr> 
  @if ($expense->anticipo != 0)
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">Anticipo</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($expense->anticipo, 2, ',', '.') }}</th>
  </tr> 
  @endif
 
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white;">MONTO TOTAL</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($total - $expense->anticipo, 2, ',', '.') }}</th>
  </tr> 
  <tr>
    <th style="text-align: right; font-weight: normal; width: 79%; border-bottom-color: white; font-size: small;">MONTO TOTAL Petro</th>
    <th style="text-align: right; font-weight: normal; width: 21%;">{{ number_format($total_petro, 6, ',', '.') }}</th>
  </tr> 
  <tr>
    <th style="text-align: left; font-weight: normal; width: 79%; border-top-color: rgb(17, 9, 9); border-right-color: white; "><pre>ESTA FACTURA VA SIN TACHADURAS NI ENMIENDAS        </pre></th>
    <th style="text-align: right; font-weight: normal; width: 21%; "></th>
  </tr> 
  
  
  
  
</table>

</body>
</html>
