@extends('template')

    @section('sectionContent')

        <div class="row">
            
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h1 class="box-title">{{$models->nombre}}</h1>
                    </div>
                    <div class="box-body">
                        <div class="row">

                                 @foreach($models->Listas->sortBy('tipo_operativos_id') as $lista)

                                     <div class="col-xs-1 ">
                                        <img width="100px" src="{{$lista->Partidos->Images->first()->path or ''}}">
                                        
                                    </div>
                                    <div class="col-xs-8">
                                            <h2>{{$lista->nombre}}</h2>
                                            <h3>{{$lista->TipoOperativos->nombre}}</h3>

                                    </div>
                                    <div class="col-xs-3">

                                            @if($total > 0)
                                                <h1><strong class="text-danger">{{ number_format((($lista->VotosOperativos($models->id)->sum('total')*100)/ $total),2) }} %</strong></h1>
                                            @else
                                                <h1><strong>0</strong>%</h1>
                                            @endif
                                            <h3>{{$lista->VotosOperativos($models->id)->sum('total')}} votos</h3>
                                    </div>    
                                    
                                @endforeach

                                <div class="col-xs-1 ">       
                                </div>
                                <div class="col-xs-8 ">
                                    <h2>Votos en Blanco</h2>
                                </div>
                                <div class="col-xs-3 ">
                                      <h1 class="text-danger" ><strong>{{$models->Votos->sum('total_blancos') }}</strong></h1>
                                </div>
                                <div class="col-xs-1 ">       
                                </div>
                                <div class="col-xs-8 ">
                                    <h2>Votos Nulos</h2>
                                </div>
                                <div class="col-xs-3">
                                      <h1 class="text-danger" ><strong>{{$models->Votos->sum('total_nulos') }}</strong></h1>
                                </div>
                                 <div class="col-xs-1 ">       
                                </div>
                                <div class="col-xs-8 ">
                                    <h2>Votos Impugnados</h2>
                                </div>
                                <div class="col-xs-3">
                                      <h1 class="text-danger" ><strong>{{$models->Votos->sum('total_impugnados') }}</strong></h1>
                                </div>
                                <div class="col-xs-1 ">       
                                </div>
                                <div class="col-xs-8 ">
                                    <h2>Votos Recurridos</h2>
                                </div>
                                <div class="col-xs-3">
                                      <h1 class="text-danger" ><strong>{{$models->Votos->sum('total_recurridos') }}</strong></h1>
                                </div>

                        </div>
                    </div>
                </div>


                    <div class="box">
                        <div class="box-body">
                            <table>
                                <thead>
                                    <th>Municipio</th>
                                    <th>Votos</th>
                                </thead>
                                <tbody>
                                    @foreach($municipios as $municipio)
                                    <tr>
                                        <td>{{$municipio->municipios_id}}</td>
                                        <td>{{$municipio->total}}</td>
                                    </tr> 
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
            </div>

        </div>



    @endsection
      



 
        

