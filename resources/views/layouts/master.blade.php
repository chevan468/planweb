<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PlanWeb</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--- Master original-->
    {!!Html::style('css/bootstrap.min.css')!!}
    <!--{!!Html::style('css/navbar-fixed-top.css')!!}-->
    
    <!--- Template Buhó-->
    {!!Html::style('assets/css/bootstrap.css')!!}
    {!!Html::style('assets/css/style.css')!!}
    {!!Html::style('assets/css/animate.css')!!}
    
    <!--- Template Buhó-->
    {!!Html::script('assets/js/jquery-1.11.1.min.js')!!}
    {!!Html::script('assets/js/jquery.blockUI.js')!!}
    {!!Html::script('assets/js/notify.min.js')!!}
    {!!Html::script('assets/js/login.js')!!} 
    {!!Html::script('assets/js/jquery.easydropdown.js')!!}
    {!!Html::script('assets/js/wow.min.js')!!}
    {!!Html::script('assets/js/classie.js')!!}
    {!!Html::script('assets/js/admin.js')!!}
    
        <!--- Master original-->
    {!!Html::style('js/jquery-alertable-master/jquery.alertable.css')!!}
    {!!Html::script('js/jquery-alertable-master/jquery.alertable.js')!!}
    {!!Html::script('js/bootstrap.min.js')!!}
  
  </head>
  <body>
     <!-- Header -->
     <div class="header">
		   <div class="col-sm-8 header-left">
					 <div class="logo">
						<a href="/"><img src="../assets/images/logo3.png" alt=""/></a>
					 </div>
					 <div class="menu">
						  <a class="toggleMenu" href="#"><img src="../assets/images/nav.png" alt="Planweb" /></a>
						    <ul class="nav" id="nav">
						    		@if (Auth::guest())
						    		<li><a href="/">Inicio</a></li>
							    	<li><a href="entertain.html">Nosotros</a></li>
							    	<li><a href="404.html">Contacto</a></li>
				    		      	
									 @else
									 <li><a href="/">Inicio</a></li>
				    		      	<li><a href="../services">Servicios</a></li>
							    	<li><a href="education.html">Notificaciones</a></li>
							    	<li><a href="entertain.html">Nosotros</a></li>
							    	<li><a href="404.html">Contacto</a></li>
									
									 @endif
						    	
								<div class="clearfix"></div>
							</ul>
							<script type="text/javascript" src="../assets/js/responsive-nav.js"></script>
				    </div>	
				     <!-- start search-->
				  <!--    <div class="search-box">-->
						<!--	<div id="sb-search" class="sb-search">-->
						<!--		<form>-->
						<!--			<input class="sb-search-input" placeholder="Enter your search term..." type="search" name="search" id="search">-->
						<!--			<input class="sb-search-submit" type="submit" value="">-->
						<!--			<span class="sb-icon-search"> </span>-->
						<!--		</form>-->
						<!--	</div>-->
						<!--</div>-->

	    		    <div class="clearfix"></div>
	    	    </div>
            <div class="col-xs-auto col-sm-4  header_right">
	    		      <div id="loginContainer">
	    		      	@if (Auth::guest())
	    		      	<a href="{{ url('/login') }}"><i class="fas fa-user"style="color: white;" ></i><span>Ingresar</span></a>
	    		      	
	    		      	<a href="{{ url('/register') }}"><i class="fas fa-user-plus" style="color: white;"></i><span>Registrarse</span></a>
						 @else
						 <a href="../user"><i class="fas fa-user" style="color: white;"></i><span>{{ Auth::user()->name }}</span></a>
						 <a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt" style="color: white;"></i><span>Salir</span></a>
						 @endif
			             </div>
		                 <div class="clearfix"></div>
	                 </div>
	                <div class="clearfix"></div>
	                <div class="clearfix"></div>
   </div>


 <div id="page-wrapper">
         
         <div id="div-forcontent">
            @yield('content')
            <div id="div-forlist"></div>
         </div>
 </div>

    <!-- Footer -->
    
    <div class="footer">
   	<div class="container">
   	 <div class="footer_top">
   	 	<h3>Plataforma de Servicios Profesionales.</h3>

	  </div>
	  <div class="footer_grids">
	     <div class="footer-grid">
			<h4> Creadores</h4>
			<ul class="list1">
				<li><a >Esteban Bogantes Hidalgo.</a></li>
				<li><a >Juan Diego Sibaja Navarro.</a></li>
				<li><a >Mario Alvarado Angulo.</a></li>
				<li><a >Royers Murillo Castro.</a></li>
			</ul>
		  </div>
		  <div class="footer-grid">
			<h4>Siguenos en </h4>
			<ul class="footer_social wow fadeInLeft" data-wow-delay="0.4s">
			  <li><a href=""> <i class="fb"> </i> </a></li>
			  <li><a href=""><i class="tw"> </i> </a></li>
			  <li><a href=""><i class="google"> </i> </a></li>
			  <li><a href=""><i class="u_tube"> </i> </a></li>
		 	</ul>
		  </div>
		  <div class="footer-grid last_grid">
			<h4>Derechos </h4>
		 	<div class="copy wow fadeInRight" data-wow-delay="0.4s">
              <p>© 2018 PlanWeb. Plantilla <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
	        </div>
		  </div>
		  <div class="clearfix"> </div>
	   </div>
      </div>
   </div>
    </body>
</html>
