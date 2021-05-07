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

                        <!--CANTIDAD DE PAGOS QUE QUIERO ENVIAR-->
                        <input type="hidden" id="amount_of_payments" name="amount_of_payments"  readonly>

                        <!--Total del pago que se va a realizar-->
                        <input type="hidden" id="total_pay_form" name="total_pay_form"  readonly>

                        <!--Porcentaje de iva aplicado que se va a realizar-->
                        <input type="hidden" id="iva_form" name="iva_form"  readonly>

                        <!--Anticipo aplicado que se va a realizar-->
                        <input type="hidden" id="anticipo_form" name="anticipo_form"  readonly>


                        
                        <div class="form-group row">
                            <label for="amount_pays" class="col-md-2 col-form-label text-md-right">Forma de Pago:</label>
                            <div class="col-md-3">
                                <input id="amount_pay" type="text" class="form-control @error('amount_pay') is-invalid @enderror" value="0,00" name="amount_pay" placeholder="Monto del Pago" required autocomplete="amount_pay"> 
                           
                                @error('amount_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          
                            <div class="col-md-3">
                                    <select  id="payment_type"  name="payment_type" class="form-control">
                                        <option selected value="0">Tipo de Pago 1</option>
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
                                <div class="form-group col-md-1">
                                    <a id="btn_agregar" class="btn btn-info btn-circle" onclick="addForm()" title="Agregar"><i class="fa fa-plus"></i></a>  
                                </div>
                        </div>
                        <div id="formulario2" class="form-group row">
                                <label for="amount_pay2s" class="col-md-2 col-form-label text-md-right">Forma de Pago 2:</label>
                                <div class="col-md-3">
                                    <input id="amount_pay2" type="text" class="form-control @error('amount_pay2') is-invalid @enderror" value="0,00" name="amount_pay2" placeholder="Monto del Pago"  autocomplete="amount_pay2"> 
                            
                                    @error('amount_pay2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
                                <div class="col-md-3">
                                    <select  id="payment_type2"  name="payment_type2" class="form-control">
                                        <option selected value="0">Tipo de Pago 2</option>
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
                                <div class="form-group col-md-1">
                                    <a id="btn_agregar2" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                                </div>
                                
                        </div>
                       
                        <div id="formulario3" class="form-group row">
                            <label for="amount_pay3s" class="col-md-2 col-form-label text-md-right">Forma de Pago 3:</label>
                            <div class="col-md-3">
                                <input id="amount_pay3" type="text" class="form-control @error('amount_pay3') is-invalid @enderror" value="0,00" name="amount_pay3" placeholder="Monto del Pago"  autocomplete="amount_pay3"> 
                        
                                @error('amount_pay3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <div class="col-md-3">
                                <select  id="payment_type3"  name="payment_type3" class="form-control">
                                    <option selected value="0">Tipo de Pago 3</option>
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
                                <select  id="account_bank3"  name="account_bank3" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_bank as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_efectivo3"  name="account_efectivo3" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_efectivo as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_punto_de_venta3"  name="account_punto_de_venta3" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_punto_de_venta as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <input id="credit_days3" type="text" class="form-control @error('credit_days3') is-invalid @enderror" name="credit_days3" placeholder="Dias de Crédito" autocomplete="credit_days3"> 
                       
                                @error('credit_days3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <input id="reference3" type="text" class="form-control @error('reference3') is-invalid @enderror" name="reference3" placeholder="Referencia" autocomplete="reference3"> 
                       
                                @error('reference3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a id="btn_agregar3" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                            </div>
                            
                        </div>
                        <div id="formulario4" class="form-group row">
                            <label for="amount_pay4s" class="col-md-2 col-form-label text-md-right">Forma de Pago 4:</label>
                            <div class="col-md-3">
                                <input id="amount_pay4" type="text" class="form-control @error('amount_pay4') is-invalid @enderror" value="0,00" name="amount_pay4" placeholder="Monto del Pago"  autocomplete="amount_pay4"> 
                        
                                @error('amount_pay4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <div class="col-md-3">
                                <select  id="payment_type4"  name="payment_type4" class="form-control">
                                    <option selected value="0">Tipo de Pago 4</option>
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
                                <select  id="account_bank4"  name="account_bank4" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_bank as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_efectivo4"  name="account_efectivo4" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_efectivo as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_punto_de_venta4"  name="account_punto_de_venta4" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_punto_de_venta as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <input id="credit_days4" type="text" class="form-control @error('credit_days4') is-invalid @enderror" name="credit_days4" placeholder="Dias de Crédito" autocomplete="credit_days4"> 
                       
                                @error('credit_days4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <input id="reference4" type="text" class="form-control @error('reference4') is-invalid @enderror" name="reference4" placeholder="Referencia" autocomplete="reference4"> 
                       
                                @error('reference4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a id="btn_agregar4" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                            </div>
                            
                        </div>
                        <div id="formulario5" class="form-group row">
                            <label for="amount_pay5s" class="col-md-2 col-form-label text-md-right">Forma de Pago 5:</label>
                            <div class="col-md-3">
                                <input id="amount_pay5" type="text" class="form-control @error('amount_pay5') is-invalid @enderror" value="0,00" name="amount_pay5" placeholder="Monto del Pago"  autocomplete="amount_pay5"> 
                        
                                @error('amount_pay5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <div class="col-md-3">
                                <select  id="payment_type5"  name="payment_type5" class="form-control">
                                    <option selected value="0">Tipo de Pago 5</option>
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
                                <select  id="account_bank5"  name="account_bank5" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_bank as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_efectivo5"  name="account_efectivo5" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_efectivo as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_punto_de_venta5"  name="account_punto_de_venta5" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_punto_de_venta as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <input id="credit_days5" type="text" class="form-control @error('credit_days5') is-invalid @enderror" name="credit_days5" placeholder="Dias de Crédito" autocomplete="credit_days5"> 
                       
                                @error('credit_days5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <input id="reference5" type="text" class="form-control @error('reference5') is-invalid @enderror" name="reference5" placeholder="Referencia" autocomplete="reference5"> 
                       
                                @error('reference5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a id="btn_agregar5" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                            </div>
                            
                        </div>
                        <div id="formulario6" class="form-group row">
                            <label for="amount_pay6s" class="col-md-2 col-form-label text-md-right">Forma de Pago 6:</label>
                            <div class="col-md-3">
                                <input id="amount_pay6" type="text" class="form-control @error('amount_pay6') is-invalid @enderror" value="0,00" name="amount_pay6" placeholder="Monto del Pago"  autocomplete="amount_pay6"> 
                        
                                @error('amount_pay6')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <div class="col-md-3">
                                <select  id="payment_type6"  name="payment_type6" class="form-control">
                                    <option selected value="0">Tipo de Pago 6</option>
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
                                <select  id="account_bank6"  name="account_bank6" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_bank as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_efectivo6"  name="account_efectivo6" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_efectivo as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_punto_de_venta6"  name="account_punto_de_venta6" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_punto_de_venta as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <input id="credit_days6" type="text" class="form-control @error('credit_days6') is-invalid @enderror" name="credit_days6" placeholder="Dias de Crédito" autocomplete="credit_days6"> 
                       
                                @error('credit_days6')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <input id="reference6" type="text" class="form-control @error('reference6') is-invalid @enderror" name="reference6" placeholder="Referencia" autocomplete="reference6"> 
                       
                                @error('reference6')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a id="btn_agregar6" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                            </div>
                            
                        </div>
                        <div id="formulario7" class="form-group row">
                            <label for="amount_pay7s" class="col-md-2 col-form-label text-md-right">Forma de Pago 7:</label>
                            <div class="col-md-3">
                                <input id="amount_pay7" type="text" class="form-control @error('amount_pay7') is-invalid @enderror" value="0,00" name="amount_pay7" placeholder="Monto del Pago"  autocomplete="amount_pay7"> 
                        
                                @error('amount_pay7')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                      
                            <div class="col-md-3">
                                <select  id="payment_type7"  name="payment_type7" class="form-control">
                                    <option selected value="0">Tipo de Pago 7</option>
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
                                <select  id="account_bank7"  name="account_bank7" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_bank as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_efectivo7"  name="account_efectivo7" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_efectivo as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <select  id="account_punto_de_venta7"  name="account_punto_de_venta7" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts_punto_de_venta as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                       @endforeach
                                   
                                </select>
                                <input id="credit_days7" type="text" class="form-control @error('credit_days7') is-invalid @enderror" name="credit_days7" placeholder="Dias de Crédito" autocomplete="credit_days7"> 
                       
                                @error('credit_days7')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <input id="reference7" type="text" class="form-control @error('reference7') is-invalid @enderror" name="reference7" placeholder="Referencia" autocomplete="reference7"> 
                       
                                @error('reference7')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a id="btn_agregar7" class="btn btn-danger btn-circle" onclick="deleteForm()" title="Eliminar"><i class="fa fa-trash"></i></a>  
                            </div>
                            
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Factura
                                 </button>
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
            //ACTIVACION DE CUENTAS BANCARIAS
            $("#account_bank").show();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").show();
            $("#account_punto_de_venta").hide();
            
        }else if(inputPayment == 4){
            //ACTIVACION DE DIAS DE CREDITO
            $("#account_bank").hide();
            $("#credit_days").show();
            $("#account_efectivo").hide();
            $("#reference").hide();
            $("#account_punto_de_venta").hide();

        }else if(inputPayment == 5){
            //ACTIVACION DE CUENTAS BANCARIAS
            $("#account_bank").show();
            $("#credit_days").hide();
            $("#account_efectivo").hide();
            $("#reference").show();
            $("#account_punto_de_venta").hide();

        }else if(inputPayment == 6){
            //ACTIVACION DE CUENTAS EFECTIVO
            $("#account_bank").hide();
            $("#credit_days").hide();
            $("#account_efectivo").show();
            $("#reference").hide();
            $("#account_punto_de_venta").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){
            //ACTIVACION DE CUENTAS PUNTO DE VENTA
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
  
    var number_form = 1; 
    document.getElementById("amount_of_payments").value = number_form;
   
    //AGREGAR FORMULARIOS
    function addForm() {
        if(number_form < 7){
            number_form += 1; 
        }
        if(number_form == 2){
            $('#formulario2').show()
            document.getElementById("amount_pay2").value = "0,00";
        }
        if(number_form == 3){
            $('#formulario3').show()
            document.getElementById("amount_pay3").value = "0,00";
        }
        if(number_form == 4){
            $('#formulario4').show()
            document.getElementById("amount_pay4").value = "0,00";
        }
        if(number_form == 5){
            $('#formulario5').show()
            document.getElementById("amount_pay5").value = "0,00";
        }
        if(number_form == 6){
            $('#formulario6').show()
            document.getElementById("amount_pay6").value = "0,00";
        }
        if(number_form == 7){
            $('#formulario7').show()
            document.getElementById("amount_pay7").value = "0,00";
        }
            
        document.getElementById("amount_of_payments").value = number_form;
       
    }


    //AGREGAR FORMULARIOS
    function deleteForm() {
        if(number_form <= 7){
            number_form -= 1; 
        }
        if(number_form == 1){
            $('#formulario2').hide()
            document.getElementById("amount_pay2").value = "0,00";
        }
        if(number_form == 2){
            $('#formulario3').hide()
            document.getElementById("amount_pay3").value = "0,00";
            
        }if(number_form == 3){
            $('#formulario4').hide()
            document.getElementById("amount_pay4").value = "0,00";
            
        }if(number_form == 4){
            $('#formulario5').hide()
            document.getElementById("amount_pay5").value = "0,00";
            
        }if(number_form == 5){
            $('#formulario6').hide()
            document.getElementById("amount_pay6").value = "0,00";
            
        }if(number_form == 6){
            $('#formulario7').hide()
            document.getElementById("amount_pay7").value = "0,00";
            
        }
        document.getElementById("amount_of_payments").value = number_form;
       
    }

  //Formulario 2
  $("#formulario2").hide();

$("#account_bank2").hide();
$("#credit_days2").hide();
$("#account_efectivo2").hide();
$("#reference2").hide();
$("#account_punto_de_venta2").hide();

//------------------------

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



    //Formulario 3
  $("#formulario3").hide();

$("#account_bank3").hide();
$("#credit_days3").hide();
$("#account_efectivo3").hide();
$("#reference3").hide();
$("#account_punto_de_venta3").hide();

//------------------------

    $("#payment_type3").on('change',function(){
        let inputPayment = document.getElementById("payment_type3").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank3").show();
            $("#credit_days3").hide();
            $("#account_efectivo3").hide();
            $("#reference3").show();
            $("#account_punto_de_venta3").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank3").hide();
            $("#credit_days3").show();
            $("#account_efectivo3").hide();
            $("#reference3").hide();
            $("#account_punto_de_venta3").hide();

        }else if(inputPayment == 5){

            $("#account_bank3").show();
            $("#credit_days3").hide();
            $("#account_efectivo3").hide();
            $("#reference3").show();
            $("#account_punto_de_venta3").hide();

        }else if(inputPayment == 6){

            $("#account_bank3").hide();
            $("#credit_days3").hide();
            $("#account_efectivo3").show();
            $("#reference3").hide();
            $("#account_punto_de_venta3").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank3").hide();
            $("#credit_days3").hide();
            $("#account_efectivo3").hide();
            $("#reference3").hide();
            $("#account_punto_de_venta3").show();

        }else{
            $("#account_bank3").hide();
            $("#credit_days3").hide();
            $("#account_efectivo3").hide();
            $("#reference3").hide();
            $("#account_punto_de_venta3").hide();
        }
    });



       //Formulario 4
  $("#formulario4").hide();

$("#account_bank4").hide();
$("#credit_days4").hide();
$("#account_efectivo4").hide();
$("#reference4").hide();
$("#account_punto_de_venta4").hide();

//------------------------

    $("#payment_type4").on('change',function(){
        let inputPayment = document.getElementById("payment_type4").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank4").show();
            $("#credit_days4").hide();
            $("#account_efectivo4").hide();
            $("#reference4").show();
            $("#account_punto_de_venta4").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank4").hide();
            $("#credit_days4").show();
            $("#account_efectivo4").hide();
            $("#reference4").hide();
            $("#account_punto_de_venta4").hide();

        }else if(inputPayment == 5){

            $("#account_bank4").show();
            $("#credit_days4").hide();
            $("#account_efectivo4").hide();
            $("#reference4").show();
            $("#account_punto_de_venta4").hide();

        }else if(inputPayment == 6){

            $("#account_bank4").hide();
            $("#credit_days4").hide();
            $("#account_efectivo4").show();
            $("#reference4").hide();
            $("#account_punto_de_venta4").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank4").hide();
            $("#credit_days4").hide();
            $("#account_efectivo4").hide();
            $("#reference4").hide();
            $("#account_punto_de_venta4").show();

        }else{
            $("#account_bank4").hide();
            $("#credit_days4").hide();
            $("#account_efectivo4").hide();
            $("#reference4").hide();
            $("#account_punto_de_venta4").hide();
        }
    });


     //Formulario 5
  $("#formulario5").hide();

$("#account_bank5").hide();
$("#credit_days5").hide();
$("#account_efectivo5").hide();
$("#reference5").hide();
$("#account_punto_de_venta5").hide();

//------------------------

    $("#payment_type5").on('change',function(){
        let inputPayment = document.getElementById("payment_type5").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank5").show();
            $("#credit_days5").hide();
            $("#account_efectivo5").hide();
            $("#reference5").show();
            $("#account_punto_de_venta5").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank5").hide();
            $("#credit_days5").show();
            $("#account_efectivo5").hide();
            $("#reference5").hide();
            $("#account_punto_de_venta5").hide();

        }else if(inputPayment == 5){

            $("#account_bank5").show();
            $("#credit_days5").hide();
            $("#account_efectivo5").hide();
            $("#reference5").show();
            $("#account_punto_de_venta5").hide();

        }else if(inputPayment == 6){

            $("#account_bank5").hide();
            $("#credit_days5").hide();
            $("#account_efectivo5").show();
            $("#reference5").hide();
            $("#account_punto_de_venta5").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank5").hide();
            $("#credit_days5").hide();
            $("#account_efectivo5").hide();
            $("#reference5").hide();
            $("#account_punto_de_venta5").show();

        }else{
            $("#account_bank5").hide();
            $("#credit_days5").hide();
            $("#account_efectivo5").hide();
            $("#reference5").hide();
            $("#account_punto_de_venta5").hide();
        }
    });

     //Formulario 6
  $("#formulario6").hide();

$("#account_bank6").hide();
$("#credit_days6").hide();
$("#account_efectivo6").hide();
$("#reference6").hide();
$("#account_punto_de_venta6").hide();

//------------------------

    $("#payment_type6").on('change',function(){
        let inputPayment = document.getElementById("payment_type6").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank6").show();
            $("#credit_days6").hide();
            $("#account_efectivo6").hide();
            $("#reference6").show();
            $("#account_punto_de_venta6").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank6").hide();
            $("#credit_days6").show();
            $("#account_efectivo6").hide();
            $("#reference6").hide();
            $("#account_punto_de_venta6").hide();

        }else if(inputPayment == 5){

            $("#account_bank6").show();
            $("#credit_days6").hide();
            $("#account_efectivo6").hide();
            $("#reference6").show();
            $("#account_punto_de_venta6").hide();

        }else if(inputPayment == 6){

            $("#account_bank6").hide();
            $("#credit_days6").hide();
            $("#account_efectivo6").show();
            $("#reference6").hide();
            $("#account_punto_de_venta6").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank6").hide();
            $("#credit_days6").hide();
            $("#account_efectivo6").hide();
            $("#reference6").hide();
            $("#account_punto_de_venta6").show();

        }else{
            $("#account_bank6").hide();
            $("#credit_days6").hide();
            $("#account_efectivo6").hide();
            $("#reference6").hide();
            $("#account_punto_de_venta6").hide();
        }
    });

     //Formulario 7
  $("#formulario7").hide();

$("#account_bank7").hide();
$("#credit_days7").hide();
$("#account_efectivo7").hide();
$("#reference7").hide();
$("#account_punto_de_venta7").hide();

//------------------------

    $("#payment_type7").on('change',function(){
        let inputPayment = document.getElementById("payment_type7").value; 

        if(inputPayment == 1 || inputPayment == 11){

            $("#account_bank7").show();
            $("#credit_days7").hide();
            $("#account_efectivo7").hide();
            $("#reference7").show();
            $("#account_punto_de_venta7").hide();
            
        }else if(inputPayment == 4){

            $("#account_bank7").hide();
            $("#credit_days7").show();
            $("#account_efectivo7").hide();
            $("#reference7").hide();
            $("#account_punto_de_venta7").hide();

        }else if(inputPayment == 5){

            $("#account_bank7").show();
            $("#credit_days7").hide();
            $("#account_efectivo7").hide();
            $("#reference7").show();
            $("#account_punto_de_venta7").hide();

        }else if(inputPayment == 6){

            $("#account_bank7").hide();
            $("#credit_days7").hide();
            $("#account_efectivo7").show();
            $("#reference7").hide();
            $("#account_punto_de_venta7").hide();

        }else if((inputPayment == 9) || (inputPayment == 10)){

            $("#account_bank7").hide();
            $("#credit_days7").hide();
            $("#account_efectivo7").hide();
            $("#reference7").hide();
            $("#account_punto_de_venta7").show();

        }else{
            $("#account_bank7").hide();
            $("#credit_days7").hide();
            $("#account_efectivo7").hide();
            $("#reference7").hide();
            $("#account_punto_de_venta7").hide();
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

$(document).ready(function () {
    $("#amount_pay").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay2").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay3").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay4").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay5").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay6").mask('000.000.000.000.000,00', { reverse: true });
});
$(document).ready(function () {
    $("#amount_pay7").mask('000.000.000.000.000,00', { reverse: true });
});

$(document).ready(function () {
    $("#reference").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference2").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference3").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference4").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference5").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference6").mask('000000000000000000000', { reverse: true });
});
$(document).ready(function () {
    $("#reference7").mask('000000000000000000000', { reverse: true });
});

$(document).ready(function () {
    $("#credit_days").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days2").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days3").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days4").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days5").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days6").mask('00000000', { reverse: true });
});
$(document).ready(function () {
    $("#credit_days7").mask('00000000', { reverse: true });
});

/*$(document).ready(function () {
    $("#base_imponible").mask('000.000.000.000.000,00', { reverse: true });
});*/
$(document).ready(function () {
    $("#iva_amount").mask('000.000.000.000.000,00', { reverse: true });
});

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
                
                document.getElementById("total_pay_form").value =  total_pay.toFixed(2);

                document.getElementById("iva_form").value =  inputIva;
                
                document.getElementById("anticipo_form").value =  inputAnticipo;
       
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
               
                document.getElementById("total_pay_form").value =  total_pay.toFixed(2);

                document.getElementById("iva_form").value =  inputIva;

                document.getElementById("anticipo_form").value =  inputAnticipo;
               
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

                document.getElementById("total_pay_form").value =  total_pay.toFixed(2);

                document.getElementById("iva_form").value =  inputIva;
                
                document.getElementById("anticipo_form").value =  inputAnticipo;
                
            });

       

       

   



    </script>
@endsection
