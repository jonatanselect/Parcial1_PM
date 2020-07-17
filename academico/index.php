<?php 

$alert = '';
session_start();//esto ayuda q pueda utilizarse esta variable $_SESSION['active']
if(!empty($_SESSION['active']))
{
	header('location: sistema/');//reedireciona al sistema
}else{


	if(!empty($_POST))//empty si existe POST
	{	//si estaw vacio el usuario o si lo esta la clave
		if(empty($_POST['usuario']) || empty($_POST['clave']))//ESTE usuario y clave pertenece al input text y password
		{	
			$alert = 'Ingrese su usuario y su clave';
			
			
		}
		else{//se conectara a la ba
			require_once "conexion.php";
			//ESTE usuario y clave pertenece al input text y password
			$Usuario =mysqli_real_escape_string($conection,$_POST['usuario']);//esa funcion para q entre encriptado, usuario es el nombre del campo
			$clave   =md5(mysqli_real_escape_string($conection,$_POST['clave']));//esta encriptando la clave para evitar hackeos

			//este query guardara la seleccion de ingreso
			$query = mysqli_query($conection,"SELECT * FROM usuario where ci_identificacion1='$Usuario' AND clave_usuario='$clave'");
			$result = mysqli_num_rows($query);//esta funcion devuelve un nro ,afirmando q es la clave correcta
			//print $_POST['usuario'].":  ";
			//print $clave;
			if($result>0){//en un array data se guardara el query 
				$data = mysqli_fetch_array($query);
				//inicia el doc sistemas session_start();
				//print_r($data);exit();
				//ahora data esun array,aqui el campo passwor no se anota
				$_SESSION['active'] =true;//esto nos ayuda a confirmar si estaba activado o no
				$_SESSION['codUser'] =$data['cod_usuario'];
				$_SESSION['ciUser'] =$data['ci_identificacion1'];
				$_SESSION['tipoUser'] =$data['id_tipo_usuario1'];
				
				//echo mesajeee= "ha dado click ingresar ";
				header('location: sistema/');

			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();//destruye session
			}
			
		}
			//echo $alert = "ha dado click ingresar";
	}

}
 ?>
<!DOCTYPE html>
<html lang="en">
<head><!-- en el style usamos * para formatear todo -->
	<meta charset="utf-8">
	<title>Login | Sistema Academico</title>
	<!-- para enlazar el css style se pone el link -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id="container">
		
		<form action="" method="post">
			<h3>Iniciar Sesion</h3>
			<img src="img/Login_Usuario.png" alt="Login">
			<input type="text" name="usuario" placeholder="usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			<div class="alert"><?php echo isset($alert)? $alert:'';  ?></div><!-- isset es como un if q no esta vacio y ?: es else -->
			<input type="submit" value="INGRESAR">
			
		</form>
	</section>
</body>
</html>
