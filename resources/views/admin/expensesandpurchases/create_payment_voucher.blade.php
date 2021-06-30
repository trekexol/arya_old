@extends('admin.layouts.dashboard')

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
                <div class="card-header" >Gasto o Compra {{ $retorno ?? 'almacenada' }} con Exito</div>
                
                <div class="card-body" >
                       
                        <div class="form-group row">
                            <label for="total_factura" class="col-md-2 col-form-label text-md-right">Total Factura:</label>
                            <div class="col-md-4">
                                <input id="total_factura" type="text" class="form-control @error('total_factura') is-invalid @enderror" name="total_factura" value="{{ number_format($expense->total_factura, 2, ',', '.') ?? 0 }}" readonly required autocomplete="total_factura">
    
                                @error('total_factura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="base_imponible" class="col-md-2 col-form-label text-md-right">Base Imponible:</label>
                            <div class="col-md-3">
                                <input id="base_imponible" type="text" class="form-control @error('base_imponible') is-invalid @enderror" name="base_imponible" value="{{ number_format($expense->base_imponible, 2, ',', '.') ?? 0 }}" readonly required autocomplete="base_imponible">
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
                                <input id="iva_amounts" type="text" class="form-control @error('iva_amount') is-invalid @enderror" name="iva_amount"  readonly required autocomplete="iva_amount"> 
                                
                                @error('iva_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="iva" class="col-md-2 col-form-label text-md-right">IVA:</label>
                            <div class="col-md-2">
                            <select class="form-control" name="iva" id="iva">
                                <option value="{{ $expense->iva_percentage }}">{{ $expense->iva_percentage }}%</option>
                            </select>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="grand_totals" class="col-md-2 col-form-label text-md-right">Total General</label>
                            <div class="col-md-4">
                                <input id="grand_total" type="text" class="form-control @error('grand_total') is-invalid @enderror" name="grand_total" value="{{ number_format($expense->iva_amount, 2, ',', '.') ?? old('grand_total') }}" readonly required autocomplete="grand_total"> 
                           
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
                                <input id="anticipo" type="text" class="form-control @error('anticipo') is-invalid @enderror" name="anticipo" value="{{ number_format($expense->anticipo, 2, ',', '.') ?? '0,00' }}" readonly required autocomplete="anticipo"> 
                           
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
                            @if (isset($expense->credit_days))
                                <label for="total_pays" class="col-md-2 col-form-label text-md-right">Dias de Crédito</label>
                                <div class="col-md-1">
                                    <input id="credit" type="text" class="form-control @error('credit') is-invalid @enderror" name="credit" value="{{ $expense->credit_days ?? '' }}" readonly autocomplete="credit"> 
                                </div>
                            @endif
                            
                        </div>
           
                        <br>
                        <div class="form-group row">
                           
                            <div class="col-md-2">
                                <a onclick="pdf();" id="btnimprimir" name="btnimprimir" class="btn btn-info" title="imprimir">Imprimir Factura</a>  
                            </div>
                            <div class="col-md-4">
                                <a onclick="pdf_media();" id="btnfacturar" name="btnfacturar" class="btn btn-success" title="facturar">Imprimir Factura Media Carta</a>  
                            </div>
                            
                            <div class="col-md-3">
                                <a href="{{ route('expensesandpurchases.movement',$expense->id) }}" id="btnmovement" name="btnmovement" class="btn btn-light" title="movement">Ver Movimiento de Cuenta</a>  
                            </div>
                            
                            <div class="col-md-3">
                                <a href="{{ route('expensesandpurchases.index_historial') }}" id="btnvolver" name="btnvolver" class="btn btn-danger" title="volver">Ver Gastos o Compras</a>  
                            </div>
                        </div>
                        
                    </form>    
                </div>
            </div>
        </div>
</div>
@endsection



@section('consulta')


    <script type="text/javascript">
            function pdf() {
                
                var nuevaVentana= window.open("{{ route('pdf.expense',$expense->id)}}","ventana","left=800,top=800,height=800,width=1000,scrollbar=si,location=no ,resizable=si,menubar=no");
        
            }
            function pdf_media() {
                
                var nuevaVentana2= window.open("{{ route('pdf.expense_media',$expense->id)}}","ventana","left=800,top=800,height=800,width=1000,scrollbar=si,location=no ,resizable=si,menubar=no");
        
            }
           
                calculate();
                
                function calculate() {
                let inputIva = document.getElementById("iva").value; 

                //let totalIva = (inputIva * "<?php echo $expense->total_factura; ?>") / 100;  

                let totalFactura = "<?php echo $expense->total_factura ?>";       

                //AQUI VAMOS A SACAR EL MONTO DEL IVA DE LOS QUE ESTAN EXENTOS, PARA LUEGO RESTARSELO AL IVA TOTAL
                let totalBaseImponible = "<?php echo $expense->base_imponible ?>";

                let totalIvaMenos = (inputIva * "<?php echo $expense->base_imponible; ?>") / 100;  

               


                var total_iva_exento =  parseFloat(totalIvaMenos);

                var iva_format = total_iva_exento.toLocaleString('de-DE');

                //document.getElementById("retencion").value = parseFloat(totalIvaMenos);
                //------------------------------

               

                document.getElementById("iva_amounts").value = iva_format;


                // var grand_total = parseFloat(totalFactura) + parseFloat(totalIva);
                var grand_total = parseFloat(totalFactura) + parseFloat(total_iva_exento);

                var grand_totalformat = grand_total.toLocaleString('de-DE');


                document.getElementById("grand_total").value = grand_totalformat;

                let inputAnticipo = document.getElementById("anticipo").value;  

                var montoFormat = inputAnticipo.replace(/[$.]/g,'');

                var montoFormat_anticipo = montoFormat.replace(/[,]/g,'.');             

                var total_pay = parseFloat(totalFactura) + total_iva_exento - montoFormat_anticipo;

               

                var total_payformat = total_pay.toLocaleString('de-DE');

                document.getElementById("total_pay").value =  total_payformat;

                document.getElementById("total_pay_form").value =  total_pay.toFixed(2);

                document.getElementById("iva_form").value =  inputIva;

                document.getElementById("anticipo_form").value =  inputAnticipo;
            }        

       
         

       

   



    </script>
@endsection
