@extends('layouts.master')

@section('content')
<div class="banner"> 
   	   <div class="container_wrap" style="margin-top:5%"> 
   	   <h1 style="font-weight: bold;">Plataforma de Anuncios Web</h1>
   	   <p class=" col-xs-12 text-justify" style="color:white;font-style: italic; font-size:22px;">"Servicio número uno en publicación de perfiles profesionales, anúnciese y abra sus posibilidades
   	   laborales a ambientes nuevos para su crecimiento profesional."</p>
</div>
</div>
<br>
    <div class="content"> 
   	   <div class="container"> 
   	   {!! Form::open(['id'=>'homeServices', 'class' =>'homeServices']) !!}
   		 <div class="col-md-4 bottom_nav"> 
   		    <div class="content_menu" style="margin-left: 86px;"> 
				 <ul>
					 <li class="active"><a href="#">Recientes</a></li>  
					 <li><a href="#">Mejor Precio</a></li>  
				 </ul> 
			 </div> 
		 </div> 
		 <div class="col-md-4 content_dropdown1"> 
		    <div class="content_dropdown">     
		      
            			 <select id="province" name="province" onchange="homeChangeProvince();">
            			     @foreach($provinces as $province)
            			     <option value="{{$province->id}}" id="{{$province->id}}">{{$province->name}}</option> 
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
		     <input type="text" class="form-control filter" placeholder="¿Que buscas?">
			 <!--<ul class="filter"> -->
				<!-- <li class="fil">Filtrar :</li> -->
				<!-- <li><a href=""> <i class="icon1"> </i> </a></li> -->
				<!-- <li><a href=""> <i class="icon2"> </i> </a></li> -->
				<!-- <li><a href=""> <i class="icon3"> </i> </a></li> -->
				<!-- <li><a href=""> <i class="icon4"> </i> </a></li> -->
				<!-- <li><a href=""> <i class="icon5"> </i> </a></li> -->
			 <!--</ul> -->
		 </div> 
		 {!!Form::close()!!}
   	 </div> 
    </div> 
<br>


    <div class="content-fluid">
        <div class="container_wrap">
            <div id="list-allSservice"></div>
        </div>
            
    </div>


 <script>
 $(document).ready(function(){
        listhomeservice();
    });
    
 var listhomeservice = function()
    {
      blockPage();
      $.ajax({
          type:'get',
          url:'{{ url('listhomeservice')}}',
          success: function(data){
              $('#list-allSservice').empty().html(data);
              $.unblockUI();
          }
      });
  }
function homeChangeProvince() {
    var route = "../districsByProvince/" + $("#homeServices #province").val();
      $("#homeServices #district").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#homeServices #district').append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
}

function openService(id) {
    blockPage();
      $.ajax({
          type:'get',
          url:'userservice/'+id,
          success: function(data){
              $('#list-allSservice').empty().html(data);
              $.unblockUI();
          }
      });
}
 </script>

@endsection