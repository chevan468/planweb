
<div class="panel panel-default">
    <div class="panel-heading">Datos de Usuario</div>
    <div class="panel-body">
        <form class="form-horizontal" id="userDataForm" name="userDataForm" role="form" method="POST" action="{{ url('/login') }}">
            <div class="form-group">
                
                <label for="email" class="col-md-4 control-label">Nombre</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{$users->name}}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="lastName" class="col-md-4 control-label">Apellidos</label>

                <div class="col-md-6">
                    <input id="lastName" type="text" class="form-control" name="lastName" value="{{$users->lastName}}" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="study" class="col-md-4 control-label">Estudio</label>

                <div class="col-md-6">
                    <input id="study" type="text" class="form-control" name="study" value="{{$users->study}}" readonly>
                </div>
            </div>
            
            <div class="form-group">
                <label for="study" class="col-md-4 control-label">Genero</label>
                <div class="col-md-6">
                    @if ($users->gender_id == 1)
    		      	<input id="gender_id" type="text" class="form-control" name="study" value="Masculino" readonly>
					 @else
					 <input id="gender_id" type="text" class="form-control" name="study" value="Femenino" readonly>
					 @endif
                </div>
            </div>

            <div class="form-group">
                <label for="study" class="col-md-4 control-label">Area de Interes</label>

                <div class="col-md-6">
                    <input id="interestArea" type="text" class="form-control" name="interestArea" value="{{$users->interestArea}}" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <a href="#" OnClick='Mostrar({{$users->id}});' data-toggle='modal' data-target='#userEditModal'<i class="fas fa-edit"style="color: #808080;" ></i> Editar</a>
                </div>
                <div class="col-md-2">
                     <a href="#" onclick="Eliminar('{{$users->id}}','{{$users->name}}')" <i class="fas fa-trash-alt"style="color: #e94e38;" ></i></a></td>
                </div>
            </div>

        </form>
    </div>
</div>                    