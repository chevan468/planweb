
   <div class="container">
       <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">{{$service->name}}</h3>
           </div>
            <div class="panel-body">

       @include('partials.messages')
        <div class="row">
			        <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <strong>Nombre: </strong>{{$service->auth}}<span> {{$service->lastName}}</span>
                         </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <strong>Categoría: </strong><span> {{$service->category}}</span>
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-12 col-xs-12">
			            <div class="form-group">
                          <strong>Descripción: </strong><span> {{$service->description}}</span>
                         </div>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                          <strong>Precio: </strong><span> {{$service->price}}</span>
                         </div>
			        </div>
			        <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                          <strong>Precio por: </strong><span> {{$service->pricePer}}</span>
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <strong>Provincia: </strong><span> {{$service->province}}</span>
                         </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                          <strong>Cantón: </strong><span> {{$service->district}}</span>
                         </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                          <strong>Dirección exacta: </strong><span> {{$service->fullAddress}}</span>
                         </div>
			        </div>
			     </div>
			     <div class="row">
			         <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                          <strong>Teléfono: </strong><span> {{$service->contactNumber}}</span>
                         </div>
			        </div>
			        <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                          <strong>E-mail: </strong><span> {{$service->contactEmail}}</span>
                         </div>
			        </div>
			     </div>

     </div>
             <div class="panel-footer">
              <a href="#" onclick="listhomeservice();">Volver a la lista</a>
          </div>
       </div>
     @if (Auth::guest())
     <h5><a href="{{ url('/register') }}">Registrese</a> para poder enviar un mensaje a {{$service->auth}}</h5>
     @else
     <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Mensajes</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-xs-10">
                    <input type="text" class="form-control" placeholder="Digite su mensaje para contactar a {{$service->auth}}">
                </div>
                <div class="col-md-2 col-xs-2">
                    <a class="btn btn-info">Enviar</a>
                </div>
            </div>
        </div>
    </div>
     @endif
   </div>