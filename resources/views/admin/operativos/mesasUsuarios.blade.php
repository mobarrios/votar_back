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