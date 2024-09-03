<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - {{env('APP_NAME')}}</title>
    {{-- HOJAS DE ESTILO --}}
    <link rel="shortcut icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/int.styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('css/datatables.min.css')}}">
	{{-- <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap-multiselect.min.css')}}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{url('css/select2.min.css')}}"> --}}

    {{--   JS PARA TODO EL PROYECTO   --}}
    <script src="{{url('js/jquery36.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/datatables.min.js')}}"></script>
    {{-- <script src="{{url('js/bootstrap-multiselect.min.js')}}"></script> --}}
    {{-- <script src="{{url('js/select2.min.js')}}"></script> --}}
    <script src="{{url('js/chart.min.js')}}"></script>

</head>
<body>

    {{-- CONTENEDOR PRINCIPAL (INICIO) --}}
    <div class="row page-content">
        {{-- MENU CONTEXTUAL --}}
        <div class="col-md-2 nav-contextual-container">
            <div class="nav-contextual">
                    <img style="width:100%;" src="{{ asset('img/logo_pp.png')}}" alt="..." class="">
                    <br><br>
                    {{-- <h5 class="text-center text-white" style="text-transform: uppercase; border-bottom:1px solid #555;">
                        <small>&laquo; MI CUENTA &raquo;</small>
                    </h5> --}}
                    <div class="text-white text-center box-cuenta">
                            @if (Auth::user()->funcionario == null)
                            <small>{{Auth::user()->usu_nombre}}</small>
                            @else
                            <small>{{Auth::user()->funcionario->grado->gra_abreviacion}} {{Auth::user()->funcionario->persona->per_nombres}} {{Auth::user()->funcionario->persona->per_primer_apellido}}</small>
                            @endif
                            <br>
                            <small class="text-uppercase text-info" style="font-size:0.6em;">
                                Rol: {{Auth::user()->rol->rol_nombre}}<br>
                                <a class="btn btn-sm btn-light"  data-toggle="modal" data-target="#modal-cuenta" href="#">
                                    <i class="fa fa-cog"></i> Mi cuenta
                                </a>
                                <br>
                            </small>
                        </div>
                    <h5 class="text-center text-white" style="text-transform: uppercase; border-bottom:1px solid #555;">
                        <small>&laquo; MENÚ &raquo;</small>
                    </h5>
                    <nav class="nav nav-pills" aria-orientation="vertical">
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'dashboard'): active @endif" href="{{url('dashboard')}}"><i class="fa fa-home"></i> INICIO</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 2 || Auth::user()->rol->rol_codigo == 3 || Auth::user()->rol->rol_codigo == 4)
                        <a class="nav-item nav-link @if($modulo_activo == 'monitoreo'): active @endif" href="{{url('monitoreo')}}"><i class="fa fa-eye"></i> MONITOREO</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'seguimientos'): active @endif" href="{{url('seguimientos')}}"><i class="fa fa-line-chart"></i> SEGUIMIENTO</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'ordenes'): active @endif" href="{{url('ordenes')}}"><i class="fa fa-wrench"></i> ORDENES</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'inspecciones'): active @endif" href="{{url('inspecciones')}}"><i class="fa fa-check"></i> INSPECCIONES</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'tarjetas'): active @endif" href="{{url('tarjetas')}}"><i class="fa fa-tags"></i> TARJETAS</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1 || Auth::user()->rol->rol_codigo == 3)
                        <a class="nav-item nav-link @if($modulo_activo == 'personal'): active @endif" href="{{url('personal')}}"><i class="fa fa-id-card"></i> PERSONAL</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1)
                        <a class="nav-item nav-link @if($modulo_activo == 'unidades'): active @endif" href="{{url('unidades')}}"><i class="fa fa-th"></i> SECCIONES</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1)
                        <a class="nav-item nav-link @if($modulo_activo == 'cargos'): active @endif" href="{{url('cargos')}}"><i class="fa fa-suitcase"></i> CARGOS</a>
                        @endif
                        @if (Auth::user()->rol->rol_codigo == 1)
                        <a class="nav-item nav-link @if($modulo_activo == 'usuarios'): active @endif" href="{{url('usuarios')}}"><i class="fa fa-users"></i> USUARIOS</a>
                        @endif

                    </nav>
                    
                <div class="box-copyright">
                    &copy; {{date('Y')}} {{env('APP_NAME')}}
                </div>
    
            </div>
        </div>
        {{-- MENU CONTEXTUAL (FIN) --}}

        {{-- CONTENIDO VARIABLE (INICIO) --}}
        @yield('contenido')        
        {{-- CONTENIDO VARIABLE (FIN)--}}
    </div>
    
    {{-- CONTENEDOR PRINCIPAL (FIN) --}}


{{-- INICIO MODAL: CUENTA_USUARIO --}}
<div class="modal fade" id="modal-cuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#eee;">
          <h5 class="modal-title text-primary">
              <i class="fa fa-user"></i>
              Opciones de la cuenta de usuario
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="box-data-xtra">
                <div class="row">
                    <div class="col-md-6 text-info text-right">
                        USUARIO:
                    </div>
                    <div class="col-md-6">
                        {{Auth::user()->usu_nombre}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-info text-right">
                        ROL:
                    </div>
                    <div class="col-md-6">
                        {{Auth::user()->rol->rol_nombre}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-info text-right">
                        ULT. ACTUALIZACION:
                    </div>
                    <div class="col-md-6">
                        {{Auth::user()->updated_at}}
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <a id="btn-update-password" class="btn btn-info btn-block" href="#">
                        <i class="fa fa-refresh"></i>
                        Actualizar contraseña
                    </a>
                    <a id="btn-logout" class="btn btn-danger btn-block" href="{{url('logout')}}">
                        <i class="fa fa-lock"></i> 
                        Cerrar sesión
                    </a>                            

                    <form id="form-update-password" action="#" method="POST">
                        @csrf
                        <a id="btn-back-update-password" class="btn btn-sm btn-secondary" style="float:right;" href="#">Atrás</a>
                        <h5 class="text-info">ACTUALIZAR CONTRASEÑA</h5>
                        <small>
                            Los campos marcados con <span class="text-danger">*</span> son obligatorios
                        </small>
						<div class="form-group">
							<label class="label-blue label-block" for="">
								Contraseña actual:
								<span class="text-danger">*</span>
								<i class="fa fa-question-circle float-right" title="Establecer la contraseña actual"></i>
							</label>
							<input required type="password" value="" class="form-control txt_pwd @error('pwd_actual') is-invalid @enderror" name="pwd_actual" id="pwd_actual" placeholder="Contraseña actual">
                            <input type="checkbox" onclick="ver_password('pwd_actual')"><small>Ver ésta contraseña</small>
                        </div>
						<div class="form-group">
							<label class="label-blue label-block" for="">
								Contraseña nueva:
								<span class="text-danger">*</span>
								<i class="fa fa-question-circle float-right" title="Establecer la contraseña nueva"></i>
							</label>
							<input required type="password" value="" class="form-control passwordInput txt_pwd @error('pwd_nueva') is-invalid @enderror" name="pwd_nueva" id="pwd_nueva" placeholder="Contraseña nueva">
                            <input type="checkbox" onclick="ver_password('pwd_nueva')"><small>Ver ésta contraseña</small>
                        </div>
                        <div id="msg-ok-update-password" class="alert alert-success">Contraseña actualizada correctamente.</div>
                        <div id="msg-error-update-password" class="alert alert-danger">La contraseña actual no coincide. Intente nuevamente.</div>
                        <div>
                            <div class="request-loader" style="display:inline; float:left;">
                                <img style="height:50px;" src="{{ asset('img/loader.gif')}}" alt="..." class="">
                                Procesando...
                            </div>
                            <button type="button" id="btn-send-password" class="btn btn-info" style="float:right;">
                                <i class="fa fa-save"></i>
                                Guardar datos
                            </button>
        
                        </div>
                    </form>    


                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  {{-- FIN MODAL: CUENTA USUARIO --}}


    <script>
        function ver_password(id_field) {
            var x = $("#"+id_field);
            if (x.attr('type') === "password") {
                x.attr('type','text');
            } else {
                x.attr('type','password');
            }
        }
        $(function(){
			/*
            -----------------------------------------------------------------------
			FUNCIONES / EVENTOS GENERICOS PARA TODA LA APP
            -----------------------------------------------------------------------
            */
            //PRELOADER
            // $('.preloader').fadeOut('fast');
            //TOOLTIPS
            // $('[title]').tooltip();
            //HTML SELECT MULTIPLE PLUGIN
            // $('.select-multi').multiselect({nonSelectedText:"Seleccione una o más opciones"});

			//CONVERTIR TODOS LOS INPUT TEXT A MAYUSCULAS
			$("input[type=text]:not(input.txt_pwd, input.txt_email), textarea").keyup(function () {
				// if($(this).attr('data-tipo') != 'email' || $(this).attr('data-tipo') != 'pwd'){
    			  var start = this.selectionStart;
				  var end = this.selectionEnd;
				  this.value = this.value.toUpperCase();
				  this.setSelectionRange(start, end);
					// $(this).val($(this).val().toUpperCase());
				// }
			});
            //ALERTAS NO PERSISTENTES
            setTimeout(function(){$('.alert-not-persistent').slideUp(2000);}, 10000);

            $('#form-update-password').hide();            
            $('#btn-update-password').click(function(){
                $('#btn-update-password').slideUp();            
                $('#btn-logout').slideUp();            
                $('#form-update-password').slideDown();            
            });
            
            $('#btn-back-update-password').click(function(){
                $('#form-update-password').slideUp();            
                $('#btn-update-password').slideDown();            
                $('#btn-logout').slideDown();            
            });

            $('#msg-ok-update-password').hide();
            $('#msg-error-update-password').hide();
            $('.request-loader').hide();

			//GUARDAR ORDEN DE TRABAJO
			$("#btn-send-password").click(function(e){
                console.log("Entrando");
				if($("#form-update-password")[0].checkValidity()) {
                    console.log("validando");
					e.preventDefault();
					$(this).attr('disabled','true');
                    var btn_update = $(this);
					var csrfName = '_token'; // Value specified in $config['csrf_token_name']
					var csrfHash = $("input[name='_token']").val(); // CSRF hash
					var pwd_actual = $('#pwd_actual').val();
					var pwd_nuevo = $('#pwd_nueva').val();
					var route = '{{url("usuarios/update_password/".Crypt::encryptString(Auth::user()->usu_id))}}';
          			$.ajax({
  						type: "PUT",
  						url: route,
	 		            data: {
							pwd_actual: pwd_actual,
							pwd_nuevo: pwd_nuevo,
							[csrfName]: csrfHash
						},
  					  dataType: 'json',
  						beforeSend: function(){
    						$('.request-loader').show();
  						},
  						success: function(data){
  							if(data.status == 1){
									$('#msg-ok-update-password').slideDown(1000);
									setTimeout(function(){ window.location.reload(); }, 2500);
  							}else{
                                    $('.request-loader').hide();
                                    $('#msg-error-update-password').slideDown(1000);
									setTimeout(function(){$('#msg-error-update-password').slideUp(1000);}, 5000);
                                    btn_update.attr('disabled',false);
  							}
  						},
  						error: function(data){
                            $('.request-loader').hide();
                            $('#msg-error-update-password').slideDown(1000);
    						setTimeout(function(){$('#msg-error-update-password').slideUp(1000);}, 5000);
                            btn_update.attr('disabled',false);
  						}
  				});
        }
			});
            


        });
        </script>
        
</body>
</html>