@extends('layouts.dashboard')

@section('content')

<?php
$suma_debe = 0;
$suma_haber = 0;
?>

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
   
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registro Comprobante Detalle</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('headervouchers.store') }}" enctype="multipart/form-data">
                        @csrf

                        
                       
                        <div class="form-group row">
                            <label for="reference" class="col-md-2 col-form-label text-md-right">Referencia</label>

                            <div class="col-md-4">
                                <input id="reference" type="number" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ $header->reference ?? old('reference') }}" required autocomplete="reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('detailvouchers.selectheadervouche') }}" title="Editar"><i class="fa fa-eye"></i></a>    
                                <a href="" title="Editar"><i class="fa fa-trash-alt"></i></a>  
                           
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-4">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $header->description ?? old('description') }}" readonly required autocomplete="description" >
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">Fecha del Comprobante</label>

                            <div class="col-md-4">
                                <input id="date_begin" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $header->date ?? '' }}" readonly required autocomplete="date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </form>
                            <!--<label for="date" class="col-md-2 col-form-label text-md-right"><h5>Total</h5></label>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="description" ><h6>{{ $suma_debe - $suma_haber }}</h6></label>
                            </div>-->
                        </div>
                       
                      
                <form method="POST" action="{{ route('detailvouchers.store') }}" id="fo" enctype="multipart/form-data">
                    @csrf
                        
                        <input type="hidden" name="id_header_voucher" value="{{$header->id ?? ''}}" readonly>
                        <input type="hidden" name="period" value="{{$account->period ?? ''}}" readonly>
                        <input type="hidden" name="id_account" value="{{$account->id ?? ''}}" readonly>
                       
                                <div class="form-row">
                                    
                                    <div class="form-group col-md-1">
                                        <label for="description" >Cuenta</label>
                                        <input id="code_one" type="number" class="form-control @error('code_one') is-invalid @enderror" name="code_one" value="{{ session()->get('detail')->code_one ?? $account->code_one ?? old('code_one') }}" required autocomplete="code_one"  autofocus>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="description" >.</label>
                                        <input id="code_two" type="number" class="form-control @error('code_two') is-invalid @enderror" name="code_two" value="{{ session()->get('detail')->code_two ?? $account->code_two ?? old('code_two') }}" required autocomplete="code_two"  autofocus>
                                    </div> 
                                    <div class="form-group col-md-1">
                                        <label for="description" >.</label>
                                    <input id="code_three" type="number" class="form-control @error('code_three') is-invalid @enderror" name="code_three" value="{{ session()->get('detail')->code_three ?? $account->code_three ?? old('code_three') }}" required autocomplete="code_three"  autofocus>
                                    </div>   
                                    <div class="form-group col-md-1">
                                        <label for="description" >.</label>
                                        <input id="code_four" type="number" class="form-control @error('code_four') is-invalid @enderror" name="code_four" value="{{ session()->get('detail')->code_four ?? $account->code_four ?? old('code_four') }}" required autocomplete="code_four"  autofocus>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <a href="{{ route('detailvouchers.selectaccount',$header->id ?? -1) }}" title="Editar"><i class="fa fa-eye"></i></a>  
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="description" >Descripción</label>
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ session()->get('accountdetail')->description ?? $account->description ?? '' }}" readonly required autocomplete="description">

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                    <div class="form-group col-md-2">
                                        <label for="debe" >Debe</label>
                                        <input id="debe" type="text" autocomplete="off" placeholder='0,00' value="0,00" class="form-control @error('debe') is-invalid @enderror" name="debe" value="{{ session()->get('detail')->haber ?? '0,00' }}"  required>

                               
                                        @error('debe')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="haber" >Haber</label>
                                        <input id="haber" type="text" class="form-control @error('haber') is-invalid @enderror" name="haber" value="{{ session()->get('detail')->debe ?? '0,00' }}"  required autocomplete="haber">

                                        @error('haber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="submit" title="Agregar"><i class="fa fa-plus"></i></button>  
                                    </div>
                                </div>    
                        
                        </form>      
                       <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Cuenta</th>
                                <th>Descripción</th>
                                <th>Debe</th>
                                <th>Haber</th>
                               
                                <th>Opciones</th>
                              
                            </tr>
                            </thead>
                            
                            <tbody>
                                @if (empty($detailvouchers))
                                @else
                                   
                                    @foreach ($detailvouchers as $key => $var)
                                    <tr>
                                   
                                        @if($var->status == 'N')
                                            <td><i class="fa fa-circle" style="color: rgb(252, 128, 128)"></i> {{$var->accounts['code_one']}}.{{$var->accounts['code_two']}}.{{$var->accounts['code_three']}}.{{$var->accounts['code_four']}}</td>
                                        @else
                                            <td><i class="fa fa-circle" style="color: rgb(84, 196, 84)"></i> {{$var->accounts['code_one']}}.{{$var->accounts['code_two']}}.{{$var->accounts['code_three']}}.{{$var->accounts['code_four']}}</td>
                                        @endif

                                    <td>{{$var->accounts['description']}}</td>
                
                                    <?php
                                        $suma_debe += $var->debe;
                                        $suma_haber += $var->haber;
                                    ?>
                                    <td>{{$var->debe}}</td>
                                    <td>{{$var->haber}}</td>
                                    
                                        <td>
                                        <a href="{{route('detailvouchers.edit',$var->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
                                        </td>
                                   
                                    </tr>
                                    @endforeach
                                    <tr>
                                        
                                        @if($suma_debe == $suma_haber)
                                            <td style="color: rgb(84, 196, 84)">El comprobante está cuadrado</td>
                                            <td>Total</td>
                                            <td>{{$suma_debe}}</td>
                                            <td>{{$suma_haber}}</td>
                                        @else
                                            <td style="color: red">El comprobante está descuadrado</td>
                                            <td>Total</td>
                                            @if ($suma_debe > $suma_haber)
                                                <td>{{$suma_debe}}  <br><div style="color: red"> - {{$suma_debe - $suma_haber}}</div></td>
                                                <td>{{$suma_haber}}</td>
                                            @else
                                                <td>{{$suma_debe}}</td>
                                                <td>{{$suma_haber}} <br><div style="color: red"> - {{$suma_haber - $suma_debe}}</div></td>
                                            @endif
                                            
                                        @endif
                                        
                    
                                        
                                        
                                            <td>
                                            <a href="{{route('detailvouchers.edit',$var->id ?? '') }}" title="Editar"><i class="fa fa-edit"></i></a>  
                                            </td>
                                       
                                        </tr>
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="reference" class="col-md-2 col-form-label text-md-right"><i class="fa fa-circle" style="color: rgb(84, 196, 84)"><strong> Contabilizado</strong></i></label>
                        <label for="reference" class="col-md-2 col-form-label text-md-right"><i class="fa fa-circle" style="color: rgb(255, 94, 94)"><strong> No Contabilizado</strong></i></label>
                    </div>

                    <a href="{{route('detailvouchers.contabilizar',$header->id ?? -1) }}" id="btncontabilizar" name="btncontabilizar" class="btn btn-success" title="Contabilizar">Contabilizar</a>  
                                            
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('validacion')
 <!-- Se encarga de los input number, el formato -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

<script>

$(document).ready(function () {
    $("#debe").mask('000.000.000.000.000,00', { reverse: true });
    
});

</script>
@endsection 

@section('javascript')

    @if($suma_debe != $suma_haber)
    <script>

        btncontabilizar.style.pointerEvents = 'none';
        btncontabilizar.style.color = '#bbb';

    $('#dataTable').DataTable({
        "order": []
    });

    </script> 

    @else
    <script>

            btncontabilizar.style.pointerEvents = null;
        


    $('#dataTable').DataTable({
        "order": []
    });

    </script> 
        
    @endif

@endsection                      

@section('consulta')
    <script>
            
            $("#reference").on('keyup',function(){
               /* let inputValue = document.getElementById("reference").value; 
                document.getElementById("valueInput").innerHTML = inputValue; */
                var reference_id = $(this).val();
                $("#description").val("");
                $("#date_begin").val("");
               
                // alert(segment_id);
                getSubsegment(reference_id);
            });

        function getSubsegment(reference_id){
            // alert(`../subsegment/list/${reference_id}`);
            $.ajax({
                url:`../detailvouchers/listheader/${reference_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                 /*   let subsegment = $("#subsegment");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;*/
                    var inputDescription = document.getElementById("description");
                    var inputDate = document.getElementById("date_begin");
                   
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,description,date} = item;
                           // htmlOptions += `<option value='${id}' {{ old('Subsegment') == '${id}' ? 'selected' : '' }}>${description}</option>`
                          // history.pushState(null, "", `register/${reference_id}`);
                           window.location = `register/${id}`;
                           inputDescription.value = description;
                           inputDate.value = date;
                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                    subsegment.html('');
                    subsegment.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        $("#subsegment").on('change',function(){s
                var subsegment_id = $(this).val();
                var segment_id    = document.getElementById("prueba").value;
                
            });

        
	$(function(){
        soloNumeros('xtelf_local');
        soloNumeros('xtelf_cel');
    });
    
 



    </script>
@endsection

