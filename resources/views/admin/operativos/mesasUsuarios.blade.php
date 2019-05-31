@extends('template.model_form')

    @section('form_title')
        Mesas Usuarios
    @endsection

    @section('form_inputs')
{{--         @if(isset($models))--}} 
            {!! Form::model($models,['route'=> ['admin.operativos.post.mesasUsuarios', $models->id] ]) !!}
            {!! Form::hidden('operativos_id',$models->id) !!}
        {{-- @else
            {!! Form::open(['route'=> config('models.'.$section.'.storeRoute') , 'files' =>'true']) !!}
        @endif --}}

            <div class="col-xs-12">
                <div class="table-responsive">
                        <table class="table" >
                            <thead>
                                <td>Escuela</td>
                                <td>Mesa</td>      
                                <td>Tipo</td>

                            </thead>
                            <tbody>
                                @foreach($models->Escuelas as $escuela)

                                    
                                        @foreach($escuela->Mesas as $mesa)
                                        <tr>
                                            <td>{{$escuela->nombre}}</td>
                                            <td>{{$mesa->numero}}</td>
                                            <td class="col-xs-8">
                                                <select name="mesas[]" class="form-control select2" multiple="multiple">
                                                    @foreach($usuarios as $usuario)

                                                        @if($usuario->OperativosMesasUsers($models->id,$mesa->id,$usuario->id) )
                                                            <option selected="selected" value="{{$mesa->id}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                                                        @else
                                                            <option  value="{{$mesa->id}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>           
                                        @endforeach
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

    

@endsection