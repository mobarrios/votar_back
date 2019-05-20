@extends('template.model_form')

    @section('form_title')
        Nueva Lista 
    @endsection

    @section('form_inputs')
        @if(isset($models))
            {!! Form::model($models,['route'=> [config('models.'.$section.'.updateRoute'), $partidos->id ,$models->id] , 'files' =>'true']) !!}
        @else
            {!! Form::open(['route'=> [config('models.'.$section.'.storeRoute'),$partidos->id] , 'files' =>'true']) !!}
        @endif

        <div class="col-xs-6 form-group">
                {!! Form::label('Nombre Lista') !!}
                {!! Form::text('nombre', null, ['class'=>'form-control']) !!}
              </div>
            <div class="col-xs-6 form-group">
              {!! Form::label('Tipo Operativo') !!}
              {!! Form::select('tipo_operativos_id', $tipoOperativos, null, ['class'=>'form-control select2']) !!}
            </div>
          
            {!! Form::hidden('partidos_id',$partidos->id) !!}

@endsection

