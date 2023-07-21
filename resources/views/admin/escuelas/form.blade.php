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
                <select name="provincias_id" id="provincias" class="form-control select2">
                </select>
            </div>

            <div class="col-xs-4 form-group">
                {!! Form::label('Municipios') !!}
                <select name="municipios_id" id="municipios" class="form-control select2">
                    @if(isset($models))
                        <option value="{{$models->municipios_id}}">{{$models->municipio}}</option>
                    @endif
                </select>
            </div>
            <div class="col-xs-4 form-group">
                {!! Form::label('Localidades') !!}

                <select name="localidades_id" id="localidades" class="form-control select2">
                    @if(isset($models))
                        <option value="{{$models->localidades_id}}">{{$models->localidad}}</option>
                    @endif
                </select>
            </div>

            {!! Form::hidden('latitud', isset($models) ? $models->latitud : '' ,['class'=>'latitud'])!!}
            {!! Form::hidden('longitud',isset($models) ? $models->longitud : '',['class'=>'longitud'])!!}
            {!! Form::hidden('provincia',isset($models) ? $models->provincia : '',['class'=>'provincia'])!!}
            {!! Form::hidden('localidad',isset($models) ? $models->localidad : '',['class'=>'localidad'])!!}
            {!! Form::hidden('municipio',isset($models) ? $models->municipio : '',['class'=>'municipio'])!!}

@endsection


@section('js')

    <script type="text/javascript">
            var prov = {{ isset($models) ? $models->provincias_id : '' }}
            
            $.ajax({
             url: "https://apis.datos.gob.ar/georef/api/provincias?max=1000",
                    }).done(function(data) {
                        $('#provincias').append('<option value="">Seleccionar</option>')

                        $.each(data.provincias, function(i, item) 
                        {   
                            if(item.id == prov){
                                $('#provincias').append('<option value="'+item.id+'" selected  >'+item.nombre+'</option>')
                            }else{
                                $('#provincias').append('<option value="'+item.id+'"  >'+item.nombre+'</option>')
                            }
                        });
            });


            $('#provincias').change(function(){

                $('#municipios').empty();
                $('#localidades').empty();
                $('[name=municipio]').val('');
                $('[name=provincia]').val($('#provincias').select2('data')[0].text)
                
                $.ajax({
                url: "https://apis.datos.gob.ar/georef/api/municipios?provincia="+$(this).val()+"&max=1000",
                        }).done(function(data) {
                            $('#municipios').append('<option value="">Seleccionar</option>')
                            $.each(data.municipios , function(i, item) 
                            {
                                $('#municipios').append('<option value="'+item.id+'" >'+item.nombre+'</option>')
                            });
                });
            });

            $('#municipios').change(function(){

                $('#localidades').empty();
                $('[name=localidad]').val('');
                $('[name=municipio]').val($('#municipios').select2('data')[0].text)

                 $.ajax({
                 url: "https://apis.datos.gob.ar/georef/api/localidades?municipio="+$(this).val()+"&max=1000",
                        }).done(function(data) {
                            $('#localidades').append('<option value="">Seleccionar</option>')
                            $.each(data.localidades , function(i, item) 
                            {
                                console.log(item);
                                $('#localidades').append('<option value="'+item.id+'" >'+item.nombre+'</option>')

                                $('.latitud').val(item.centroide.lat);
                                $('.longitud').val(item.centroide.lon);
                               
                            });
                });
            });


            $('#localidades').change(function(){
                
                $('[name=localidad]').val($('#localidades').select2('data')[0].text)
            })
            

    </script>

@endsection

