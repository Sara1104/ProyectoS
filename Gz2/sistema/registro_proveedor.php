<?php 
	session_start();

if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 )
{
	 header("location: ./");
}

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if (empty($_POST['proveedor']) ||empty($_POST['contacto'])|| empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            $nit         = $_POST['nit'];
            $proveedor   = $_POST['proveedor'];
			$contacto    = $_POST['contacto'];
			$telefono    = $_POST['telefono'];
			$direccion   = $_POST['direccion'];
			$usuario_id  = $_SESSION['idUser'];
            
            $result = 0;

            if(is_numeric($nit) and $nit !=0)
            {
   			$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE nit = '$nit'");
   			$result = mysqli_fetch_array($query);        	
            }

           if($result > 0){
           	$alert='<p class="msg_error">El número del NIT ya existe.</p>';
           }else{

            $query_insert = mysqli_query($conection,"INSERT INTO proveedor(nit,proveedor,contacto,telefono,direccion,usuario_id)
				VALUES('$nit','$proveedor','$contacto','$telefono','$direccion','$usuario_id')");

                if($query_insert){
					$alert='<p class="msg_save">Proveedor guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el proveedor.</p>';
           }	    
		}

	}
       mysqli_close($conection);
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="far fa-building"></i> Registro Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nit">NIT</label>
				<input type="number" name="nit" id="nit" placeholder="Número del NIT">
				<label for="proveedor">Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
				<label for="contacto">Contacto</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección Completa">

				<button type="submit"class="btn_save"><i class="fas fa-save"></i> Crear Proveedor</button>
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>