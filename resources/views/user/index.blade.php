@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')
<br>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            @include('partials.messages')

          <div id="message-update" class="alert alert-success" role="alert" style="display:none">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Actualizado </strong> correctamente.
          </div>
    
    
          <div id="message-delete" class="alert alert-info" role="alert" style="display:none">
              <strong> El registro se elimino correctamente.</strong>
          </div>
            <div id="list-user"></div>


 

     </div>
   </div>
  @include('user.modal')

<script  type="text/javascript">


    $(document).ready(function(){
        listuser();
    });


    $(document).on("click",".pagination li a",function(e) {
        e.preventDefault();

        var url = $(this).attr("href");

        $.ajax({
            type:'get',
            url:url,
            success: function(data){
                $('#list-user').empty().html(data);
            }
        });

    });




  $("#nuevo").click(function(event)
  {
      document.location.href = "{{ route('mark.create')}}";
  });

  var listuser = function()
  {
      $.ajax({
          type:'get',
          url:'{{ url('listalluser')}}',
          success: function(data){
              $('#list-user').empty().html(data);
          }
      });
  }

//---------------------
var Mostrar = function(id)
{
  blockPage();
  var route = "{{url('user')}}/"+id+"/edit";
  $.get(route, function(data){
    $("#id").val(data.id);
    $("#name_Modal").val($("#name").val());
    $("#lastName_Modal").val($("#lastName").val());
    $("#study_Modal").val($("#study").val());
    loadgender();
  });
  $.unblockUI();
}

function loadgender() {
    var route = "../genders";
      $("#userEditForm #gender_id").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#userEditForm #gender_id').append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
    }

$("#actualizar").click(function()
{
  $("#userEditModal").modal('toggle');
  blockPage();
  var id = $("#id").val();
  var name = $("#name_Modal").val();
  var lastName = $("#lastName_Modal").val()
  var study = $("#study_Modal").val();
  var route = "{{url('user')}}/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {name: name, lastName: lastName, study:study},
    success: function(data){
     
     if (data.success == 'true')
     {
        listuser();
        $.unblockUI();

        notifySuccess("ACTUALIZADO CORRECTAMENTE");
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
$("#userEditModal").on("hidden.bs.modal", function () {
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
