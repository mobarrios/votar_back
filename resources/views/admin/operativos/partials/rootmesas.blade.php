@foreach($models->Escuelas as $escuela)
    @foreach($escuela->Mesas as $mesa)
        <tr>
            <td>{{$escuela->nombre}}</td>
            <td><a href="{{route('admin.mesas.show',[$escuela->id,$mesa->id,$models->id])}}" >{{$mesa->numero}}</a></td>
            <td>{{ 
                    $mesa->Operativo($models->id) ? 
                    $mesa->Operativo($models->id)->estado : '' 
                }}
                - 
                {{  
                    $mesa->Operativo($models->id) ? 
                    $mesa->Operativo($models->id)->estadoFinal : '' 
                }}
               
            </td>
           
            <td class="col-xs-8">
                <select name="mesas[]" class="form-control select2" multiple="multiple">
                    @foreach($usuarios as $usuario)

                        @if($usuario->OperativosMesasUsers($models->id,$mesa->id,$usuario->id))
                            <option selected="selected" value="{{$mesa->id}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                        @else
                            <option  value="{{$mesa->id}}_{{$usuario->id}}">{{$usuario->user_name}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
        </tr>           
    @endforeach
@endforeach