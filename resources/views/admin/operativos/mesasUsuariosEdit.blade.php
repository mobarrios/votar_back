@extends('template.model_form')

    @section('form_title')
        Mesas Usuarios
    @endsection

    @section('form_inputs')
    @if(Auth::user()->is('root'))
        {!! Form::model($operativoId,['route'=> ['admin.operativos.post.mesasUsuarios', $operativoId] ]) !!}
        {!! Form::hidden('operativos_id',$operativoId) !!}
    @endif
    
    <div class="col-xs-12">
        <div class="table-responsive">
                <table class="table" >
                    <thead>
                        <td>Usuarios</td>
                    </thead>
                    <tbody>
                        <td class="col-xs-8">
                            <select name="mesas[]" class="form-control select2" multiple="multiple">
                                @foreach($usuarios as $usuario)
                                    @if($usuario->OperativosMesasUsers($operativoId, $mesaId,$usuario->id))
                                        <option selected="selected" value="{{$mesaId}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                                    @else
                                        <option  value="{{$mesaId}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tbody>
                </table>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('.select2').on("select2:unselect", function (e) { 
       
        var data = e.params.data.id
        var opId  = $('input[name="operativos_id"]').val();
        $.ajax({
            url: 'admin/update-mesa-user',
            type: 'POST',
            //data: { id: 1, data:  data, _token: '{{ csrf_token() }}},
            'data':{'id':data, 'opId': opId ,'_token': '{{ csrf_token() }}'},
            success: function(response) {
                // Eliminar el elemento del select2
                //$('#miSelect2 option[value="' + seleccionado + '"]').remove();
                //$('#miSelect2').trigger('change');
                swal(
                    'Ok!',
                    'Su Registro ha modificado correctamento.',
                    'success'
                )
            }
        });
    });
    </script>

@endsection