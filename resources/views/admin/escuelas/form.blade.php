@extends('template.model_form')

    @section('form_title')
        Nueva Escuela
    @endsection

    @section('form_inputs')
        @if(isset($models))
            {!! Form::model($models,['route'=> [config('models.'.$section.'.updateRoute'), $models->id] , 'files' =>'true']) !!}
        @else
            {!! Form::open(['route'=> config('models.'.$section.'.storeRoute') , 'files' =>'true']) !!}
        @endif

            <div class="col-xs-12 form-group">
              {!! Form::label('Nombre') !!}
              {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('Ubicación') !!}
                {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('Observaciones') !!}
                {!! Form::text('observaciones', null, ['class'=>'form-control']) !!}
            </div>

@endsection

