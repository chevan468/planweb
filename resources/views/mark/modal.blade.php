{{-- VENTANA MODAL --}}
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Marca</h4>
      </div>
      <div class="modal-body">

    <div id='message-error' class="alert alert-danger danger" role='alert' style="display: none">
      <strong id="error"></strong>
    </div>

       {!! Form::open(['id'=>'form']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" id="id">
        {{-- @include('genero.form.genero') --}}
          {!!form::label('Nombre')!!}
          {!!form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'Digite Marca'])!!}
      {!!Form::close()!!}
      </div>
      <div class="modal-footer">
      {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'])!!}
      </div>
    </div>
  </div>
</div>
