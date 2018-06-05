@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')
<br>

   <div class="row">
     <div class="col-md-8 col-md-offset-2">

       @include('partials.messages')

      <div class="panel panel-default">
          <div class="panel-heading">
             Servicios
             <p class="navbar-text navbar-right" style=" margin-top: 1px;">
                <button type="button" id='nuevo'  name='nuevo' onClick="" class="btn btn-warning navbar-btn" style="margin-bottom: 1px; margin-top: -5px;margin-right: 8px;padding: 3px 20px;" data-toggle='modal' data-target='#serviceNewModal'>Nuevo</button>
             </p>
           </div>
          <div class="panel-body">
               <div id="list-service"></div>


          </div>
        </div>
 

     </div>
   </div>
  @include('service.editModal')
  @include('service.createModal')
  {!!Html::script('assets/js/notify.min.js')!!}

<script  type="text/javascript">


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
    
    function loadSelect(route,select) {
    var route = route;
      $(select).empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $(select).append($('<option>', {value:value.id, text:value.name}));
          });
        }
      });
    }
    
    
//-------- CREAR UN SERVICIO --------//

$("#nuevo").click(function(event)
  {
      blockPage();
      loadSelect("../categories", "#createServiceform #category" );
      loadSelect("../pricePer", "#createServiceform #pricePer" );
      loadSelect("../provinces", "#createServiceform #province" );
      loadSelect("../districts", "#createServiceform #district" );
      $("#serviceCreateModal").modal('show');
      $.unblockUI();
      
  }
  );
  
  $("#Grabar").click(function(event)
    {       blockPage();
            var name = $("#createServiceform #name").val();
            var category = $("#createServiceform #category").val();
            var description = $("#description").val();
            var price = $("#price").val();
            var pricePer = $("#createServiceform #pricePer").val();
            var province = $("#createServiceform #province").val();
            var district = $("#createServiceform #district").val();
            var fullAddress = $("#fullAddress").val();
            var contactNumber = $("#contactNumber").val();
            var contactEmail = $("#contactEmail").val();
            var token = $("input[name=_token]").val();
            var route = "{{route('services.store')}}";
      
          $.ajax({
            url:route,
            headers:{'X-CSRF-TOKEN':token},
            type:'post',
            ddataType: 'json',
            data: {name: name, category: category, description:description, price:price,  pricePer:pricePer,
                province:province, district: district, fullAddress:fullAddress, contactNumber:contactNumber,
                contactEmail:contactEmail
            },
            success:function(data)
            {
                if(data.success == 'true')
                {   clearAddForm();
                    $("#serviceCreateModal").modal('toggle');
                    listservice();
                    $.unblockUI();
                    notifySuccess("SERVICIO AGREGADO CORRECTAMENTE");
                }
            },
            error:function(data)
            {
                
                $("#error").html(data.responseJSON.name);
                $("#message-error").fadeIn();
                if (data.status == 422) {
                   console.clear();
                }
                $.unblockUI();
                notifySuccess("HA OCURRIDO UN ERROR, POR FAVOR INTENTE DE NUEVO");

            }  
          })
    });
    
    function clearAddForm(){
        $('#createServiceform #name').val('');
        $('#createServiceform #description').val('');
        $('#createServiceform #pricePer').val('');
        $('#createServiceform #fullAddress').val('');
        $('#createServiceform #contactNumber').val('');
        $('#createServiceform #contactEmail').val('');
        
    }
//-------- CREAR UN SERVICIO --------//


//-------- ACTUALIZAR UN SERVICIO --------//  



//-------- ACTUALIZAR UN SERVICIO --------//  

var Mostrar = function(id)
{
    blockPage();
    var route = "{{url('services')}}/"+id+"/edit";
  $.get(route, function(data){
    $("#editServiceform #id").val(data.id);
    $("#editServiceform #name").val(data.name);
    $("#editServiceform #description").val(data.description);
    $("#editServiceform #price").val(data.price);
    loadSelect("../categories", "#editServiceform #category" );
    loadSelect("../pricePer", "#editServiceform #pricePer" );
    loadSelect("../provinces", "#editServiceform #province" );
    loadSelect("../districts", "#editServiceform #district" );
    $.unblockUI();
    $("#serviceEditModal").modal('show');
  });
  
}


//---------------------


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
function loadProvinces() {
    var route = "../provinces";
      $("#editServiceform #province").empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#editServiceform #province').append($('<option>', {value:value.id, text:value.name}));
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
    var route = "../districsByProvince/" + $("#createServiceform #province").val();
      $("#createServiceform #district").empty();
      
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               $('#createServiceform #district').append($('<option>', {value:value.id, text:value.name}));
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

</script>
  
@endsection
