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

                                 @foreach($models->Listas as $lista)

                                     <div class="col-xs-1 ">
                                        <img width="100px" src="{{$lista->Partidos->Images->first()->path or ''}}">
                                        
                                    </div>
                                    <div class="col-xs-8">
                                            <h2>{{$lista->nombre}}</h2>
                                            <h3>{{$lista->TipoOperativos->nombre}}</h3>

                                    </div>
                                    <div class="col-xs-3">
                                            <h1><strong class="text-danger">{{ number_format((($lista->Votos->sum('total')*100)/ $total),2)}} %</strong></h1>
                                            <h3>{{$lista->Votos->sum('total')}} votos</h3>
                                    </div>
                                    
                                @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>



    @endsection
      



 
        

