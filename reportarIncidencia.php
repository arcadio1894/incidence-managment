
<?php 
	session_start();
	if(isset($_SESSION['type'])) 
	{

		@mysql_query ("SET NAMES 'utf8'");

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Panel Admin - I-M Admin</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<style type="text/css" media="screen">
			.clickable{
			    cursor: pointer;
			}

			.clickable .glyphicon{
			    background: rgba(0, 0, 0, 0.15);
			    display: inline-block;
			    padding: 6px 12px;
			    border-radius: 4px
			}

			.panel-heading span{
			    margin-top: -23px;
			    font-size: 15px;
			    margin-right: -9px;
			}

			a.clickable { color: inherit; }
			a.clickable:hover { text-decoration:none; }
		</style>

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							I-M Admin
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						

						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php 
										echo $_SESSION['usuario'];
									?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="php/login/logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="">
						<a href="panelAdmin.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php if ($_SESSION['type'] == "Admin") {
					 
					?>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-folder"></i>
							<span class="menu-text">
								Proyectos
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">

							<li class="">
								<a href="listarProyectos.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar proyectos
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="crearProyectos.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear proyectos
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> Usuarios </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="listarUsuarios.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar usuarios
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="crearUsuarios.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear usuarios
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-lock"></i>
							<span class="menu-text"> Perfiles </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="listarPerfiles.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar perfiles
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="crearPerfiles.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Crear perfiles
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon glyphicon glyphicon-list"></i>
							<span class="menu-text"> Categorias </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="listarCategorias.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar categorias
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>

					<li class="">
						<a href="" class="dropdown-toggle">
							<i class="menu-icon glyphicon glyphicon-signal"></i>
							<span class="menu-text"> Niveles </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="listarNiveles.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Listar niveles
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="crearNiveles.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Gestionar niveles
								</a>

								<b class="arrow"></b>
							</li>

						</ul>
					</li>
					<li class="">
						<a href="observarIncidencia.php">
							<i class="menu-icon glyphicon glyphicon-tags"></i>
							<span class="menu-text"> Seguir incidencias</span>
						</a>

						<b class="arrow"></b>
					</li>
					<?php } ?>

					<li class="">
						<a href="verIncidencia.php">
							<i class="menu-icon glyphicon glyphicon-tags"></i>
							<span class="menu-text"> Ver incidencias </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="active">
						<a href="reportarIncidencia.php">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Reportar Incidencia
							</span>
						</a>

						<b class="arrow"></b>
					</li>

				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
								<div class="page-header">
									<h1>
										Reportar incidencia
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											Reportando una incidencia
										</small>
									</h1>
								</div>

								<div class="space-6"></div>

								<form class="form-horizontal" role="form" id="register-incidence">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre de proyecto </label>

										<div class="col-sm-4">
											<select class="form-control" id="cboproyectos" name="proyectos" >
												<?php 
													$con = @mysql_connect('localhost','root','')or die ('Ha fallado la conexión: '.@mysql_error());
			    									@mysql_select_db('bd_incidence')or die ('Error al seleccionar la Base de Datos: '.@mysql_error());
			    									$res=@mysql_query("SELECT *
															FROM proyecto p
															where p.enable='1'") or die("Problemas en el select:".@mysql_error());
													while($row = @mysql_fetch_array($res))
													{
												?>
													<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
												<?php 
													}

												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre de la categoría </label>

										<div class="col-sm-4">
											<select class="form-control" id="cboCategorias" name="categorias">
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Reproductibilidad </label>

										<div class="col-sm-4">
											<select class="form-control" id="reproductibilidad" name="reproductibilidad">
												<option value="Siempre">Siempre</option>
												<option value="A veces" selected="selected">A veces</option>
												<option value="Aleatorio">Aleatorio</option>
												<option value="No se ha intentado">No se ha intentado</option>
												<option value="No reproducible">No reproducible</option>
												<option value="Desconocido">Desconocido</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Severidad </label>

										<div class="col-sm-4">
											<select class="form-control" id="severidad" name="severidad">
												<option value="Funcionalidad">Funcionalidad</option>
												<option value="Trivial">Trivial</option>
												<option value="Ajuste">Ajuste</option>
												<option value="Fallo">Fallo</option>
												<option value="Bloqueo">Bloqueo</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Prioridad </label>

										<div class="col-sm-4">
											<select class="form-control" id="prioridad" name="prioridad">
												<option value="Ninguna">Ninguna</option>
												<option value="Baja">Baja</option>
												<option value="Normal" selected="selected">Normal</option>
												<option value="Alta">Alta</option>
												<option value="Alta">Urgente</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Resumen </label>

										<div class="col-sm-4">
											<input type="text" id="resumen" name="resumen" placeholder="Resumen breve" class="form-control" required/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Descripción </label>

										<div class="col-sm-4">
											<textarea id="descripcion" name="descripcion" class="autosize-transition form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 92px; margin-left: 0px; margin-right: -0.015625px;" required></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Información adicional </label>

										<div class="col-sm-4">
											<textarea id="info" name="info" class="autosize-transition form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 92px; margin-left: 0px; margin-right: -0.015625px;"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pasos para reproducir </label>

										<div class="col-sm-4">
											<textarea id="pasos" name="pasos" class="autosize-transition form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 92px; margin-left: 0px; margin-right: -0.015625px;" required></textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Visibilidad </label>

										<div class="col-sm-4">
											<select class="form-control" id="visibilidad" name="visibilidad">
												<option value="Privado">Privado</option>
												<option value="Público">Público</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-2">
											<div class="panel panel-primary">
								                <div class="panel-heading">
								                    <h3 class="panel-title">
								                        Opcionales</h3>
								                    <span class="pull-right clickable"><i class="glyphicon glyphicon-minus"></i></span>
								                </div>
								                <div class="panel-body">
								                    <div class="form-group">
														<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Plataforma </label>

														<div class="col-md-8">
															<input type="text" id="plataforma" name="plataforma" placeholder="Plataforma" class="form-control" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Sistema Operativo </label>

														<div class="col-md-8">
															<input type="text" id="so" name="so" placeholder="Sistema Operativo" class="form-control" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label no-padding-right" for="form-field-1"> Version de S.O </label>

														<div class="col-md-8">
															<input type="text" id="version" name="version" placeholder="Version de SO" class="form-control" />
														</div>
													</div>
								                </div>
								            </div>
								        </div>
										
									</div>


									

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Reportar incidencia
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Borrar
											</button>
										</div>
									</div>

								</form>








								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Incidence Managment</span>
							Application &copy; 2016
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				$('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
					var color_class = $(this).find('option:selected').data('class');
					var new_class = 'widget-box';
					if(color_class != 'default')  new_class += ' widget-color-'+color_class;
					$(this).closest('.widget-box').attr('class', new_class);
				});
			
			
				// scrollables
				$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});
				$('.scrollable-horizontal').each(function () {
					var $this = $(this);
					$(this).ace_scroll(
					  {
						horizontal: true,
						styleClass: 'scroll-top',//show the scrollbars on top(default is bottom)
						size: $this.attr('data-size') || 500,
						mouseWheelLock: true
					  }
					).css({'padding-top': 12});
				});
				
				$(window).on('resize.scroll_reset', function() {
					$('.scrollable-horizontal').ace_scroll('reset');
				});
			
				
				$('#id-checkbox-vertical').prop('checked', false).on('click', function() {
					$('#widget-toolbox-1').toggleClass('toolbox-vertical')
					.find('.btn-group').toggleClass('btn-group-vertical')
					.filter(':first').toggleClass('hidden')
					.parent().toggleClass('btn-toolbar')
				});
			
				/**
				//or use slimScroll plugin
				$('.slim-scrollable').each(function () {
					var $this = $(this);
					$this.slimScroll({
						height: $this.data('height') || 100,
						railVisible:true
					});
				});
				*/
				
			
				/**$('.widget-box').on('setting.ace.widget' , function(e) {
					e.preventDefault();
				});*/
			
				/**
				$('.widget-box').on('show.ace.widget', function(e) {
					//e.preventDefault();
					//this = the widget-box
				});
				$('.widget-box').on('reload.ace.widget', function(e) {
					//this = the widget-box
				});
				*/
			
				//$('#my-widget-box').widget_box('hide');
			
				
			
				// widget boxes
				// widget box drag & drop example
			    $('.widget-container-col').sortable({
			        connectWith: '.widget-container-col',
					items:'> .widget-box',
					handle: ace.vars['touch'] ? '.widget-title' : false,
					cancel: '.fullscreen',
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'widget-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					start: function(event, ui) {
						//when an element is moved, it's parent becomes empty with almost zero height.
						//we set a min-height for it to be large enough so that later we can easily drop elements back onto it
						ui.item.parent().css({'min-height':ui.item.height()})
						//ui.sender.css({'min-height':ui.item.height() , 'background-color' : '#F5F5F5'})
					},
					update: function(event, ui) {
						ui.item.parent({'min-height':''})
						//p.style.removeProperty('background-color');
			
						
						//save widget positions
						var widget_order = {}
						$('.widget-container-col').each(function() {
							var container_id = $(this).attr('id');
							widget_order[container_id] = []
							
							
							$(this).find('> .widget-box').each(function() {
								var widget_id = $(this).attr('id');
								widget_order[container_id].push(widget_id);
								//now we know each container contains which widgets
							});
						});
						
						ace.data.set('demo', 'widget-order', widget_order, null, true);
					}
			    });
				
				
				///////////////////////
			
				//when a widget is shown/hidden/closed, we save its state for later retrieval
				$(document).on('shown.ace.widget hidden.ace.widget closed.ace.widget', '.widget-box', function(event) {
					var widgets = ace.data.get('demo', 'widget-state', true);
					if(widgets == null) widgets = {}
			
					var id = $(this).attr('id');
					widgets[id] = event.type;
					ace.data.set('demo', 'widget-state', widgets, null, true);
				});
			
			
				(function() {
					//restore widget order
					var container_list = ace.data.get('demo', 'widget-order', true);
					if(container_list) {
						for(var container_id in container_list) if(container_list.hasOwnProperty(container_id)) {
			
							var widgets_inside_container = container_list[container_id];
							if(widgets_inside_container.length == 0) continue;
							
							for(var i = 0; i < widgets_inside_container.length; i++) {
								var widget = widgets_inside_container[i];
								$('#'+widget).appendTo('#'+container_id);
							}
			
						}
					}
					
					
					//restore widget state
					var widgets = ace.data.get('demo', 'widget-state', true);
					if(widgets != null) {
						for(var id in widgets) if(widgets.hasOwnProperty(id)) {
							var state = widgets[id];
							var widget = $('#'+id);
							if
							(
								(state == 'shown' && widget.hasClass('collapsed'))
								||
								(state == 'hidden' && !widget.hasClass('collapsed'))
							) 
							{
								widget.widget_box('toggleFast');
							}
							else if(state == 'closed') {
								widget.widget_box('closeFast');
							}
						}
					}
					
					
					$('#main-widget-container').removeClass('invisible');
					
					
					//reset saved positions and states
					$('#reset-widgets').on('click', function() {
						ace.data.remove('demo', 'widget-state');
						ace.data.remove('demo', 'widget-order');
						document.location.reload();
					});
				
				})();
			
			});
		</script>
		<script type="text/javascript" charset="utf-8" >
			$(document).on('click', '.panel-heading span.clickable', function (e) {
			    var $this = $(this);
			    if (!$this.hasClass('panel-collapsed')) {
			        $this.parents('.panel').find('.panel-body').slideUp();
			        $this.addClass('panel-collapsed');
			        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
			    } else {
			        $this.parents('.panel').find('.panel-body').slideDown();
			        $this.removeClass('panel-collapsed');
			        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
			    }
			});
			$(document).on('click', '.panel div.clickable', function (e) {
			    var $this = $(this);
			    if (!$this.hasClass('panel-collapsed')) {
			        $this.parents('.panel').find('.panel-body').slideUp();
			        $this.addClass('panel-collapsed');
			        $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
			    } else {
			        $this.parents('.panel').find('.panel-body').slideDown();
			        $this.removeClass('panel-collapsed');
			        $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
			    }
			});
			$(document).ready(function () {
			    $('.panel-heading span.clickable').click();
			    $('.panel div.clickable').click();
			});
		</script>
		<script src="js/incidencia/index.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
<?php 

	}
	else
	{
	  header('Location: index.html'); 
		  exit();
	}
	
?>