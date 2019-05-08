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
            <div class="col-xs-6 form-group">
                {!! Form::label('Tipo ') !!}
                {!! Form::select('tipo_operativos_id', $tipos,null, ['class'=>'select2 form-control']) !!}
            </div>
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
                <div class="responsive">
                        <table class="table" >
                            <thead>
                                <td></td>
                                <td>Partido</td>
                                <td>Candidato</td>
                            </thead>
                            <tbody>
                                @foreach($candidatos as $candidato)
                                    <tr>
                                        {{$models->Candidatos}}
                                    <td><input type="checkbox" name="candidatos_id[]" value="{{$candidato->id}}"  ></td>
                                        <td>{{$candidato->Partidos->nombre}}</td>
                                        <td>{{$candidato->apellido}}, {{$candidato->nombre}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
           

@endsection

