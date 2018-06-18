@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')
<br>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
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
    loadgender(data.gender_id);
    $("#id").val(data.id);
    $("#userEditForm #name").val(data.name);
    $("#userEditForm #lastName").val(data.lastName);
    $("#userEditForm #study").val(data.study);
    $("#userEditForm #interestArea").val(data.interestArea);
    
  });
  $.unblockUI();
}

function loadgender(preselect) {
    var route = "../genders";
      $("#userEditForm #gender_id").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               if(value.id == preselect){
                   $('#userEditForm #gender_id').append($('<option>', {value:value.id, text:value.name}).attr("selected","selected") );
               }else{
                   $('#userEditForm #gender_id').append($('<option>', {value:value.id, text:value.name}));
               }
          });
        }
      });
    }

$("#actualizarUser").click(function()
{
  
  blockPage();
  var id = $("#id").val();
  var name = $("#userEditForm #name").val();
  var lastName = $("#userEditForm #lastName").val()
  var study = $("#userEditForm #study").val();
  var gender_id = $("#userEditForm #gender_id").val();
  var interestArea = $("#userEditForm #interestArea").val();
  var route = "{{url('user')}}/"+id+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {name: name, lastName: lastName, study:study, gender_id:gender_id, interestArea:interestArea, },
    success: function(data){
     
     if (data.success == 'true')
     {
        $("#userEditModal").modal('toggle');
        listuser();
        $.unblockUI();

        notifySuccess("ACTUALIZADO CORRECTAMENTE");
       }
    },
    error:function(data)
    {
        if (data.status == 422) {
           var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, val) {
                displayFieldError('#userEditForm '+ '#'+key, val);
            });
        }else{
            $("#userEditModal").modal('toggle');
            notifySuccess("HA OCURRIDO UN ERROR, POR FAVOR INTENTE DE NUEVO");
        }
        $.unblockUI();
    }  
  });
});

var Eliminar = function(id,name)
{ 
     // ALERT JQUERY
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar su perfil?\n</span>"+"<strong><span style='color:#ff0000'> Este es un proceso irreversible</span></strong>").then(function() {
  
      var route = "../user/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          notifySuccess('ELIMINADO CON EXITO');
          window.location.href = "home";
        }
      }
      });
        
  
    });

};

</script>
  
@endsection
