<?php

/** 
 * Aqui crearemos el html de la primera página
 */

$dato = get_option('setep_new_no_exp');
//var_dump($dato);
$endpoint = $dato[0]['endpoint'] != "" ? $dato[0]['endpoint'] : '';
$numeroExpediente = $dato[0]['numeroExpediente'] != "" ? $dato[0]['numeroExpediente'] : '';
$password = $dato[0]['password'] != "" ? $dato[0]['password'] : '';
$token = $dato[0]['token'] != "" ? $dato[0]['token'] : '';
?>
<div class="container p-4 m-4">
	<div class="row">
	<div class="col-md-18">
		<h2 class="display-6">Configuracion de Noticias de Setep</h2>
		<p>Ingrese su usuario y contraseña</p>
	</div>
		<div class="col-md-6">
			<form>
				<div class="mb-3">
					<label for="endpoint" class="form-label">Endpoint</label>
					<input type="text" class="form-control" id="endpoint" value="<?php echo $endpoint; ?>" placeholder="Endpoint">
				</div>
				<div class="mb-3">
					<label for="expediente" class="form-label">Número de Expediente</label>
					<input type="number" class="form-control" id="expediente" value="<?php echo $numeroExpediente; ?>" placeholder="Número de Expediente">
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Contraseña</label>
					<input type="password" class="form-control" id="password" value="<?php echo $password; ?>" placeholder="Contraseña">
				</div>

				<button type="submit" id="login" class="btn btn-primary">
					<?php 
					if($token!=''){
						echo 'Refrescar token';
					}else{
						echo 'Ingresar';
					}
					?>
				</button>
			</form>
		</div>
	</div>
</div>
<?php if($token!=''){?>
<div class="container p-4 m-4">
	<div class="row">
		<div class="col-md-10">
			<h3>Se ha configurado correctamente el plugin para traer las noticias</h3>
			<input id="token" class="form-control" type="text"  value="<?php echo $token; ?>" readonly>
		</div>
		<br><br>
		<div class="col-md-10">
			<h3>Da click en el boton de abajo para refrescar las noticias</h3>
			<button type="submit" id="newsrefresh" class="btn btn-primary">Refrescar noticias</button>
		</div>
	</div>
</div>
<?php }?>