@extends('template')

    @section('sectionContent')

        {{-- <div class="row">
            
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header text-center" >
                        <h1>{{$models->nombre}}</h1>
                    </div>
                    <div class="box-body">
                        <div class="row"> --}}

            <div class="box">
                <div class="box-header">
                    <h1 class="text-center">Presidente - Vice</h1>
                </div>
                <div class="box-body">
                    @foreach($models->Listas->sortBy('tipo_operativos_id') as $lista)
                        @if($lista->tipo_operativos_id == 1)
                            <div class="col-xs-1 ">
                                <img width="100px" src="{{$lista->Partidos->Images->first()->path or ''}}">
                            </div>
                            <div class="col-xs-8">
                                <h2>{{$lista->nombre}}</h2>
                                {{-- <h3>{{$lista->TipoOperativos->nombre}}</h3> --}}
                            </div>
                            <div class="col-xs-3">
                                @if($total > 0)
                                {{--   <h1><strong class="text-danger">{{ number_format((($lista->VotosOperativos($models->id)->sum('total')*100)/ $total),2) }} %</strong></h1> --}}
                                    <h1><strong class="text-danger">{{ number_format(( (($lista->VotosOperativos($models->id)->sum('total'))*100 ) / $lista->VotosTipoOperativos($models->id,$lista->tipo_operativos_id)->total),2) }} %</strong></h1>
                                @else
                                    <h1><strong>0</strong>%</h1>
                                @endif
                                <h3>{{$lista->VotosOperativos($models->id)->sum('total')}} votos</h3>
                            </div> 
                        @endif
                    @endforeach
                    <canvas id="t1"></canvas>
                </div>
            </div>


            <div class="box">
                    <div class="box-header">
                        <h1 class="text-center">Gobernadores</h1>
                    </div>
                    <div class="box-body">
                        @foreach($models->Listas->sortBy('tipo_operativos_id') as $lista)
                            @if($lista->tipo_operativos_id == 2)
                                <div class="col-xs-1 ">
                                    <img width="100px" src="{{$lista->Partidos->Images->first()->path or ''}}">
                                </div>
                                <div class="col-xs-8">
                                    <h2>{{$lista->nombre}}</h2>
                                    {{-- <h3>{{$lista->TipoOperativos->nombre}}</h3> --}}
                                </div>
                                <div class="col-xs-3">
                                    @if($total > 0)
                                    {{--   <h1><strong class="text-danger">{{ number_format((($lista->VotosOperativos($models->id)->sum('total')*100)/ $total),2) }} %</strong></h1> --}}
                                        <h1><strong class="text-danger">{{ number_format(( (($lista->VotosOperativos($models->id)->sum('total'))*100 ) / $lista->VotosTipoOperativos($models->id,$lista->tipo_operativos_id)->total),2) }} %</strong></h1>
                                    @else
                                        <h1><strong>0</strong>%</h1>
                                    @endif
                                    <h3>{{$lista->VotosOperativos($models->id)->sum('total')}} votos</h3>
                                </div> 
                            @endif
                        @endforeach
                        <canvas id="t2"></canvas>
                    </div>
                </div>



                <div class="box">
                        <div class="box-header">
                            <h1 class="text-center">Legisladores</h1>
                        </div>
                        <div class="box-body">
                            @foreach($models->Listas->sortBy('tipo_operativos_id') as $lista)
                                @if($lista->tipo_operativos_id == 3)
                                    <div class="col-xs-1 ">
                                        <img width="100px" src="{{$lista->Partidos->Images->first()->path or ''}}">
                                    </div>
                                    <div class="col-xs-8">
                                        <h2>{{$lista->nombre}}</h2>
                                        {{-- <h3>{{$lista->TipoOperativos->nombre}}</h3> --}}
                                    </div>
                                    <div class="col-xs-3">
                                        @if($total > 0)
                                        {{--   <h1><strong class="text-danger">{{ number_format((($lista->VotosOperativos($models->id)->sum('total')*100)/ $total),2) }} %</strong></h1> --}}
                                            <h1><strong class="text-danger">{{ number_format(( (($lista->VotosOperativos($models->id)->sum('total'))*100 ) / $lista->VotosTipoOperativos($models->id,$lista->tipo_operativos_id)->total),2) }} %</strong></h1>
                                        @else
                                            <h1><strong>0</strong>%</h1>
                                        @endif
                                        <h3>{{$lista->VotosOperativos($models->id)->sum('total')}} votos</h3>
                                    </div> 
                                @endif
                            @endforeach
                            <canvas id="t3"></canvas>
                        </div>
                    </div>

                    <div class="box">
                            <div class="box-body"> 
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
                        {{-- </div>
                    </div>
                </div> --}}

                {{-- <div class="box">  
                        <div class="box-body">
                             <div class="box-title">
                                <h3>Presidente - Vice</h3>
                             </div>
                            <canvas id="t1" ></canvas>
                        </div>
                    </div> --}}

                {{-- <div class="box">  
                    <div class="box-body">
                         <div class="box-title">
                            <h3>Gobernadores</h3>
                         </div>
                        <canvas id="t2" ></canvas>
                    </div>
                </div> --}}
                  {{-- <div class="box">  
                    <div class="box-body">
                         <div class="box-title">
                            <h3>Legisladores</h3>
                         </div>
                        <canvas id="t3" ></canvas>
                    </div>
                </div> --}}
                 {{-- <div class="box">  
                    <div class="box-body">
                         <div class="box-title">
                            <h3>Concejales</h3>
                         </div>
                        <canvas id="t4" ></canvas>
                    </div>
                </div> --}}
                 {{-- <div class="box">  
                    <div class="box-body">
                         <div class="box-title">
                            <h3>Intendentes</h3>
                         </div>
                        <canvas id="t5" ></canvas>
                    </div>
                </div> --}}

                    <div class="box">
                        <div class="box-body">
                            <table class="table">
                                <thead>
                                    <th>Municipio</th>
                                    <th>Votos</th>
                                </thead>
                                <tbody>
                                    @foreach($municipios as $municipio)
                                    <tr>
                                        <td><span class="muni" data="{{$municipio->municipios_id}}"></span></td>
                                        <td>{{$municipio->total}}</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            {{-- </div>

        </div> --}}



    @endsection

    @section('js')

    <script type="text/javascript">


        $('.muni').each(function(){
            var id = $(this).attr('data');

            var input = $(this);


            $.ajax({
             url: "https://apis.datos.gob.ar/georef/api/municipios?id="+id+"&aplanar",
                    }).done(function(data) {
                        //$.each(data.provincias, function(i, item) 
                        //{                         
                            input.text(data['municipios'][0]['nombre']);
                            //$('#provincias').append('<option value="'+item.id+'" >'+item.nombre+'</option>')
                        //});
            });
        });
        
           
            //chart
            
            var ctx = document.getElementById('t1').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($tipo1 as $t1)
                            '{{$t1->nombre}}',
                            @endforeach],
                datasets: [{
                    label: 'Total de Votos',
                    data: [@foreach($tipo1 as $t1)
                            {{$t1->total}},
                            @endforeach],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
            });
            

            var ctx = document.getElementById('t2').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($tipo2 as $t2)
                            '{{$t2->nombre}}',
                            @endforeach],
                datasets: [{
                    label: 'Total de Votos',
                    data: [@foreach($tipo2 as $t2)
                            {{$t2->total}},
                            @endforeach],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
            });
            

            var ctx = document.getElementById('t3').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($tipo3 as $t3)
                            '{{$t3->nombre}}',
                            @endforeach],
                datasets: [{
                    label: 'Total de Votos',
                    data: [@foreach($tipo3 as $t3)
                            {{$t3->total}},
                            @endforeach],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
            });

            // var ctx = document.getElementById('t4').getContext('2d');
            // var myChart = new Chart(ctx, {
            // type: 'line',
            // data: {
            //     labels: [@foreach($tipo4 as $t4)
            //                 '{{$t4->nombre}}',
            //                 @endforeach],
            //     datasets: [{
            //         label: 'Total de Votos',
            //         data: [@foreach($tipo4 as $t4)
            //                 {{$t4->total}},
            //                 @endforeach],
            //         backgroundColor: [
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(75, 192, 192, 0.2)',
            //             'rgba(153, 102, 255, 0.2)',
            //             'rgba(255, 159, 64, 0.2)',
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(75, 192, 192, 0.2)',
            //             'rgba(153, 102, 255, 0.2)',
            //             'rgba(255, 159, 64, 0.2)'
            //         ],
            //         borderColor: [
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)',
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)'
            //         ],
            //         borderWidth: 1
            //     }]
            // }
            // });
            

            // var ctx = document.getElementById('t5').getContext('2d');
            // var myChart = new Chart(ctx, {
            // type: 'line',
            // data: {
            //     labels: [@foreach($tipo5 as $t5)
            //                 '{{$t5->nombre}}',
            //                 @endforeach],
            //     datasets: [{
            //         label: 'Total de Votos',
            //         data: [@foreach($tipo5 as $t5)
            //                 {{$t5->total}},
            //                 @endforeach],
            //         backgroundColor: [
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(75, 192, 192, 0.2)',
            //             'rgba(153, 102, 255, 0.2)',
            //             'rgba(255, 159, 64, 0.2)',
            //             'rgba(255, 99, 132, 0.2)',
            //             'rgba(54, 162, 235, 0.2)',
            //             'rgba(255, 206, 86, 0.2)',
            //             'rgba(75, 192, 192, 0.2)',
            //             'rgba(153, 102, 255, 0.2)',
            //             'rgba(255, 159, 64, 0.2)'
            //         ],
            //         borderColor: [
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)',
            //             'rgba(255, 99, 132, 1)',
            //             'rgba(54, 162, 235, 1)',
            //             'rgba(255, 206, 86, 1)',
            //             'rgba(75, 192, 192, 1)',
            //             'rgba(153, 102, 255, 1)',
            //             'rgba(255, 159, 64, 1)'
            //         ],
            //         borderWidth: 1
            //     }]
            // }
            // });
            

    </script>

@endsection
      



 
        

