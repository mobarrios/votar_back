@extends('template.model_form')

    @section('form_title')
        Nuevo Candidato 
    @endsection

    @section('form_inputs')
        @if(isset($models))
            {!! Form::model($models,['route'=> [config('models.'.$section.'.updateRoute'), $partidos->id ,$models->id] , 'files' =>'true']) !!}
        @else
            {!! Form::open(['route'=> [config('models.'.$section.'.storeRoute'),$partidos->id] , 'files' =>'true']) !!}
        @endif

        <div class="col-xs-6 form-group">
                {!! Form::label('Apellido') !!}
                {!! Form::text('apellido', null, ['class'=>'form-control']) !!}
              </div>
            <div class="col-xs-6 form-group">
              {!! Form::label('Nombre') !!}
              {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('Imagen') !!}
                {!! Form::file('image') !!}
            </div>

            {!! Form::hidden('partidos_id',$partidos->id) !!}

@endsection

