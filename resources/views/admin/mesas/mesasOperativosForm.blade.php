@extends('template.model_form')

@section('form_title')
Mesas Operativo
@endsection

@section('form_inputs')
    
    {!! Form::model($models,['route'=> ['admin.mesas.votos.edit', $escuela->id,$models->id] , 'files' =>'true']) !!}

    <div class="col-xs-4 form-group">
        {!! Form::label('Estado') !!}
        {!! Form::select('estados_id', $estados, $operativosMesas->estados_mesas_id,['class'=>'form-control']) !!}
    </div>
    <div class="col-xs-8 form-group">
        {!! Form::label('Número') !!}
        {!! Form::text('numero', null, ['class'=>'form-control', 'disabled']) !!}
    </div>
    {!! Form::hidden('operativos_mesas_id', $operativosMesas->id) !!}
    {!! Form::hidden('users_id', 1) !!}

    <br>
    
    <div class="col-xs-4">
        <table class="table" >
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
                        <td> <input value="{{ $voto->cantidad_votos }}" name="votos[{{ $voto->id }}]"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        
    </div>
    
    <div class="col-xs-8">
        <table class="table table-responsive">
            <thead>
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
                <th>
                    Total
                </th>
            </thead>
            
            <tbody>
                @if($operativosMesas->VotoMesa)
                    <tr>
                        <td><input name="total_blancos" value="{{$operativosMesas->VotoMesa->total_blancos}}"></td>
                        <td><input name="total_nulos" value="{{$operativosMesas->VotoMesa->total_nulos}}"></td>
                        <td><input name="total_recurridos" value="{{$operativosMesas->VotoMesa->total_recurridos}}"></td>
                        <td><input name="total_impugnados" value="{{$operativosMesas->VotoMesa->total_impugnados}}"></td>
                        <td><input name="total" value="{{$operativosMesas->VotoMesa->total}}"></td>
                    </tr>
                @endif
            </tbody>
            
        </table>
        @if(isset($operativosMesas->VotoMesa))
            @if(count($operativosMesas->VotoMesa->images) > 0)
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a href="{{ $operativosMesas->VotoMesa->images->first()->path }}" target="_blank">
                    <img src="{{ $operativosMesas->VotoMesa->images->first()->path }}" class="img-responsive">
                </a>
            </div>
            @endif
        @endif
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body">
      
              </div>
          </div>
        </div>
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
    $('#padronTable').DataTable({
        "order": [[ 1, 'asc' ]],
        "pageLength": 20 
    });



    </script>

    <script>

    $('.btn-cancel').on('click',function(){
        var btn = $(this);
        //$(btn).prop("disabled",true);
        var id = $(this).attr('data-id');
        var url = 'admin/update-padron';

        swal({
            title: "Desea modificar el registro?",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "No",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            closeOnConfirm: false
        }).then(function () {
            swal(
                    'Ok!',
                    'Su Registro ha modificado correctamento.',
                    'success'
            )
            $.ajax({
                'url': url,
                'data':{'id':id, '_token': '{{ csrf_token() }}'},
                'method': 'POST',
              
            });
        })
    });


    </script>

@endsection    






