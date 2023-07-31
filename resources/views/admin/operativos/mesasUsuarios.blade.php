@extends('template.model_form')

    @section('form_title')
        Mesas Usuarios
    @endsection

    @section('form_inputs')
    @if(Auth::user()->is('root'))
        {!! Form::model($models,['route'=> ['admin.operativos.post.mesasUsuarios', $models->id] ]) !!}
        {!! Form::hidden('operativos_id',$models->id) !!}
    @endif

    <div class="col-xs-12">
        <div class="table-responsive">
                <table class="table" >
                    <thead>
                        <td>Escuela</td>
                        <td>Mesa</td>      
                        <td>Estado</td>
                        <td>Usuarios</td>
                    </thead>
                    <tbody>
                        @if(Auth::user()->is('root'))
                            @include('admin.operativos.partials.rootmesas')
                        @else
                            @include('admin.operativos.partials.adminmesas')
                        @endif
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