@extends('template')


    @section('sectionContent')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Escuela : <strong>{{$escuela->nombre}}</strong></h3>
            <a href="{{route(config('models.'.$section.'.createRoute'),$escuela->id)}}" class="pull-right btn btn-sm btn-default">Crear Mesa</a>
        </div>
        <div class="box-body">
            <table class="table">
                @foreach($models as $model)
                    <tr>
                        <td style="width: 1%"> {{$model->id}}</td>
                        <td>{{$model->numero }}</td>
                        <td class="col-xs-2">
                            <div class="btn-group">
                                <a href="{{route(config('models.'.$section.'.editRoute'), [ $escuela->id,  $model->id])}}" class="btn btn-sm btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{route(config('models.'.$section.'.destroyRoute'), [$escuela->id ,$model->id ])}}" class="btn btn-sm btn-default"><span class="fa fa-trash "></span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection