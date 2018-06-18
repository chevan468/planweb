{{-- VENTANA MODAL --}}
  <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="userEditModalLabel">Actualizar</h4>
      </div>
      <div class="modal-body">

    <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
      <strong id="error"></strong>
    </div>

       {!! Form::open(['id'=>'userEditForm']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        <div class="row">
			        <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                  {!!form::label('Nombre *')!!}
                  {!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Nombre'])!!}
                         </div>
			        </div>
			        <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                {!!form::label('Apellidos *')!!}
                {!!form::text('lastName',null,['id'=>'lastName','class'=>'form-control','placeholder'=>'Apellidos'])!!}
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-6 col-xs-12">
			            <div class="form-group">
                           {!!form::label('Nivel Académico')!!}
          {!!form::text('study',null,['id'=>'study','class'=>'form-control','placeholder'=>'Estudio'])!!}
                         </div>
			        </div>
			        <div class="col-md-6 col-xs-12">
            <div class="form-group">
            {!!form::label('Género')!!}
            {!!form::select('gender_id',[],null,['id'=>'gender_id','class'=>'form-control'])!!}
                         </div>
                    </div>
			    </div>
			    <div class="row">
			        <div class="col-md-12 col-xs-12">
            <div class="form-group">
            {!!form::label('Areas de Interés')!!}
          {!!form::text('interestArea',null,['id'=>'interestArea','class'=>'form-control','placeholder'=>'Interés'])!!}
                         </div>
                    </div>
			    </div>
          <div class="col-md-6 col-xs-12">
                          <font size='1'>Campo Obligatorio (*)</font>
			    </div>
      {!!Form::close()!!}
      </div>
      <div class="modal-footer">
      {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizarUser', 'class'=>'btn btn-primary'])!!}
      </div>
    </div>
  </div>
</div>
