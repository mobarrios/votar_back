@extends('template')

    @section('form_title')
       Orden # {{$models->codigo_orden}}
    @endsection

 	@section('sectionContent')
    <div class="row">
    	<div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">  Orden # {{$models->codigo_orden}}
              </h3>

              <div class="pull-right ">
                <a href="{{route('ordenes.reporte',$models->id)}}" target="_blank" class="pull-right btn btn-default btn-sm">
                  <em class="fa fa-print"></em>
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                        Datos del Cliente
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                      Codigo Cliente : {{ isset($models->Cliente->id) ? $models->Cliente->id : '' }}
                      <br>
                      Apellido y Nombre : {{ isset($models->Cliente->fullname) ? $models->Cliente->fullname : '' }}
                      <br>
                      Razon Social: {{ isset($models->Cliente->razon_social) ? $models->Cliente->razon_social : '' }}
                      <br>
                      DNI / CUIT: {{ isset($models->Cliente->direccion)  ? $models->Cliente->direccion : ''}}
                      <br>
                      Email: {{ isset($models->Cliente->email) ? $models->Cliente->email : ''}}
                      <br>
                      Direccion: {{ isset($models->Cliente->direccion) ? $models->Cliente->direccion : '' }}
                      <br>
                      Tel / Cel: {{ isset($models->Cliente->telefono) ? $models->Cliente->telefono : '' }}
                      
                      <br>
                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        Equipo a Reparar
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                      Equipo : {{ isset($models->Equipo->descripcion) ? $models->Equipo->descripcion : '' }}
                      <br>
                      Marca : {{ isset($models->Marca->descripcion) ? $models->Marca->descripcion : '' }}
                      <br>
                      Model : {{ isset($models->Modelo->descripcion) ? $models->Modelo->descripcion : '' }}
                      <br>
                      Número Serie : {{ $models->numero_serie  }}
                      <br>
                      Partes Serie : {{ $models->serie_partes  }}
                      <br>
                      Falla : {{ $models->numero_serie  }}
                      <br>
                      Presupuesto : $ {{ $models->presupuesto_estimado  }}
                      <br>
                      Observaciones : {{ $models->observaciones  }}
                      <br>

                    </div>
                  </div>
                </div>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                        Técnico
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
                    </div>
                  </div>

                </div>
                  <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                        Estado de Orden
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                 
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Usuario</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{--
                      @foreach($models->OrdenEstados as $orden)
                          <tr>
                            <td>{{$orden->created_at}}</td>
                            <td>{{ isset($orden->User->email)  ? $orden->User->email : ''}}</td>
                            <td>{{ isset($orden->Estado->descripcion) ? $orden->Estado->descripcion : '' }}</td>
                            </tr>                            
                      @endforeach
                      --}}
                      </tbody>
                    </table>
                     <hr>
                        <div class="row">  
                          {{--
                          {!! Form::open(['route'=>('ordenes.updateEstado')]) !!}
                            <div class="col-xs-10">
                            {!! Form::label('Estados') !!}
                            {!! Form::select('estado_id',$estados, isset($models->estado_id) ? $models->estado_id : null, ['class'=>'form-control select2', 'style' => 'width:330px;']) !!}
                            {!! Form::hidden('orden_id', $models->id) !!}
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary btn-block btn-flat btn-xs" style='width:100px;' >Guardar</button>
                            </div>
                           {!! Form::close() !!}
                          --}}
                        </div>  
                    </div>
                  </div>
                  
                </div>
                   <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">
                          Observaciones Tecnicas
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                      <div class="box-body">
                          <!-- textarea -->
                          {{--
                          {!! Form::open(['route'=>('ordenes.updateObservaciones')]) !!}
                          <div class="form-group">
                            <label>FALLA DECLARADA</label>
                            <textarea class="form-control" rows="3" name="falla_declarada" > {{$models->falla_declarada}}</textarea>
                          </div>
                          <div class="form-group">
                            <label>OBSERVACIONES</label>
                            <textarea class="form-control" rows="3" name="observaciones"> {{$models->observaciones}}</textarea>
                          </div>
                          <div class="form-group">
                            <label>OBSERVACIONES TECNICAS</label>
                            <textarea class="form-control" rows="3" name="observaciones_tecnicas"> {{$models->observaciones_tecnicas}}</textarea>
                          </div>
                          {!! Form::hidden('orden_id', $models->id) !!}
                          <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                          {!! Form::close() !!}
                          --}}
                      </div>
                    </div>
                </div>
                <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">
                            Pagos
                          </a>
                        </h4>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="box-body">
                          <table class="table table-striped">
                            {{--
                            {!! Form::open(['route'=>('ordenes.updatePagos')]) !!}

                            <tbody>
                              
                            <tr>
                             
                              <td width="45%">PRESUPUESTO ESTIMADO</td>
                             
                              <td> 
                                  <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-sm" disabled value="{{$models->presupuesto_estimado}}">

                                    <span class="input-group-addon">.00</span>
                                  </div>
                              </td>
                            </tr>
                            <tr>
                             
                              <td width="45%">PAGADO</td>
                             
                              <td> 
                                  <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control input-sm" value="{{$models->pagado}}" name="pagado">
                                    <span class="input-group-addon">.00</span>
                                    {!! Form::hidden('orden_id', $models->id) !!}
                                  </div>
                              </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="btn btn-primary pull-right">Guardar</button></td>
                            </tr>
                            </tbody>
                             {!! Form::close() !!}
                          </table>
                            --}}
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>
  @endsection