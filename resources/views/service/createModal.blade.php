{{-- VENTANA MODAL --}}
  <div class="modal fade" id="serviceCreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Servicio</h4>
      </div>
      <div class="modal-body">

    <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
      <strong id="error"></strong>
    </div>

       {!! Form::open(['id'=>'createServiceform', 'class' =>'createServiceform']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
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
                          {!!form::select('category',[],null,['id'=>'category','class'=>'form-control'])!!}
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
                          {!!form::select('pricePer',[],null,['id'=>'pricePer','class'=>'form-control'])!!}
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-3">
                        <div class="form-group">
                          {!!form::label('Provincia')!!}
                          {!!form::select('province',[],null,['id'=>'province', 'name'=>'province', 'onchange'=>'changeProvince()','class'=>'form-control'])!!}
                         </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                          {!!form::label('Cantón')!!}
                          {!!form::select('district',[],null,['id'=>'district','name'=>'district' ,'class'=>'form-control'])!!}
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
      </div>
      <div class="modal-footer">
      {!!link_to('#', 'Guardar', ['id'=>'Grabar','class'=>'btn btn-warning btn-sm m-t-10'])!!}
      </div>
      {!!Form::close()!!}
    </div>
  </div>
</div>
