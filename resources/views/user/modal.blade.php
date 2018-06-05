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
        {{-- @include('genero.form.genero') --}}
        <div class="form-group">
         {!!form::label('Nombre')!!}
          {!!form::text('name',null,['id'=>'name_Modal','class'=>'form-control','placeholder'=>'Nombre'])!!}
        </div>
        <div class="form-group">
         {!!form::label('Apellido')!!}
          {!!form::text('lastName',null,['id'=>'lastName_Modal','class'=>'form-control','placeholder'=>'Apellidos'])!!}
        </div>
        <div class="form-group">
         {!!form::label('Nivel Académico')!!}
          {!!form::text('study',null,['id'=>'study_Modal','class'=>'form-control','placeholder'=>'Estudio'])!!}
        </div>
        <div class="form-group">
         {!!form::label('Nivel Académico')!!}
         {!!form::select('gender_id',[],null,['id'=>'gender_id','class'=>'form-control'])!!}
        </div>
        
      {!!Form::close()!!}
      </div>
      <div class="modal-footer">
      {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'])!!}
      </div>
    </div>
  </div>
</div>
