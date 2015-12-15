<?php
// Portal gèneric 
// Autors: Cicles Factory http://www.ciclesfactory.com
// Llicencia Creative Commons - Distribuible lliurement indicant-ne l'origen
// s'accepten ampliacions i millores en els mateixos termes.

include "funcions_bd.php";

function formularipwdusuari($nick)
{
	connectar_bd();
	
	/*Establim la comanda SQL per inserir un registre a la BD */
	$sql="SELECT * FROM usuaris WHERE nick='".$nick."'" ;
	
	/* Ara la funció mysql_query, executa una operació d'inserció */
	if ( ! $resul=mysql_query($sql)) {
		echo " problemes al crear l'usuari, usuari duplicat o error al connectar la BD.";
		echo mysql_error();
		exit;
	}

	if ($arr_resul= mysql_fetch_array($resul)){
?>		
		<h2>Modificar usuari</h2>
		
		<form name="form1" method="GET" action="perfilusuaris.php">

		<table bgcolor="#C0D5BD" cellpadding="5" cellspacing="2" border="1">
		
		<tr><td> Contrasenya :</td> <td><input name="pwd" type="password"></td></tr>
		<tr><td> Repeteix contrasenya :</td> <td> <input name="pwd1" type="password"></td></tr> 
		<tr><td colspan="2" align="center"><input type="submit" value="Modificar"></td></tr>
		
		</table>

		<input name="nick" type="hidden" value="<?php echo $arr_resul['nick']; ?>"> 
		<input name="operacio" type="hidden" value="pwd">
		</form>

		<p><a href='index.php'>Tornar</a>

<?php
	}
		
	// Alliberem l'espai de memòria ocupat pel resultat de la consulta
	mysql_free_result($resul);

	// Tanquem connexió amb el servidor de BD
	tancar_bd();
}
 

function pwdusuari($nick, $pwd, $pwd1)
{
	connectar_bd();

	/* Establim la comanda SQL per inserir un registre a la BD segons si també vol modificar la constrasenya*/
	if ( $pwd==$pwd1 || strlen($pwd)==0) {
	$sql="UPDATE usuaris SET contrasenya='".$pwd."'";
	
	$sql.=" WHERE nick='".$nick."'";
	
	/* Ara la funció mysql_query, executa una operació d'inserció */
	if ( ! $resul=mysql_query($sql) ) {
		echo " problemes al modificar usuario error al connectar la BD.";
		echo mysql_error();
		exit;
	}
	else
	{
		echo "Contrasenya modificada:".$nick;
		echo "<p><a href='index.php'>Tornar</a>";
	}
	} else {
			echo "Les contrasenyas no son iguals o esta en blanc";
			echo "<p><a href='index.php'>Tornar</a>";

	}
	// Tanquem connexió amb el servidor de BD
	tancar_bd();
}

function formulariperfilusuari($nick)
{
	connectar_bd();
	
	/*Establim la comanda SQL per inserir un registre a la BD */
	$sql="SELECT * FROM usuaris WHERE nick='".$nick."'" ;
	
	/* Ara la funció mysql_query, executa una operació d'inserció */
	if ( ! $resul=mysql_query($sql)) {
		echo " problemes al crear l'usuari, usuari duplicat o error al connectar la BD.";
		echo mysql_error();
		exit;
	}

	if ($arr_resul= mysql_fetch_array($resul)){
?>		
		<h2>Modificar usuari</h2>
		
		<form name="form1" method="GET" action="perfilusuaris.php">

		<table bgcolor="#C0D5BD" cellpadding="5" cellspacing="2" border="1">
		
		<tr><td> Nom i cognoms :</td> <td><input name="nomcognoms" type="text" value="<?php echo $arr_resul['nomcognoms']; ?>"></td></tr>
		<tr><td> Edat :</td> <td> <input name="edat" type="text" value="<?php echo $arr_resul['edat']; ?>"></td></tr> 
		<tr><td> Correu electr&oacute;nic :</td> <td> <input name="mail" type="text" value="<?php echo $arr_resul['mail']; ?>"></td></tr> 
		<tr><td> Usuari d\'acc&eacute;s:</td> <td><?php echo $arr_resul['nick']; ?></td></tr> 
		<tr><td colspan="2" align="center"><input type="submit" value="Modificar"></td></tr>
		
		</table>

		<input name="nick" type="hidden" value="<?php echo $arr_resul['nick']; ?>"> 
		<input name="operacio" type="hidden" value="perfil">
		</form>

		<p><a href='index.php'>Tornar</a>
<?php
	}
		
	// Alliberem l'espai de memòria ocupat pel resultat de la consulta
	mysql_free_result($resul);

	// Tanquem connexió amb el servidor de BD
	tancar_bd();
}




function perfilusuari($nick, $nomcognoms, $edat, $mail)
{
	connectar_bd();

	/* Establim la comanda SQL per inserir un registre a la BD segons si també vol modificar la constrasenya*/
	$sql="UPDATE usuaris SET nick='".$nick."', edat='".$edat."', nomcognoms='".$nomcognoms."', mail='".$mail."'";
	
	$sql.=" WHERE nick='".$nick."'";
	
	/* Ara la funció mysql_query, executa una operació d'inserció */
	if ( ! $resul=mysql_query($sql) ) {
		echo " problemes al modificar usuario error al connectar la BD.";
		echo mysql_error();
		exit;
	}
	else
	{
		echo "Perfil modificat:".$nick;
		echo "<p><a href='index.php'>Tornar</a>";
	}
	
	// Tanquem connexió amb el servidor de BD
	tancar_bd();
}


