
    $(document).ready(function(){
        listservice();
    });


    $(document).on("click",".pagination li a",function(e) {
        e.preventDefault();

        var url = "services/listall";

        $.ajax({
            type:'get',
            url:'service',
            success: function(data){
                $('#list-service').empty().html(data);
            }
        });

    });




  $("#nuevo").click(function(event)
  {
      document.location.href = "{{ route('services.create')}}";
  });

  var listservice = function()
  {
      blockPage();
      $.ajax({
          type:'get',
          url:'{{ url('listallservice')}}',
          success: function(data){
              $('#list-service').empty().html(data);
              $.unblockUI();
          }
      });
  }

//---------------------
var Mostrar = function(id)
{
  var route = "{{url('services')}}/"+id+"/edit";
  $.get(route, function(data){
    $("#editServiceform #id").val(data.id);
    $("#editServiceform #name").val(data.name);
    loadcategories();
    loadPricePer();
    $("#serviceEditModal").modal('show');
  });
  
}

function loadcategories() {
    var route = "../categories";
      $("#editServiceform #category").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#editServiceform #category').append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
    }
    
function loadPricePer() {
    var route = "../pricePer";
      $("#editServiceform #pricePer").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#editServiceform #pricePer').append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
    }

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

$("#actualizar").click(function()
{
    blockPage();
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
        $.unblockUI();
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
$("#serviceEditModal").on("hidden.bs.modal", function () {
    $("#message-error").fadeOut()
});

//BOTON ELIMINAR

var Eliminar = function(id,name)
{ 
     // ALERT JQUERY
    $.alertable.confirm("<span style='color:#000'>¿Está seguro de eliminar el registro?</span>"+"<strong><span style='color:#ff0000'>"+name+"</span></strong>").then(function() {
  
      var route = "../services/"+id+"";
      var token = $("#token").val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'DELETE',
        dataType: 'json',
        success: function(data){
        if (data.success == 'true')
        {
          listservice();
          notifySuccess('ELIMINADO CON EXITO');
        }
      }
      });
        
  
    });

};