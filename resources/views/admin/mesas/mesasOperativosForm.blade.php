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
                @foreach($operativosMesas->VotoLista as $voto)
                    <tr>
                        <td> {{ $voto->Listas->TipoOperativos->nombre }} </td>
                        <td> {{ $voto->Listas->nombre }} </td>
                        <td> <input value="{{ $voto->cantidad_votos }}"></td>
                    </tr>
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
                @if($operativosMesas->VotoMesa)
                    <tr>
                        <td><input value="{{$operativosMesas->VotoMesa->total_blancos}}"></td>
                        <td><input value="{{$operativosMesas->VotoMesa->total_nulos}}"></td>
                        <td><input value="{{$operativosMesas->VotoMesa->total_recurridos}}"></td>
                        <td><input value="{{$operativosMesas->VotoMesa->total_impugnados}}"></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
    
        
@section('secondContent')

<div class="row">
    <!-- Default box -->
    <div class="col-xs-12">
        <div class="box">
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






