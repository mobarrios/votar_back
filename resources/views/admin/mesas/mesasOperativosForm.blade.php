@extends('template.model_form')

    @section('form_title')
        Mesas Operativo
    @endsection

    @section('form_inputs')
            

            {!! Form::model($models,['route'=> ['admin.mesas.votos.edit', $escuela->id,$models->id] , 'files' =>'true']) !!}
        
            <div class="col-xs-12 form-group">
              {!! Form::label('Número') !!}
              {!! Form::text('numero', null, ['class'=>'form-control']) !!}
            </div>
            {!! Form::hidden('escuelas_id', $escuela->id) !!}
            {!! Form::hidden('users_id', 1) !!}


            <div class="col-xs-6">
                <table id="dataTable" class="table" >
                    <thead>
                    <th>
                        Tipo
                    </th>
                    <th>
                        Lista
                    </th>
                    <th>
                         Votos
                    </th>
                    </thead>
                    
                    <tbody>
                         @foreach( $models->VotosOperativos($opId) as $votos)
                            @if($votos->Listas->id != 99)
                                <tr>
                                    <td> {{$votos->Listas->TipoOperativos->nombre}} </td>
                                    <td> {{$votos->Listas->nombre}} </td>
                                    <td> <input  name="votos[{{$votos->id}}]" value="{{$votos->total}}"></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-xs-6">
            <table class="table">
                <thead>
                    <th>
                    </th>
                    <th>
                         Votos Blancos
                    </th>
                    <th>
                         Votos Nulos
                    </th>
                    <th>
                         Votos Recurridos
                    </th>
                    <th>
                         Votos Impugnados
                    </th>
                </thead>
                
                <tbody>
                     @foreach( $models->VotosOperativos($opId) as $votos)
                        @if($votos->Listas->id == 99)
                            <tr>
                                <td> </td>
                                <td><input  name="blancos[{{$votos->id}}]" value="{{$votos->total_blancos}}"></td>
                                <td><input  name="nulos[{{$votos->id}}]" value="{{$votos->total_nulos}}"></td>
                                <td><input  name="recurridos[{{$votos->id}}]" value="{{$votos->total_recurridos}}"></td>
                                <td><input  name="impugnados[{{$votos->id}}]" value="{{$votos->total_impugnados}}"></td>
                            </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            </div>


        
@endsection

@section('js')

    <script type="text/javascript">
        
    $('#dataTable').DataTable();

    </script>

@endsection    






