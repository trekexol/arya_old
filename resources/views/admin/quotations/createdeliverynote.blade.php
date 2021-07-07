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
                <div class="card-header" ><h3>Cerrar e Imprimir la Nota de Entrega </h3></div>
                
                <div class="card-body" >
                        <div class="form-group row">
                            <label for="cedula_rif" class="col-md-2 col-form-label text-md-right">CI/Rif Cliente:</label>
                            <div class="col-md-4">
                                <input id="cedula_rif" type="text" class="form-control @error('cedula_rif') is-invalid @enderror" name="cedula_rif" value="{{ $quotation->clients['cedula_rif']  ?? '' }}" readonly required autocomplete="cedula_rif">

                                @error('cedula_rif')
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
                                <input id="total_factura" type="text" class="form-control @error('total_factura') is-invalid @enderror" name="total_factura" value="{{ number_format($quotation->total_factura * ($bcv ?? 1), 2, ',', '.') ?? 0 }}" readonly required autocomplete="total_factura">
    
                                @error('total_factura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="base_imponible" class="col-md-2 col-form-label text-md-right">Base Imponible:</label>
                            <div class="col-md-3">
                                <input id="base_imponible" type="text" class="form-control @error('base_imponible') is-invalid @enderror" name="base_imponible" value="{{ number_format($quotation->base_imponible * ($bcv ?? 1), 2, ',', '.') ?? 0 }}" readonly required autocomplete="base_imponible">
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
                                <input id="iva_amount" type="text" class="form-control @error('iva_amount') is-invalid @enderror" name="iva_amount"  readonly required autocomplete="iva_amount"> 
                                
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
                       
                        
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-4">
                                <a onclick="pdf();" id="btnfacturar" name="btnfacturar" class="btn btn-info" title="facturar">Guardar e Imprimir Nota de Entrega</a>  
                            </div>
                          <div class="col-md-2">
                                <a href="{{ route('quotations.indexdeliverynote') }}" id="btnfacturar" name="btnfacturar" class="btn btn-danger" title="facturar">Volver</a>  
                            </div>
                        </div>
                        
                    
                </div>
            </div>
        </div>
</div>
@endsection



@section('consulta')
<script type="text/javascript">
   

    $("#iva").on('change',function(){
                //calculate();
               
                let inputIva = document.getElementById("iva").value; 

                //let totalIva = (inputIva * "<?php echo $quotation->total_factura; ?>") / 100;  

                let totalFactura = "<?php echo $quotation->total_factura  * ($bcv ?? 1)?>";       

                //AQUI VAMOS A SACAR EL MONTO DEL IVA DE LOS QUE ESTAN EXENTOS, PARA LUEGO RESTARSELO AL IVA TOTAL
                let totalBaseImponible = "<?php echo $quotation->base_imponible  * ($bcv ?? 1)?>";

                let totalIvaMenos = (inputIva * "<?php echo $quotation->base_imponible  * ($bcv ?? 1); ?>") / 100;  
                

                
                /*-----------------------------------*/
                /*Toma la Base y la envia por form*/
                let sub_total_form = document.getElementById("total_factura").value; 

                var montoFormat = sub_total_form.replace(/[$.]/g,'');

                var montoFormat_sub_total_form = montoFormat.replace(/[,]/g,'.');    

                //document.getElementById("sub_total_form").value =  montoFormat_sub_total_form;
                /*-----------------------------------*/


                var total_iva_exento =  parseFloat(totalIvaMenos);

                var iva_format = total_iva_exento.toLocaleString('de-DE');

                //document.getElementById("retencion").value = parseFloat(totalIvaMenos);
                //------------------------------
                


                document.getElementById("iva_amount").value = iva_format;


                // var grand_total = parseFloat(totalFactura) + parseFloat(totalIva);
                var grand_total = parseFloat(totalFactura) + parseFloat(total_iva_exento);

                var grand_totalformat = grand_total.toLocaleString('de-DE');

                document.getElementById("grand_total").value = grand_totalformat;

                
               
            });
</script>
<script type="text/javascript">

    calculate();

    function pdf() {
        let inputIva = document.getElementById("iva").value; 

        

        var nuevaVentana= window.open("{{ route('pdf.deliverynote',[$quotation->id,$coin,''])}}"+"/"+inputIva,"ventana","left=800,top=800,height=800,width=1000,scrollbar=si,location=no ,resizable=si,menubar=no");
 
    }

    function calculate() {
        let inputIva = document.getElementById("iva").value; 

        //let totalIva = (inputIva * "<?php echo $quotation->total_factura; ?>") / 100;  

        let totalFactura = "<?php echo $quotation->total_factura  * ($bcv ?? 1)?>";       

        //AQUI VAMOS A SACAR EL MONTO DEL IVA DE LOS QUE ESTAN EXENTOS, PARA LUEGO RESTARSELO AL IVA TOTAL
        let totalBaseImponible = "<?php echo $quotation->base_imponible  * ($bcv ?? 1)?>";

        let totalIvaMenos = (inputIva * "<?php echo $quotation->base_imponible  * ($bcv ?? 1); ?>") / 100;  


        /*-----------------------------------*/
        /*Toma la Base y la envia por form*/
        let sub_total_form = document.getElementById("total_factura").value; 

        var montoFormat = sub_total_form.replace(/[$.]/g,'');

        var montoFormat_sub_total_form = montoFormat.replace(/[,]/g,'.');    

        //document.getElementById("sub_total_form").value =  montoFormat_sub_total_form;
        /*-----------------------------------*/





        var total_iva_exento =  parseFloat(totalIvaMenos);

        var iva_format = total_iva_exento.toLocaleString('de-DE');

        //document.getElementById("retencion").value = parseFloat(totalIvaMenos);
        //------------------------------

       
        document.getElementById("iva_amount").value = iva_format;


        // var grand_total = parseFloat(totalFactura) + parseFloat(totalIva);
        var grand_total = parseFloat(totalFactura) + parseFloat(total_iva_exento);

        var grand_totalformat = grand_total.toLocaleString('de-DE');


        document.getElementById("grand_total").value = grand_totalformat;

    }        
  







</script>
@endsection
