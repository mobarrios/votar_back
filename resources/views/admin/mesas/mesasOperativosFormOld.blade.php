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
    
        
@section('secondContent')

<div class="row">
    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">

            {{-- <div class="box-header">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4 ">
                    <form method="GET" action="http://localhost:8888/votar_back/public/admin/escuelas/index" accept-charset="UTF-8">

                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filtros <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right"></ul>
                        </div>
                    </div>
                    </form>
                </div>
            </div> --}}

            <div class="box-body">
                <div class="col-xs-12">
                    <table id="padronTable" class="table" >
                        <thead>
                        <th>
                            Afiliado
                        </th>
                        <th>
                            Apellido y nombre
                        </th>
                        <th>
                             Documento
                        </th>
                        <th>
                            Voto
                       </th>
                        </thead>
                        
                        <tbody>
                           @if($operativosMesas->Padrones)
                                @foreach($operativosMesas->Padrones as $padron)
                                    <tr>
                                        <td>  {{ $padron->Padron->nro_afiliado }} </td>
                                        <td>  {{ $padron->Padron->apellido }} {{ $padron->Padron->nombre }}  </td>
                                        <td>  {{ $padron->Padron->dni }}</td>
                                        <td>
                                            <input type="checkbox" class="btn-cancel" data-id="{{$padron->id}}" {{ $padron->voto ? 'checked' : '' }} />
                                    
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        
    $('#dataTable').DataTable();
    $('#padronTable').DataTable();

    </script>

    <script>

    $(".btn-cancel").on('click',function(ev){
        ev.preventDefault();
        ev.stopPropagation();
        var id = $(this).attr('data-id');
        var btn = $(this);
        swal({
            title: "Confirma que esta persona votó?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: "turno-cancel",
                type: "POST",
                data: "id=" + id,
                success: function (data) {
                    console.log(data)
                    $('.statusTxt').text('Cancelado')
                    btn.hide();
                    swal("Ok!", "Su turno se ha cancelado correctamente!", "success");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Por favor intento de nuevo", "error");
                }
            });
        });
    });
    </script>

@endsection    






