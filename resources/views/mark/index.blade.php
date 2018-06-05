@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')

     
  <ol class="breadcrumb">
     <li><a href="{{url('dashboard')}}">Escritorio</a></li>
     <li class="active">Marcas</li>
   </ol>
 

   <div class="page-header">
     <h1>Marcas <small>Actualizados hasta hoy</small></h1>
   </div>

   <div class="row">
     <div class="col-md-8">

       @include('partials.messages')


      <div id="message-update" class="alert alert-success alert-dismissible" role="alert" style="display:none">
          <strong> Se Actualizado Correctamente.</strong>
      </div>


      <div id="message-delete" class="alert alert-info" role="alert" style="display:none">
          <strong> El registro se elimino correctamente.</strong>
      </div>

      <div class="panel panel-default">
          <div class="panel-heading">
             Lista
             <p class="navbar-text navbar-right" style=" margin-top: 1px;">
                <button type="button" id='nuevo'  name='nuevo' class="btn btn-warning navbar-btn" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;">Nuevo</button>
             </p>
           </div>
          <div class="panel-body">
               <div id="list-mark"></div>


          </div>
        </div>
 

     </div>
   </div>
  @include('mark.modal')

<script  type="text/javascript">


    $(document).ready(function(){
        listmark();
    });


    $(document).on("click",".pagination li a",function(e) {
        e.preventDefault();

        var url = $(this).attr("href");

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
                $('#list-mark').empty().html(data);
            }
        });

    });




  $("#nuevo").click(function(event)
  {
      document.location.href = "{{ route('mark.create')}}";
  });

  var listmark = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('listallmark')}}',
          success: function(data){
              $('#list-mark').empty().html(data);
          }
      });
  }

//---------------------
var Mostrar = function(id)
{
  var route = "{{url('mark')}}/"+id+"/edit";
  $.get(route, function(data){
    $("#id").val(data.id);
    $("#name").val(data.name);
  });
}

$("#actualizar").click(function()
{

  var id = $("#id").val();
  var name = $("#name").val();
  var route = "{{url('mark')}}/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {name: name},
    success: function(data){
     
     if (data.success == 'true')
     {
        listmark();
        $("#myModal").modal('toggle');
        $("#message-update").fadeIn();
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
  });
});

//CUANDO CIERRAS LA VENTANA MODAL
$("#myModal").on("hidden.bs.modal", function () {
    $("#message-error").fadeOut()
});

//BOTON ELIMINAR

var Eliminar = function(id,name)
{ 

     // ALERT JQUERY
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<strong><span style='color:#ff0000'>"+name+"</span></strong>").then(function() {
  
      var route = "{{url('mark')}}/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          listmark();
          $("#message-delete").fadeIn();
         // $('#message-delete').toggle(3000);
          $('#message-delete').show().delay(3000).fadeOut(1);
        }
      }
      });
        
  
    });

};






</script>
  
@endsection
