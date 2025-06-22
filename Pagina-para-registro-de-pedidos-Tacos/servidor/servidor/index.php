<?php
session_start();
if (empty($_SESSION["IdUsuario"])) {
	header("location: log.php");
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Menú</title>
	<style>
		body {
			background-color: #F5F5F5;
			font-family: Arial, sans-serif;
		}
		h1 {
			color: #004080;
			font-size: 90px;
			text-align: center;
			margin-top: 150px;
		}
		ul {
			list-style: none;
			margin: 0;
			padding: 0;
			text-align: center;
			margin-top: 30px;
		}
		li {
			display: inline-block;
			margin: 0 20px;
		}
		a {
			color: #F5F5F5;
			text-decoration: none;
			font-size: 24px;
			padding: 10px 20px;
			border-radius: 10px;
			transition: all 0.3s ease;
			background: linear-gradient(to bottom, #004080, #002c60);
			box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
			border: none;
			cursor: pointer;
			display: inline-block;
		}
		a:hover {
			background: linear-gradient(to bottom, #002c60, #004080);
			box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
			transform: translateY(-20px);
		}
		
	</style>
<head>
	<style>
		/* Aplica estilos a las imágenes */
		img {
			width: 150px; /* Define el ancho deseado */
			height: 150px; /* Define la altura deseada */
		}
	</style>
</head>
<body>
	<h1>Menú Principal</h1>
	<ul>
		<li><a href="conexionpdousuario.php"><img src="https://1.bp.blogspot.com/-6biM0Ro6pPs/V1DHCi2AMKI/AAAAAAAABH4/w23CVQxX3G0_jynSafrt59z7hgW-EB0xwCLcB/s1600/usuarios.png" alt="Usuario"> <br>Usuario</a></li>

		<li><a href="consumible.php"><img src="https://www.tourinews.es/uploads/s1/50/77/74/entra-en-vigor-la-medida-estrella-de-uk-para-reactivar-su-hosteleria.jpeg" alt="Consumibles"> <br>Comsumible</a></li>

		<li><a href="cliente.php"><img src="https://th.bing.com/th/id/OIP.UGOlrvRScPHObFiZk6jM5QEsDh?pid=ImgDet&rs=1" alt="Clientes"><br> Clientes</a></li>

		<li><a href="conexionBoleta.php"><img src="https://www.pertel.pe/wp-content/uploads/2018/10/Norma.jpg" alt="Boletas">

			<br> Boletas</a></li>


		<li><a href="Actualizar_Mesa.php"><img src="https://static.vecteezy.com/system/resources/previews/001/522/242/non_2x/wooden-table-and-chair-cartoon-style-free-vector.jpg" alt="Usuario"> <br>Mesas</a></li>


		<li><a href="pedido.php"><img src="https://th.bing.com/th/id/OIP.vdGW_8kbi_B5up6mRkyzZQAAAA?pid=ImgDet&w=450&h=383&rs=1" alt="Pedidos"><br> pedido</a></li>

		<li><a href="conexionpdodetalle.php"><img src="https://dojiw2m9tvv09.cloudfront.net/4/product/dte0664.png?1448" alt="Detalles">

			<br> Detalles</a></li>

		<li><a href="categoria.php"><img src="https://th.bing.com/th/id/R.4a7831c584c909740fa6370871c413e0?rik=cvzMbb%2b2fEPatg&pid=ImgRaw&r=0" alt="Categoria">

			<br> Categoria</a></li>
	</ul>
</head>
<body>
 
<br>
	<br>
	<br>
	
  <a href="controladorSS.php" class="logout-link">Cerrar sesión</a>
</body>
</html>
