@extends('layouts.master')

@section('title','Lista de Marcas')

@section('content')
<br>

   <div class="container">
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

    //carga la lista de servicios al cargar la vista index
    $(document).ready(function(){
        listservice();
    });

    // paginación, actualmente no se encuentra funcionando
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
    
    //carga la lista de servicicos en el div list-service encontrada en el index, se renderiza la vista listall sobre ese div
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
    // carga los select, se debe explicar la ruta de donde los va a obtener y al select que se quieran cargar.
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
    
    // carga los select, pero se define un valor pre seleccionado, se utiliza para casos de actualizar.
    function loadSelectDefault(route,select, preselect) {
    var route = route;
      $(select).empty();
      $.get(route, function(res) {
        if (res.length!=0) {
           $(res).each(function(key, value) {
               if(value.id == preselect){
                   $(select).append($('<option>', {value:value.id, text:value.name}).attr("selected","selected"));
               }else{
                   $(select).append($('<option>', {value:value.id, text:value.name}));
               }
               
          });
        }
      });
    }
    
    
//-------- CREAR UN SERVICIO --------//

$("#nuevo").click(function(event)
  {
      blockPage();
      $.get(this.href, function(response) {
        $('.divForAddService').html(response);
      });
      clearAddForm();
      loadSelect("../categories", "#createServiceform #category" );
      loadSelect("../pricePer", "#createServiceform #pricePer" );
      loadSelect("../provinces", "#createServiceform #province" );
      loadSelect("../districts", "#createServiceform #district" );
      $.unblockUI();
      $("#serviceCreateModal").modal('show');
      
      
  }
  );
  
  $("#Grabar").click(function(event)
    {       blockPage();
            var name = $("#createServiceform #name").val();
            var category = $("#createServiceform #category").val();
            var description = $("#createServiceform #description").val();
            var price = $("#createServiceform #price").val();
            var pricePer = $("#createServiceform #pricePer").val();
            var province = $("#createServiceform #province").val();
            var district = $("#createServiceform #district").val();
            var fullAddress = $("#createServiceform #fullAddress").val();
            var contactNumber = $("#createServiceform #contactNumber").val();
            var contactEmail = $("#createServiceform #contactEmail").val();
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
                if (data.status == 422) {
                   var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, val) {
                        displayFieldError('#createServiceform '+ '#'+key, val);
                    });
                }else{
                    notifySuccess("HA OCURRIDO UN ERROR, POR FAVOR INTENTE DE NUEVO");
                }
                $.unblockUI();
                

            }  
          })
    });
    
    function clearAddForm(){
        $('#createServiceform #name').val('');
        $('#createServiceform #description').val('');
        $('#createServiceform #price').val('');
        $('#createServiceform #fullAddress').val('');
        $('#createServiceform #contactNumber').val('');
        $('#createServiceform #contactEmail').val('');
    }
    
    function createChangeProvince() {
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
//-------- CREAR UN SERVICIO --------//


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
    $("#editServiceform #fulladdress").val(data.fullAddress);
    $("#editServiceform #contactEmail").val(data.contactEmail);
    $("#editServiceform #contactNumber").val(data.contactNumber);
    loadSelectDefault("../categories", "#editServiceform #category",data.category_id); 
    loadSelectDefault("../pricePer", "#editServiceform #pricePer", data.pricePer_id );
    loadSelectDefault("../provinces","#editServiceform #province", data.province_id);
    loadSelectDefault("../districsByProvince/"+data.province_id, "#editServiceform #district",data.district_id );
    $.unblockUI();
    $("#serviceEditModal").modal('show');
  });
}

$("#actualizar").click(function()
{
    blockPage();
    var id = $("#editServiceform #id").val();
    var name = $("#editServiceform #name").val();
    var category = $("#editServiceform #category").val();
    var description = $("#editServiceform #description").val();
    var price = $("#editServiceform #price").val();
    var pricePer = $("#editServiceform #pricePer").val();
    var province = $("#editServiceform #province").val();
    var district = $("#editServiceform #district").val();
    var fullAddress = $("#editServiceform #fulladdress").val();
    var contactNumber = $("#editServiceform #contactNumber").val();
    var contactEmail = $("#editServiceform #contactEmail").val();
    var route = "{{url('services')}}/"+id+"";
    var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'PUT',
    dataType: 'json',
    data: {id:id, name: name, category: category, description:description, price:price,  pricePer:pricePer,
                province:province, district: district, fullAddress:fullAddress, contactNumber:contactNumber,
                contactEmail:contactEmail
            },
    success: function(data){
     
     if (data.success == 'true')
     {
        listservice();
        $("#serviceEditModal").modal('toggle');
        $.unblockUI();
        notifySuccess("SERVICIO ACTUALIZADO CORRECTAMENTE");
       }
    },
    error:function(data)
    {
        if (data.status == 422) {
           var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, val) {
                displayFieldError('#editServiceform '+ '#'+key, val);
                
            });
        }else{
            notifySuccess("HA OCURRIDO UN ERROR, POR FAVOR INTENTE DE NUEVO");
        }
        $.unblockUI();
        
    }  
  });
});

function editChangeProvince() {
        var route = "../districsByProvince/" + $("#editServiceform #province").val();
          $("#editServiceform #district").empty();
          
          $.get(route, function(res) {
            if (res.length!=0) {
               $(res).each(function(key, value) {
                   $('#editServiceform #district').append($('<option>', {value:value.id, text:value.name}));
              });
            }
          });
}


//-------- ACTUALIZAR UN SERVICIO --------//  

//-------- ELIMINAR UN SERVICIO --------//  
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
//-------- ELIMINAR UN SERVICIO --------// 







//CUANDO CIERRAS LA VENTANA MODAL
$("#serviceEditModal").on("hidden.bs.modal", function () {
    $("#message-error").fadeOut()
});

//BOTON ELIMINAR



</script>
  
@endsection
