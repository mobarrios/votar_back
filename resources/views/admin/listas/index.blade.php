
    @extends('template')

    @section('sectionContent')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Partidos : <strong>{{$partidos->nombre}}</strong></h3>
            <a href="{{route(config('models.'.$section.'.createRoute'),$partidos->id)}}" class="pull-right btn btn-sm btn-default">Crear Lista</a>
        </div>
        <div class="box-body">
            <table class="table">
                @foreach($models as $model)
                    <tr>
                        <td style="width: 1%"> {{$model->id}}</td>
                        {{-- <td class="col-xs-1">
                                <div class="image">
                                    <img src="{{$model->images()->first()['path']}}" class="img-rounded" alt="Imagen" width="60px" >
                                </div>
                            </td> --}}
                        <td>{{$model->nombre}}</td>
                          <td>{{$model->TipoOperativos->nombre}}</td>
                        <td class="col-xs-2">
                            <div class="btn-group">
                                <a href="{{route(config('models.'.$section.'.editRoute'), [ $partidos->id,  $model->id])}}" class="btn btn-sm btn-default"><span class="fa fa-edit"></span></a>
                                <a href="{{route(config('models.'.$section.'.destroyRoute'), [$partidos->id ,$model->id ])}}" class="btn btn-sm btn-default"><span class="fa fa-trash "></span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection