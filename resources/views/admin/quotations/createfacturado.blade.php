@extends('layouts.dashboard')

@section('content')



    {{-- VALIDACIONES-RESPUESTA--}}
    @include('admin.layouts.success')   {{-- SAVE --}}
    @include('admin.layouts.danger')    {{-- EDITAR --}}
    @include('admin.layouts.delete')    {{-- DELELTE --}}
    {{-- VALIDACIONES-RESPUESTA --}}
    
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif



<div class="container" >
    <div class="row justify-content-center" >
        
            <div class="card" style="width: 70rem;" >
                <div class="card-header" >Facturar</div>
                
                <div class="card-body" >
                        <div class="form-group row">
                            <label for="date_quotation" class="col-md-2 col-form-label text-md-right">CI/Rif Cliente:</label>
                            <div class="col-md-4">
                                <input id="date_quotation" type="text" class="form-control @error('date_quotation') is-invalid @enderror" name="date_quotation" value="{{ number_format($quotation->clients['cedula_rif'], 0, ',', '.')  ?? '' }}" readonly required autocomplete="date_quotation">

                                @error('date_quotation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="client" class="col-md-2 col-form-label text-md-right">N° de Control/Serie:</label>
                            <div class="col-md-3">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $quotation->serie ?? '' }}" readonly required autocomplete="client">
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="total_factura" class="col-md-2 col-form-label text-md-right">Total Factura:</label>
                            <div class="col-md-4">
                                <input id="total_factura" type="text" class="form-control @error('total_factura') is-invalid @enderror" name="total_factura" value="{{ number_format($quotation->total_factura, 2, ',', '.') ?? 0 }}" readonly required autocomplete="total_factura">
    
                                @error('total_factura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="base_imponible" class="col-md-2 col-form-label text-md-right">Base Imponible:</label>
                            <div class="col-md-3">
                                <input id="base_imponible" type="text" class="form-control @error('base_imponible') is-invalid @enderror" name="base_imponible" value="{{ number_format($quotation->base_imponible, 2, ',', '.') ?? 0 }}" readonly required autocomplete="base_imponible">
                                @error('base_imponible')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iva_amounts" class="col-md-2 col-form-label text-md-right">Monto de Iva</label>
                            <div class="col-md-4">
                                <input id="iva_amount" type="text" class="form-control @error('iva_amount') is-invalid @enderror" name="iva_amount" value="{{ number_format($quotation->iva_amount, 2, ',', '.') ?? old('iva_amount') }}" readonly required autocomplete="iva_amount"> 
                                
                                @error('iva_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="iva" class="col-md-2 col-form-label text-md-right">IVA:</label>
                            <div class="col-md-2">
                            <select class="form-control" name="iva" id="iva">
                                <option value="16">16%</option>
                                <option value="12">12%</option>
                            </select>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="grand_totals" class="col-md-2 col-form-label text-md-right">Total General</label>
                            <div class="col-md-4">
                                <input id="grand_total" type="text" class="form-control @error('grand_total') is-invalid @enderror" name="grand_total" value="{{ number_format($quotation->iva_amount, 2, ',', '.') ?? old('grand_total') }}" readonly required autocomplete="grand_total"> 
                           
                                @error('grand_total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="anticipo" class="col-md-2 col-form-label text-md-right">Menos Anticipo:</label>
                            <div class="col-md-2">
                                <input id="anticipo" type="text" class="form-control @error('anticipo') is-invalid @enderror" name="anticipo" value="0,00" required autocomplete="anticipo"> 
                           
                                @error('anticipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="observation" class="col-md-2 col-form-label text-md-right">Retencion IVA:</label>

                            <div class="col-md-2">
                                <input id="observation" type="text" class="form-control @error('observation') is-invalid @enderror" name="observation" value="{{ old('observation') }}" readonly required autocomplete="observation">

                                @error('observation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="note" class="col-md-2 col-form-label text-md-right">Retencion ISLR:</label>

                            <div class="col-md-2">
                                <input id="note" type="number" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" readonly required autocomplete="note">

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total_pays" class="col-md-2 col-form-label text-md-right">Total a Pagar</label>
                            <div class="col-md-4">
                                <input id="total_pay" type="text" class="form-control @error('total_pay') is-invalid @enderror" name="total_pay" readonly  required autocomplete="total_pay"> 
                           
                                @error('total_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
            <form method="POST" action="{{ route('quotations.storefactura') }}" enctype="multipart/form-data">
                @csrf   

                        <input type="hidden" name="id_quotation" value="{{$quotation->id}}" readonly>
                        
                        <div class="form-group row">
                            <label for="amount_pays" class="col-md-2 col-form-label text-md-right">Forma de Pago:</label>
                            <div class="col-md-3">
                                <input id="amount_pay" type="text" class="form-control @error('amount_pay') is-invalid @enderror" name="amount_pay" placeholder="Monto del Pago" required autocomplete="amount_pay"> 
                           
                                @error('amount_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="col-md-3">
                                    <select  id="payment_type"  name="payment_type" class="form-control">
                                        <option selected value="0">Seleccione una Opción</option>
                                        <option value="1">Cheque</option>
                                        <option value="2">Contado</option>
                                        <option value="3">Contra Anticipo</option>
                                        <option value="4">Crédito</option>
                                        <option value="5">Depósito Bancario</option>
                                        <option value="6">Efectivo</option>
                                        <option value="7">Indeterminado</option>
                                        <option value="8">Tarjeta Coorporativa</option>
                                        <option value="9">Tarjeta de Crédito</option>
                                        <option value="10">Tarjeta de Débito</option>
                                        <option value="11">Transferencia</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select  id="account_bank"  name="account_bank" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_bank as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <select  id="account_efectivo"  name="account_efectivo" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_efectivo as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <select  id="account_punto_de_venta"  name="account_punto_de_venta" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_punto_de_venta as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <input id="credit_days" type="text" class="form-control @error('credit_days') is-invalid @enderror" name="credit_days" placeholder="Dias de Crédito" autocomplete="credit_days"> 
                           
                                    @error('credit_days')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                                    <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" placeholder="Referencia" autocomplete="reference"> 
                           
                                    @error('reference')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                               
                        </div>
                        <div id="formulario2" class="form-group row">
                                <label for="amount_pay2s" class="col-md-2 col-form-label text-md-right">Forma de Pago:</label>
                                <div class="col-md-3">
                                    <input id="amount_pay2" type="text" class="form-control @error('amount_pay2') is-invalid @enderror" name="amount_pay2" placeholder="Monto del Pago"  autocomplete="amount_pay2"> 
                            
                                    @error('amount_pay2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
                                <div class="col-md-3">
                                    <select  id="payment_type2"  name="payment_type2" class="form-control">
                                        <option selected value="0">Seleccione una Opción</option>
                                        <option value="1">Cheque</option>
                                        <option value="2">Contado</option>
                                        <option value="3">Contra Anticipo</option>
                                        <option value="4">Crédito</option>
                                        <option value="5">Depósito Bancario</option>
                                        <option value="6">Efectivo</option>
                                        <option value="7">Indeterminado</option>
                                        <option value="8">Tarjeta Coorporativa</option>
                                        <option value="9">Tarjeta de Crédito</option>
                                        <option value="10">Tarjeta de Débito</option>
                                        <option value="11">Transferencia</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select  id="account_bank2"  name="account_bank2" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_bank as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <select  id="account_efectivo2"  name="account_efectivo2" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_efectivo as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <select  id="account_punto_de_venta2"  name="account_punto_de_venta2" class="form-control">
                                        <option selected value="0">Seleccione una Opcion</option>
                                        @foreach($accounts_punto_de_venta as $account)
                                                <option  value="{{$account->id}}">{{ $account->description }}</option>
                                           @endforeach
                                       
                                    </select>
                                    <input id="credit_days2" type="text" class="form-control @error('credit_days2') is-invalid @enderror" name="credit_days2" placeholder="Dias de Crédito" autocomplete="credit_days2"> 
                           
                                    @error('credit_days2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                                    <input id="reference2" type="text" class="form-control @error('reference2') is-invalid @enderror" name="reference2" placeholder="Referencia" autocomplete="reference2"> 
                           
                                    @error('reference2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                        </div>
                       
                        
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                           
                            <div class="col-md-2">
                                <a href="" id="btnimprimir" name="btnimprimir" class="btn btn-info" title="imprimir">Imprimir Factura</a>  
                            </div>
                            <div class="col-md-4">
                                <a href="" id="btnfacturar" name="btnfacturar" class="btn btn-success" title="facturar">Imprimir Factura Media Carta</a>  
                            </div>
                            <div class="col-md-2">
                                <a href="" id="btnfacturar" name="btnfacturar" class="btn btn-danger" title="facturar">Volver</a>  
                            </div>
                        </div>
                        
                    </form>    
                </div>
            </div>
        </div>
</div>
@endsection

@section('javascript')

<script>
    $("#account_bank").hide();
    $("#account_efectivo").hide();
    $("#credit_days").hide();
    $("#reference").hide();
    $("#account_punto_de_venta").hide();

   
    $("#payment_type").on('change',function(){
        let inputPayment = document.getElementById("payment_type").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank").show();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").show();
            $("#account_punto_de_venta").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank").hide();
            $("#credit_days").show();
            $("#account_efectivo").hide();
            $("#reference").hide();
            $("#account_punto_de_venta").hide();

        }else if(inputPayment == 5){

            $("#account_bank").show();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").show();
            $("#account_punto_de_venta").hide();

        }else if(inputPayment == 6){

            $("#account_bank").hide();
            $("#credit_days").hide();
            $("#account_efectivo").show();
            $("#reference").hide();
            $("#account_punto_de_venta").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank").hide();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").hide();
            $("#account_punto_de_venta").show();

        }else{
            $("#account_bank").hide();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").hide();
            $("#account_punto_de_venta").hide();
        }
    });

  
$('#dataTable').DataTable({
    "order": []
});


</script> 

<script>//AGREGAREMOS OTRO FORMULARIO DE PAGO
    //Formulario 2
    $("#formulario2").hide();

    $("#account_bank2").hide();
    $("#credit_days2").hide();
    $("#account_efectivo2").hide();
    $("#reference2").hide();
    $("#account_punto_de_venta2").hide();
   
    //------------------------
    var number_form = 1; 

    //AGREGAR FORMULARIOS
    function addForm() {
        if(number_form < 7){
            number_form += 1; 
        }
        if(number_form == 2){
            $('#formulario2').show()
           
        }
            
    }
    
    
    $("#payment_type2").on('change',function(){
        let inputPayment = document.getElementById("payment_type2").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank2").show();
            $("#credit_days2").hide();
            $("#account_efectivo2").hide();
            $("#reference2").show();
            $("#account_punto_de_venta2").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank2").hide();
            $("#credit_days2").show();
            $("#account_efectivo2").hide();
            $("#reference2").hide();
            $("#account_punto_de_venta2").hide();

        }else if(inputPayment == 5){

            $("#account_bank2").show();
            $("#credit_days2").hide();
            $("#account_efectivo2").hide();
            $("#reference2").show();
            $("#account_punto_de_venta2").hide();

        }else if(inputPayment == 6){

            $("#account_bank2").hide();
            $("#credit_days2").hide();
            $("#account_efectivo2").show();
            $("#reference2").hide();
            $("#account_punto_de_venta2").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank2").hide();
            $("#credit_days2").hide();
            $("#account_efectivo2").hide();
            $("#reference2").hide();
            $("#account_punto_de_venta2").show();

        }else{
            $("#account_bank2").hide();
            $("#credit_days2").hide();
            $("#account_efectivo2").hide();
            $("#reference2").hide();
            $("#account_punto_de_venta2").hide();
        }
    });
</script>

@endsection   

@section('validacion')
 <!-- Se encarga de los input number, el formato -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

<script>

$(document).ready(function () {
    $("#anticipo").mask('000.000.000.000.000,00', { reverse: true });
});

/*$(document).ready(function () {
    $("#base_imponible").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#iva_amount").mask('000.000.000.000.000,00', { reverse: true });
});*/

</script>
@endsection 

@section('consulta')


    <script type="text/javascript">
                
                
             let inputIva = document.getElementById("iva").value; 

                let totalIva = (inputIva * "<?php echo $quotation->total_factura; ?>") / 100;  

                let totalFactura = "<?php echo $quotation->total_factura ?>";        

                document.getElementById("iva_amount").value = totalIva;

                document.getElementById("grand_total").value = parseFloat(totalFactura) + parseFloat(totalIva);
               
                let inputAnticipo = document.getElementById("anticipo").value;  

                var montoFormat = inputAnticipo.replace(/[$.]/g,'');

                var montoFormat_anticipo = montoFormat.replace(/[,]/g,'.');               

                var total_pay = parseFloat(totalFactura) + parseFloat(totalIva) - montoFormat_anticipo;

                document.getElementById("total_pay").value =  total_pay.toFixed(2);
                
                
       
            $("#iva").on('change',function(){
               
               
                let inputIva = document.getElementById("iva").value; 

                let totalIva = (inputIva * "<?php echo $quotation->total_factura; ?>") / 100;  

                let totalFactura = "<?php echo $quotation->total_factura ?>";          

                document.getElementById("iva_amount").value = totalIva;
               
                document.getElementById("grand_total").value = parseFloat(totalFactura) + parseFloat(totalIva);

                let inputAnticipo = document.getElementById("anticipo").value;

                var montoFormat = inputAnticipo.replace(/[$.]/g,'');

                var montoFormat_anticipo = montoFormat.replace(/[,]/g,'.');               

                var total_pay = parseFloat(totalFactura) + parseFloat(totalIva) - montoFormat_anticipo;

                document.getElementById("total_pay").value =  total_pay.toFixed(2);
               
                
               
            });

            $("#anticipo").on('keyup',function(){
                let inputIva = document.getElementById("iva").value; 

                let totalIva = (inputIva * "<?php echo $quotation->total_factura; ?>") / 100;  

                let totalFactura = "<?php echo $quotation->total_factura ?>";        

                document.getElementById("iva_amount").value = totalIva;

                document.getElementById("grand_total").value = parseFloat(totalFactura) + parseFloat(totalIva);
              
                let inputAnticipo = document.getElementById("anticipo").value; 
                
                //var monto = "$ 178.000";
                var montoFormat = inputAnticipo.replace(/[$.]/g,'');

                var montoFormat_anticipo = montoFormat.replace(/[,]/g,'.');
                
                var total_pay = parseFloat(totalFactura) + parseFloat(totalIva) - montoFormat_anticipo;

                document.getElementById("total_pay").value =  total_pay.toFixed(2);

                
                
                
            });

       

       

   



    </script>
@endsection
