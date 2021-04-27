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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Depósitos Bancarios</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="code_one" type="hidden" class="form-control @error('code_one') is-invalid @enderror" name="account_code_one" value="{{ $account->code_one }}" required autocomplete="code_one" autofocus>
                        <input id="code_two" type="hidden" class="form-control @error('code_two') is-invalid @enderror" name="account_code_two" value="{{ $account->code_two }}" required autocomplete="code_two" autofocus>
                        <input id="code_three" type="hidden" class="form-control @error('code_three') is-invalid @enderror" name="account_code_three" value="{{ $account->code_three }}" required autocomplete="code_three" autofocus>
                        <input id="code_four" type="hidden" class="form-control @error('code_four') is-invalid @enderror" name="account_code_four" value="{{ $account->code_four }}" required autocomplete="code_four" autofocus>

                       
                        <div class="form-group row">
                            <label for="account" class="col-md-2 col-form-label text-md-right">Depositar en:</label>

                            <div class="col-md-4">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ $account->description ?? old('account') }}" required autocomplete="account" autofocus>

                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="date_begin" class="col-md-3 col-form-label text-md-right">Fecha del Depósito:</label>

                            <div class="col-md-3">
                                <input id="date_begin" type="date" class="form-control @error('date_begin') is-invalid @enderror" name="date_begin" value="{{ $datenow ?? old('date_begin') }}" required autocomplete="date_begin">

                                @error('date_begin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-4">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="reference" class="col-md-3 col-form-label text-md-right">Número de Referencia:</label>

                            <div class="col-md-3">
                                <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') }}" required autocomplete="reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <label for="amount" class="col-md-2 col-form-label text-md-right">Monto del Depósito</label>

                            <div class="col-md-4">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                       
                        <div class="form-group row">
                            <label for="contrapartida" class="col-md-2 col-form-label text-md-right">Contrapartida</label>
                        
                            <div class="col-md-4">
                            <select id="contrapartida"  name="contrapartida" class="form-control" required>
                                <option value="">Seleccione una Contrapartida</option>
                                @foreach($contrapartidas as $index => $value)
                                    <option value="{{ $index }}" {{ old('Contrapartida') == $index ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                    
                                @endforeach
                                </select>

                                @if ($errors->has('contrapartida_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contrapartida_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                           

                             <div class="col-md-4">
                                <select  id="subcontrapartida"  name="Subcontrapartida" class="form-control" required>
                                    <option value="">Selecciona una Cuenta</option>
                                </select>

                                @if ($errors->has('subcontrapartida_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcontrapartida_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Guardar Depósito
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('validacion_usuario')
<script>
    
$(function(){
    soloNumeroPunto('code');
    soloAlfaNumerico('description');
    
});

</script>
@endsection

@section('javascript')
    <script>
            
            $("#contrapartida").on('change',function(){
                var contrapartida_id = $(this).val();
                $("#subcontrapartida").val("");
               
                // alert(contrapartida_id);
                getSubcontrapartida(contrapartida_id);
            });

        function getSubcontrapartida(contrapartida_id){
            // alert(`../subcontrapartida/list/${contrapartida_id}`);
            $.ajax({
                url:`../bankmovements/list/${contrapartida_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    let subcontrapartida = $("#subcontrapartida");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            htmlOptions += `<option value='${id}' {{ old('Subcontrapartida') == '${code_one}' ? 'selected' : '' }}>${description}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                    subcontrapartida.html('');
                    subcontrapartida.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        $("#subcontrapartida").on('change',function(){
                var subcontrapartida_id = $(this).val();
                var contrapartida_id    = document.getElementById("contrapartida").value;
                
            });

        
	$(function(){
        soloNumeros('xtelf_local');
        soloNumeros('xtelf_cel');
    });
    
 



    </script>
@endsection
