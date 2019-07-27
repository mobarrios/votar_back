@extends('template.model_form')

    @section('form_title')
        Nuevo Operativo
    @endsection

    @section('form_inputs')
        @if(isset($models))
            {!! Form::model($models,['route'=> [config('models.'.$section.'.updateRoute'), $models->id] , 'files' =>'true']) !!}
        @else
            {!! Form::open(['route'=> config('models.'.$section.'.storeRoute') , 'files' =>'true']) !!}
        @endif

            <div class="col-xs-3 form-group">
                {!! Form::label('Fecha') !!}
                {!! Form::text('fecha', null, ['class'=>'datePicker form-control']) !!}
            </div>
            <div class="col-xs-9 form-group">
                {!! Form::label('Nombre') !!}
                {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
            </div>
           {{--  <div class="col-xs-6 form-group">
                {!! Form::label('Tipo ') !!}
                {!! Form::select('tipo_operativos_id', $tipos,null, ['class'=>'select2 form-control']) !!}
            </div> --}}
            <div class="col-xs-6 form-group">
                {!! Form::label('Nivel ') !!}
                {!! Form::select('niveles_operativos_id', $niveles, null,['class'=>'select2 form-control']) !!}
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('Escuelas ') !!}
                {!! Form::select('escuelas_id[]', $escuelas, null,['class'=>'select2 form-control', 'multiple']) !!}
            </div>

            {{-- 
            <div class="col-xs-6 form-group">
                {!! Form::label('Candidatos ') !!}
                {!! Form::select('candidatos_id[]', $candidatos, null,['class'=>'select2 form-control', 'multiple']) !!}
            </div>
             --}}
        

            <div class="col-xs-6">
                <div class="table-responsive">
                        <table class="table" >
                            <thead>
                                <td></td>
                                <td>Partido</td>
                                <td>Lista</td>      
                                <td>Tipo</td>

                            </thead>
                            <tbody>
                                @foreach($listas as $lista)
                                    <tr>
                                    <td>
                                            @if(isset($models) && $models->hasListas($lista->id))
                                                <input type="checkbox" name="listas_id[]" value="{{$lista->id}}" checked="checked">
                                             @else
                                                <input type="checkbox" name="listas_id[]" value="{{$lista->id}}"  >
                                            @endif

                                    </td>
                                        <td>{{$lista->Partidos->nombre or ''}}</td>
                                        <td>{{$lista->nombre or ''}}</td>
                                        <td>{{$lista->TipoOperativos->nombre or ''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

    

@endsection

