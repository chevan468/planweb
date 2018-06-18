<?php
    $count=0;
?>
@foreach($services as $service)
    @if($count==0)
        <div class="row">
    @endif
    <div class="col-md-4" onclick="openService({{$service->id}});">
        <div class="hoverpanel panel-default">
          <div class="panel-heading">
              <a href="#" class="panel-title" id="openService">{{$service->name}}</a>
          </div>
          <div class="panel-body"  id="openService">
              <div class="form-group">
                  <strong>Nombre: </strong>{{$service->auth}}<span> {{$service->lastName}}</span>
              </div>
              <div class="form-group">
                  <strong>Descripción: </strong>{{$service->description}}
              </div>
              <div class="form-group">
                  <strong>Categoría: </strong>{{$service->category}}
              </div>
              <div class="form-group">
                  <strong>Precio: </strong>{{$service->price}} x {{$service->pricePer}}
              </div>
              <div class="form-group">
                  <strong>Provincia: </strong>{{$service->province}}
              </div>
            
          </div>
        </div>
    </div>

     <?php
        $count=$count+1;
    ?>
    
    @if($count==3)
       </div>
       <div class="clearfix"></div>
       <br>
      <?php
        $count=0;
        ?>
    @endif
   
@endforeach

