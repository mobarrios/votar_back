@extends('template')

    @section('sectionContent')

        <div class="row">
            
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h1 class="box-title">Operativo</h1>
                    </div>
                    <div class="box-body">
                        <div class="row">
                                @foreach($models->Listas as $lista)
                                    <div class="col-xs-12">
                                            <h1>{{$lista->nombre}}</h1>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    @endsection
      



 
        

