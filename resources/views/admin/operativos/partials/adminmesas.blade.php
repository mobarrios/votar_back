@foreach($models as $mesasUser)  
    <tr>
        <td>{{ $mesasUser->Mesa->Escuelas->nombre }}</td>
        <td>
            <a href="{{ route('admin.mesas.show',[$mesasUser->Mesa->Escuelas->id,$mesasUser->Mesa->id,$mesasUser->operativos_id]) }}" >{{$mesasUser->Mesa->numero}}</a> 
        </td>
        <td>{{ $mesasUser->Mesa->Operativo($mesasUser->operativos_id) ? $mesasUser->Mesa->Operativo($mesasUser->operativos_id)->estado : '' }}</td>
        <td class="col-xs-8">
            {{ $mesasUser->User->user_name }}
        </td>
    </tr>    
@endforeach