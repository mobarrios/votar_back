@extends('template.model_index')
    @section('table')
        @foreach($models as $model)
            <tr>
                <td style="width: 1%"><input class="id_destroy" value="{{$model->id}}" type="checkbox"></td>
                <td>{{$model->id}}</td>
                <td>{{$model->name }}</td>
                <td>{{$model->Company->razon_social or '' }}</td>
                <td>{{$model->address}}</td>
                <td>{{$model->phone}}</td>

            </tr>
        @endforeach
    @endsection