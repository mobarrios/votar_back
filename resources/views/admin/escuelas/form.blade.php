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
                {!! Form::label('Dirección') !!}
                {!! Form::text('direccion', null, ['class'=>'form-control']) !!}
            </div>
            <div class="col-xs-6 form-group">
                {!! Form::label('Observaciones') !!}
                {!! Form::text('observaciones', null, ['class'=>'form-control']) !!}
            </div>

            <div class="col-xs-4 form-group">
                {!! Form::label('Provincias') !!}
                <select  name="provincias_id" id="provincias" class="form-control select2">
                </select>
            </div>

            <div class="col-xs-4 form-group">
                {!! Form::label('Municipios') !!}
                <select  name="municipios_id" id="municipios" class="form-control select2">
                </select>
            </div>
            <div class="col-xs-4 form-group">
                {!! Form::label('Localidades') !!}

                <select name="localidades_id" id="localidades" class="form-control select2">
                </select>
            </div>

            {!! Form::hidden('latitud',null,['class'=>'latitud'])!!}
            {!! Form::hidden('longitud',null,['class'=>'longitud'])!!}

@endsection


@section('js')

    <script type="text/javascript">
        
            $.ajax({
             url: "https://apis.datos.gob.ar/georef/api/provincias?max=1000",
                    }).done(function(data) {
                        $.each(data.provincias, function(i, item) 
                        {
                            $('#provincias').append('<option value="'+item.id+'" >'+item.nombre+'</option>')
                        });
            });


            $('#provincias').change(function(){

                $('#municipios').empty();
                $('#localidades').empty();


                 $.ajax({
                 url: "https://apis.datos.gob.ar/georef/api/municipios?provincia="+$(this).val()+"&max=1000",
                        }).done(function(data) {
                            $.each(data.municipios , function(i, item) 
                            {
                                $('#municipios').append('<option value="'+item.id+'" >'+item.nombre+'</option>')
                            });
                });
            });

            $('#municipios').change(function(){

                $('#localidades').empty();

                 $.ajax({
                 url: "https://apis.datos.gob.ar/georef/api/localidades?municipio="+$(this).val()+"&max=1000",
                        }).done(function(data) {
                            $.each(data.localidades , function(i, item) 
                            {
                                console.log(item.centroide);
                                $('#localidades').append('<option value="'+item.id+'" >'+item.nombre+'</option>')

                                $('.latitud').val(item.centroide.lat);
                                $('.longitud').val(item.centroide.lon);
                            });
                });
            });
            

    </script>

@endsection

