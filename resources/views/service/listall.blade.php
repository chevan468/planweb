<table class="table table-bordered">
    <thead>
    <th>Nombre</th>
    <th>Acción</th>
    </thead>
    <tbody>
    @foreach($services as $service)
            {{--*/ @$name = str_replace(' ','&nbsp;', $service->name) /*--}}        
        <tr>
            <td>{{$service->name}}</td>
            <td>
                <a href="#" OnClick='Mostrar({{$service->id}});' data-toggle='modal' data-target='#myModal'<i class="fas fa-edit"style="color: #808080;" ></i></a>
                <a href="#" onclick="Eliminar('{{$service->id}}','{{$name}}')" <i class="fas fa-trash-alt"style="color: #e94e38;" ></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="text-center">
</div>