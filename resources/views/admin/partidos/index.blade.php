@extends('template.model_index')
    @section('table')
        
        @foreach($models as $model)
       
            <tr>

                <td style="width: 1%"><input class="id_destroy" value="{{$model->id}}" type="checkbox"></td>
                <td class="col-xs-1">
                    <div class="image">
                        <img src="{{$model->images()->first()['path']}}" class="img-rounded" alt="Imagen" width="60px" >
                    </div>
                </td>
                <td>{{$model->nombre }}</td>
                <td><a href="{{route('admin.listas.index',$model->id)}}" class="btn btn-success btn-xs"><span class="fa fa-table"></span> Listas </a></td>
            </tr>
        @endforeach
    @endsection