<table class="table table-bordered">
    <thead>
    <th>Nombre</th>
    <th>Acción</th>
    </thead>
    <tbody>
    @foreach($marks as $mark)
            {{--*/ @$name = str_replace(' ','&nbsp;', $mark->name) /*--}}        
        <tr>
            <td>{{$mark->name}}</td>
            <td>
                <a href="#" OnClick='Mostrar({{$mark->id}});' data-toggle='modal' data-target='#myModal'<i class="fas fa-edit"style="color: #808080;" ></i></a>
                <a href="#" onclick="Eliminar('{{$mark->id}}','{{$name}}')" <i class="fas fa-trash-alt"style="color: #e94e38;" ></i></a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="text-center">
    {!!$marks->links()!!}
</div>