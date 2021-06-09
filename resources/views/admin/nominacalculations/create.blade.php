@extends('layouts.dashboard')

@section('content')

 {{-- VALIDACIONES-RESPUESTA--}}
 @include('admin.layouts.success')   {{-- SAVE --}}
 @include('admin.layouts.danger')    {{-- EDITAR --}}
 @include('admin.layouts.delete')    {{-- DELELTE --}}
 {{-- VALIDACIONES-RESPUESTA --}}
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold h3">
                    Agregar Concepto
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nominacalculations.store') }}">
                        @csrf

                        <input type="hidden" name="id_nomina" value="{{$nomina->id}}" readonly>
                        <input type="hidden" name="id_employee" value="{{$employee->id}}" readonly>
                        

                        <div class="form-group row">
                            <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Concepto:</label>
                            <div class="col-md-4">
                                <select  id="id_nomina_concept"  name="id_nomina_concept" class="form-control">
                                    @foreach($nominaconcepts as $nominaconcept)
                                            <option selected value="{{$nominaconcept->id}}">{{ $nominaconcept->abbreviation  }} - {{ $nominaconcept->description }}</option>
                                       @endforeach
                                   
                                </select>
                            </div>
                            
                        </div>
                        @if($nomina->type == "Primera Quincena" || $nomina->type == "Segunda Quincena")
                            <div class="form-group row">
                                <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Formula Quincenal:</label>
                                <div class="col-md-6">
                                    <input id="formula_q" type="text" readonly class="form-control @error('formula_q') is-invalid @enderror" name="formula_q"  required autocomplete="formula_q">
                                </div>
                            </div>
                        @endif
                        @if($nomina->type == "Mensual")
                            <div class="form-group row">
                                <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Formula Mensual:</label>
                                <div class="col-md-6">
                                    <input id="formula_m" type="text" readonly class="form-control @error('formula_m') is-invalid @enderror" name="formula_m"  required autocomplete="formula_m">
                                </div>
                            </div>
                        @endif
                        @if($nomina->type == "Semanal")
                            <div class="form-group row">
                                <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Formula Semanal:</label>
                                <div class="col-md-6">
                                    <input id="formula_s" type="text" readonly class="form-control @error('formula_s') is-invalid @enderror" name="formula_s"  required autocomplete="formula_s">
                                </div>
                            </div>
                        @endif
                        <div id="dias_form" class="form-group row">
                            <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Dias:</label>
                            <div class="col-md-4">
                                <input id="dias" type="text"  class="form-control @error('dias') is-invalid @enderror" name="dias"  autocomplete="dias">
                            </div>
                        </div>
                    <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar Concepto
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
@section('validacion')
    <script>
        $("#dias_form").hide();
        
        $(document).ready(function () {
            $("#amount").mask('000.000.000.000.000,00', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#hours").mask('000', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#days").mask('000', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#cantidad").mask('000.000', { reverse: true });
            
        });
        
        
    </script>
@endsection 

@section('javascript')
    <script>
            
            $("#id_nomina_concept").on('change',function(){
                var id_nomina_concept = $(this).val();
                $("#formula_q").val("");
                $("#formula_m").val("");
                $("#formula_s").val("");
                
                getFormulaQ(id_nomina_concept);
                getFormulaM(id_nomina_concept);
                getFormulaS(id_nomina_concept);
            });

        function getFormulaQ(id_nomina_concept){
            $.ajax({
                url:"{{ route('nominacalculations.listformula') }}" + '/' + id_nomina_concept,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    
                    // console.clear();
                    if(response.length > 0){
                       
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            
                            document.getElementById("formula_q").value = description; 

                            var validate = -1;
                            validate = description.indexOf("dia");
                            //alert(validate);
                            if(validate != -1){
                                $("#dias_form").show();
                            }else{
                                $("#dias_form").hide();
                            }
                            
                        });
                    }
                   
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }
        function getFormulaM(id_nomina_concept){
            $.ajax({
                url:"{{ route('nominacalculations.listformulamensual') }}" + '/' + id_nomina_concept,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    
                    // console.clear();
                    if(response.length > 0){
                       
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            
                            document.getElementById("formula_m").value = description; 

                            var validate = -1;
                            validate = description.indexOf("dia");
                            
                            if(validate != -1){
                                $("#dias_form").show();
                            }else{
                                $("#dias_form").hide();
                            }
                        });
                    }
                   
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }
        function getFormulaS(id_nomina_concept){
            $.ajax({
                url:"{{ route('nominacalculations.listformulasemanal') }}" + '/' + id_nomina_concept,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    
                    // console.clear();
                    if(response.length > 0){
                       
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            
                            document.getElementById("formula_s").value = description; 

                            var validate = -1;
                            validate = description.indexOf("dia");
                            
                            if(validate != -1){
                                $("#dias_form").show();
                            }else{
                                $("#dias_form").hide();
                            }
                        });
                    }
                   
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }


    </script>
@endsection
