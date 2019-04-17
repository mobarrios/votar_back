@extends('template.model_form')

    @section('form_title')
        Nueva Mesa
    @endsection

    @section('form_inputs')
        @if(isset($models))
            {!! Form::model($models,['route'=> [config('models.'.$section.'.updateRoute'), $escuela->id,$models->id] , 'files' =>'true']) !!}
        @else
            {!! Form::open(['route'=> [config('models.'.$section.'.storeRoute'),$escuela->id] , 'files' =>'true']) !!}
        @endif

            <div class="col-xs-12 form-group">
              {!! Form::label('Número') !!}
              {!! Form::text('numero', null, ['class'=>'form-control']) !!}
            </div>
            {!! Form::hidden('escuelas_id', $escuela->id) !!}
            {!! Form::hidden('users_id', 1) !!}


@endsection


