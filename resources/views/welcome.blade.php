@extends('layouts.master')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
                $count=0;
            ?>
            @for ($i = 0; $i < 10; $i++)
                @if($count==0)
                    <div class="row">
                @endif
                <div class="col-md-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Título del panel con estilo h3</h3>
                      </div>
                      <div class="panel-body">
                        Contenido del panel
                      </div>
                    </div>
                </div>
  
                 <?php
                    $count=$count+1;
                ?>
                
                @if($count==2)
                   </div>
                   <div class="clearfix"></div>
                   <br>
                  <?php
                    $count=0;
                    ?>
                @endif
               
			@endfor

    </div>
</div>
</div>

@endsection