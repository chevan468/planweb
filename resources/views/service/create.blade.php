@extends('layouts.master')

@section('content')
<br>

<div class="row">
    <div class="col-md-9 col-md-offset-2">
        @include('partials.messages')

    <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
      <strong id="error"></strong>
    </div>

   <div class="row">
     <div class="col-md-10">

        <div class="panel panel-default">
          <div class="panel-heading">
             Nuevo
           </div>
          <div class="panel-body">
            
			    {!! Form::open(['id'=>'addServiceForm']) !!}
			    <div class="row">
			        <div class="col-md-7">
                        <div class="form-group">
                          {!!form::label('Nombre')!!}
                          {!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Nombre del servicio a realizar','required'])!!}
                         </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                          {!!form::label('Categoría')!!}
                          {!!form::select('category',$categories,null,['id'=>'category','class'=>'form-control'])!!}
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-12">
			            <div class="form-group">
                          {!!form::label('Descripción')!!}
                          {!!form::text('description',null,['id'=>'description','class'=>'form-control','placeholder'=>'Digite una descripción general del servicio','required'])!!}
                         </div>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-md-6">
			            <div class="form-group">
                          {!!form::label('Precio')!!}
                          {!!form::number('price',null,['id'=>'price','class'=>'form-control','placeholder'=>'Colones','required'])!!}
                         </div>
			        </div>
			        <div class="col-md-6">
                        <div class="form-group">
                          {!!form::label('Precio por')!!}
                          {!!form::select('pricePer',$price_pers,null,['id'=>'pricePer','class'=>'form-control'])!!}
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-3">
                        <div class="form-group">
                          {!!form::label('Provincia')!!}
                          {!!form::select('province',$provinces,null,['id'=>'province', 'name'=>'province', 'onchange'=>'changeProvince()','class'=>'form-control'])!!}
                         </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          {!!form::label('Cantón')!!}
                          {!!form::select('district',$districts,null,['id'=>'district','name'=>'district' ,'class'=>'form-control'])!!}
                         </div>
                    </div>
                    <div class="col-md-6">
			            <div class="form-group">
                          {!!form::label('Otras señas')!!}
                          {!!form::text('fullAddress',null,['id'=>'fullAddress','class'=>'form-control','placeholder'=>'150 mts este del templo...','required'])!!}
                         </div>
			        </div>
			        <div class="col-md-6">
			            <div class="form-group">
                          {!!form::label('Teléfono')!!}
                          {!!form::number('contactNumber',null,['id'=>'contactNumber','class'=>'form-control','placeholder'=>'88888888','required'])!!}
                         </div>
			        </div>
			        <div class="col-md-6">
			            <div class="form-group">
                          {!!form::label('Correo')!!}
                          {!!form::email('contactEmail',null,['id'=>'contactEmail','class'=>'form-control','placeholder'=>'Colones','required'])!!}
                         </div>
			        </div>
			    </div>
	      	                       
              {!!link_to('#','Guardar', ['id'=>'Grabar','class'=>'btn btn-warning btn-sm m-t-10'])!!}

             <button type="button" id='cancelar'  name='cancelar' class="btn btn-info btn-sm m-t-10" >Cancelar</button>             
          {!!Form::close()!!}

           </div>
        </div>
     </div>
   </div>
    </div>
</div>

<!--<ol class="breadcrumb">-->
<!--     <li><a href="{{url('dashboard')}}">Escritorio</a></li>-->
<!--     <li><a href="{{url('product')}}"> Productos</a></li>-->
<!--     <li class="active">Nuevo Servicio</li>-->
<!--   </ol>-->



<script>

	$("#cancelar").click(function(event)
	{
	  document.location.href = "{{ route('services.index')}}";
	});
    
    
    function changeProvince() {
    var route = "../districsByProvince/" + $("#addServiceForm #province").val();
      $("#addServiceForm #district").empty();
      
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#addServiceForm #district').append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
    }
    

	
</script>
  

@endsection




 