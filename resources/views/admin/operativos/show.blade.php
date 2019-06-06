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

                                       <div>
                                         <h1>{{$models->Votos->sum('total_blancos') }}</h1>
                                         <h1>{{$models->Votos->sum('total_nulos') }}</h1>
                                         <h1>{{$models->Votos->sum('total_impugnados') }}</h1>
                                         <h1>{{$models->Votos->sum('total_recurridos') }}</h1>

                                         {{-- <h1>{{$lista->VotosOperativos($models->id)->sum('total_nulos') }}</h1>
                                         <h1>{{$lista->VotosOperativos($models->id)->sum('total_impugnados') }}</h1>
                                         <h1>{{$lista->VotosOperativos($models->id)->sum('total_recurridos') }}</h1>
 --}}

                                    </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    @endsection
      



 
        

