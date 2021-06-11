
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="{{asset('vendor/sb-admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Prestaciones</title>
<style>
  body{
    background: white;
  }
  table, td, th {
    border: 1px solid black;
    background: white;
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
  <div class="text-center h4">RECIBO DE PRESTACIONES ACUMULADAS</div>

 
   
 
<table style="width: 25%;">
  <tr>
    <th >Fecha: {{ $datenow }}</th>
</table>

<table style="width: 100%;">
  <tr>
    <th style="width: 72%; border-right: none;">Nombre de la Empresa: Empresa de Prueba</th>
    <th style="width: 28%;" class="font-weight-normal">Rif: J-11223344</th>
  </tr>
</table>



<table style="width: 100%;">
  <tr>
    <th style="width: 28%; ">Domicilio Fiscal:</th>
    <th style="width: 72%;" class="font-weight-normal"></th>
  </tr>
</table>

<table style="width: 100%;">
  <tr>
    <th  class="text-center" style="border-bottom-color: white;">Empleado</th>
    <th  class="text-center">Nombre del Trabajador:</th>
    <th  class="text-center">Cargo</th>
    <th  class="text-center">Cédula</th>
  </tr>
  <tr>
    <td class="text-center font-weight-normal"></td>
    <td class="text-center font-weight-normal">{{ $employee->nombres }} {{ $employee->apellidos}}</td>
    <td class="text-center font-weight-normal">{{ $employee->professions['description'] }}</td>
    <td class="text-center font-weight-normal">{{ $employee->id_empleado }}</td>
  </tr>  
</table>

<?php 

use Carbon\Carbon;

  $datework = Carbon::createFromDate($employee->fecha_ingreso);
  $now = Carbon::now();

  $days = $datework->diffInDays($now);
  $months = $datework->diffInMonths($now);
  $years = $datework->diffInYears($now);

  $humans = $datework->diffForHumans();

    $full = false;

    $now = new DateTime;
    $ago = new DateTime($employee->fecha_ingreso);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
         'y' => 'year',
         'm' => 'month',
         'w' => 'week',
         'd' => 'day',
         'h' => 'hour',
         'i' => 'minute',
         's' => 'second',
     );
     foreach ($string as $k => &$v) {
         if ($diff->$k) {
             $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
         } else {
             unset($string[$k]);
         }
     }

     if (!$full) $string = array_slice($string, 0, 1);
     $haber = $string ? implode(', ', $string) . ' ago' : 'just now';
 
?>



<table style="width: 100%;">
  <tr>
    <th  class="text-center" style="border-bottom-color: white;">Tiempo de Servicio</th>
    <th  class="text-center">Fecha de Ingreso</th>
    <th  class="text-center">Fecha Último Pago</th>
    <th  class="text-center">Años</th>
    <th  class="text-center">Meses</th>
    <th  class="text-center">Dias</th>
    <th  class="text-center">Motivo</th>
  </tr>
  <tr>
    <td class="text-center font-weight-normal"></td>
    <td class="text-center font-weight-normal">{{ $employee->fecha_ingreso }}</td>
    <td class="text-center font-weight-normal"></td>
    <td class="text-center font-weight-normal">{{ $years }}</td>
    <td class="text-center font-weight-normal">{{ $months }}</td>
    <td class="text-center font-weight-normal">{{ $haber }}</td>
    <td class="text-center font-weight-normal"></td>
  </tr>  
</table>

<br>
  <div class="small">El suscrito trabajador declara haber recibido de la empresa EMPRESA DEMO C.A. la cantidad por concepto de pago de Vacaciones
    correspondientes al periodo {{ date('Y', strtotime($datenow)) }}. Según lo previsto en el Acuerdo Colectivo de Trabajo y la Ley Orgánica del Trabajo,
    Las Trabajadoras y Los Trabajadores.
  </div>

  <br>
  
<div class="small">
  <div class="form-group row col-md-1">
    
    Recibe Conforme: {{ $employee->nombres }} {{ $employee->apellidos }}
  </div>
  <div class="form-group row col-md-1">
    CI: V-11223344
  </div>
  <div class="form-group row col-md-1">
      Firma: ________________________________    
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Fecha:             
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       Hora:
  </div>

  <div class="form-group row col-md-1">
    
    Elaborado Por: 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Autorizado Por:
  </div>
  <div class="form-group row col-md-1">
    Firma: ________________________________ 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Firma: ________________________________ 
  </div>
  
</div>

</body>
</html>
