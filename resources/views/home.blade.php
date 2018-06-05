@extends('layouts.master')

@section('content')
<div class="banner"> 
   	   <div class="container_wrap" style="margin-top:5%"> 
   	   <h1 style="font-weight: bold;">Plataforma de Anuncios Web</h1>
   	   <br>
   	   <p class="text-justify" style="color:white;font-style: italic; font-size:5;">"Servicio número uno en publicación de perfiles profesionales, anúnciese y abra sus posibilidades
   	   laborales a ambientes nuevos para su crecimiento profesional."</p>
</div>
</div>
<br>
    <div class="content"> 
   	   <div class="container"> 
   		 <div class="col-md-4 bottom_nav"> 
   		    <div class="content_menu"> 
				 <ul> 
					 <li class="active"><a href="#">Recommended</a></li>  
					 <li><a href="#">Latest</a></li>  
					 <li><a href="#">Highlights</a></li>  
				 </ul> 
			 </div> 
		 </div> 
		 <div class="col-md-4 content_dropdown1"> 
		    <div class="content_dropdown">     
		      
            			 <select id="province" name="province">
            			     @foreach($provinces as $province)
            			     <option id="{{$province->id}}">{{$province->name}}</option> 
            			     @endforeach
			           </select> 
		      
		      </div> 
		      <div class="content_dropdown">     
		       <select id="district" name="district">
            			     @foreach($districts as $district)
            			     <option id="{{$district->id}}">{{$district->name}}</option> 
            			     @endforeach
			           </select> 
		        </div> 
		 </div> 
		 <div class="col-md-4 filter_grid"> 
			 <ul class="filter"> 
				 <li class="fil">Filter :</li> 
				 <li><a href=""> <i class="icon1"> </i> </a></li> 
				 <li><a href=""> <i class="icon2"> </i> </a></li> 
				 <li><a href=""> <i class="icon3"> </i> </a></li> 
				 <li><a href=""> <i class="icon4"> </i> </a></li> 
				 <li><a href=""> <i class="icon5"> </i> </a></li> 
			 </ul> 
		 </div> 
   	 </div> 
    </div> 
<br>
<div class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
                $count=0;
            ?>
            @foreach($services as $service)
                @if($count==0)
                    <div class="row">
                @endif
                <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">{{$service->name}}</h3>
                      </div>
                      <div class="panel-body">
                          <div class="form-group">
                              <strong>Nombre: </strong>{{$service->auth}}<span> {{$service->lastName}}</span>
                          </div>
                          <div class="form-group">
                              <strong>Descripción: </strong>{{$service->description}}
                          </div>
                          <div class="form-group">
                              <strong>Categoría: </strong>{{$service->category}}
                          </div>
                        
                      </div>
                    </div>
                </div>
  
                 <?php
                    $count=$count+1;
                ?>
                
                @if($count==2)
                   </div>
                   <div class="clearfix"></div>
                   <br>
                  <?php
                    $count=0;
                    ?>
                @endif
               
			@endforeach

    </div>
</div>
</div>

 <script>
// $("#province").change(function() {
//       var id = $(this).children(":selected").attr("id");
//       var route = "../districsByProvince/" + $("#province").val();
//       $("#district").empty();
//       alert(id);
//       $.get(route, function(res) {
//         if (res.length!=0) {
//             alert(value.name);
//           $(res).each(function(key, value) {
//               $('#district').append($('<option>', {value:value.id, text:value.name}));
//           });
//         }
//       });
// });

    
 </script>

@endsection