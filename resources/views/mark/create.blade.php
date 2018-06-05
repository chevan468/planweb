@extends('layouts.master')

@section('title','Marca Nuevo')

@section('content')

<ol class="breadcrumb">
     <li><a href="{{url('dashboard')}}">Escritorio</a></li>
     <li><a href="{{url('product')}}"> Productos</a></li>
     <li class="active">Nueva Marca</li>
   </ol>

@include('partials.messages')

    <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
      <strong id="error"></strong>
    </div>


   <div class="page-header">
     <h1>Marca Nuevo </h1>
   </div>

   <div class="row">
     <div class="col-md-8">

        <div class="panel panel-default">
          <div class="panel-heading">
             Marca Nuevo
           </div>
          <div class="panel-body">
            
			    {!! Form::open(['id'=>'form']) !!}

	      	<div class="form-group">
                  {!!form::label('Nombre')!!}
                  {!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Digite marca','required'])!!}
             </div>                       

              {!!link_to('#','Grabar', ['id'=>'Grabar','class'=>'btn btn-warning btn-sm m-t-10'])!!}

             <button type="button" id='cancelar'  name='cancelar' class="btn btn-info btn-sm m-t-10" >Cancelar</button>             
          {!!Form::close()!!}



           </div>
        </div>


     </div>
   </div>

<script>

	$("#cancelar").click(function(event)
	{
	  document.location.href = "{{ route('mark.index')}}";
	});



    $("#Grabar").click(function(event)
    {
            var name = $("#name").val();
            var token = $("input[name=_token]").val();

            var route = "{{route('mark.store')}}";
            var dataSting = "name="+name;

      
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            datatype: 'json',
            //async: false,
            data:dataSting,
            success:function(data)
            {
                if(data.success == 'true')
                {
                    document.location.href= '{{ route("mark.index")}}';
                }
            },
            error:function(data)
            {
                
                $("#error").html(data.responseJSON.name);
                $("#message-error").fadeIn();
                if (data.status == 422) {
                   console.clear();
                }

            }  
          })
      


    });  

	
</script>
  

@endsection




 