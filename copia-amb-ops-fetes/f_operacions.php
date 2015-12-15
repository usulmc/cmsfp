<?php
// CMS FP
// funcions amb elements d'interficie del portal


include "config.php";


function connectar_bd()
{
	global $CFG;
	
	/* Establim connexió amb el servidor de BD(host,usuari,contrasenya */
	$conn=mysql_connect($CFG->dbhost,$CFG->dbuser,$CFG->dbpass);

	/* Identifiquem la base de dades que volem utilitzar */
	$err_db=mysql_select_db($CFG->dbname);
}


function tancar_bd()
{
	mysql_close();
}



function obrir_sessio($nick, $pwd)
{
	connectar_bd();
	
	$sql="select * from usuaris where nick='".$nick."' and contrasenya='".$pwd."'" ;

	if ( ! $resul=mysql_query($sql) ) {
		echo "No s'ha pogut connectar amb la base de dades";
		echo mysql_error();
		exit;
	}

	if ($arr_resul= mysql_fetch_array($resul)){
		assigna_id($arr_resul['nick']);
		assigna_permisos($arr_resul['nivell']);
		echo '<h3>Login ...</h3>';
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=index.php">';
	}	
	else{
		echo '<h3>Error al logar</h3>';
	}
	
	tancar_bd();
}



function tancar_sessio()
{
	acabar_sessio();
	echo '<h3>Exit ...</h3>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=index.php">';
}




function llistarusuaris()
{
	connectar_bd();

	$sql="select * from usuaris" ;

	if ( ! $resul=mysql_query($sql) ) {
		echo "No s'ha pogut realitzar la consulta";
		echo mysql_error();
		exit;
	}

	echo '<a href="index.php?operacio=form_alta_usuari">Afegeix un usuari</a> | <a href="index.php">Tornar a l\'&agrave;rea principal</a><br><br>';

	echo "<h2>Llistat usuaris del portal: </h2>";
	?>
	<table bgcolor="#C0D5BD" cellspacing=5 border="1" width="100%">
	<?php
    while ($arr_resul= mysql_fetch_array($resul)){
		echo '<tr class="tlu">';
		echo '<td><strong>'.$arr_resul['nick']."</strong></td>";
		echo '<td>'.$arr_resul['nomcognoms']."</td>";
		echo '<td>'.$arr_resul['edat']."</td>";
		echo '<td>'.$arr_resul['mail']."</td>";
		echo '<td>'.$arr_resul['nivell']."</td>";
		echo '<td><a href="index.php?operacio=form_modificar_usuari&nick='.$arr_resul['nick'].'">modificar</a></td>';	
		echo '<td><a href="index.php?operacio=op_eliminar_usuari&nick='.$arr_resul['nick'].'">eliminar</a></td>';
		echo '</tr>';
	}
	echo '</table>';
	
	mysql_free_result($resul);
	tancar_bd();
}




function crearnouusuari($nick, $nomcognoms, $edat, $mail, $pwd, $nivell)
{
	connectar_bd();

	$sql="insert into usuaris (nick, nomcognoms, edat, mail, contrasenya, nivell) values 
			('".$nick."', '".$nomcognoms."', '".$edat."', '".$mail."', '".$pwd."', '".$nivell."')" ;
	
	if ( ! $resul=mysql_query($sql)) {
		echo " problemes al crear l'usuari, usuari duplicat o error al connectar la BD.";
		echo mysql_error();
		exit;
	}
	else{
		echo " Nou usuari creat:".$nick;
		echo "<p><a href='index.php?operacio=llistar_usuaris'>Tornar</a>";
	}

	tancar_bd();
}





function eliminarusuari($nick)
{
	connectar_bd();

	$sql="DELETE FROM usuaris WHERE nick='".$nick."'" ;
	
	if ( ! $resul=mysql_query($sql) ) {
		echo " problemes al crear l'usuari, usuari duplicat o error al connectar la BD.";
		echo mysql_error();
		exit;
	}
	else{
		echo " Usuari ".$nick." eliminat.<br>";
		echo "<a href='index.php?operacio=llistar_usuaris'>Tornar</a>";
	}
	
	tancar_bd();
}




function formularimodificarusuari($nick)
{
	connectar_bd();
	
	$sql="SELECT * FROM usuaris WHERE nick='".$nick."'" ;
	
	if ( ! $resul=mysql_query($sql)) {
		echo " problemes al crear l'usuari, usuari duplicat o error al connectar la BD.";
		echo mysql_error();
		exit;
	}

	if ($arr_resul= mysql_fetch_array($resul)){
?>		
		<h2>Modificar usuari</h2>

		<form name="form1" method="POST" action="index.php">

		<table bgcolor="#C0D5BD" cellpadding="5" cellspacing="2" border="1">
		
		<tr><td> Nom i cognoms :</td> <td><input name="nomcognoms" type="text" value="<?php echo $arr_resul['nomcognoms']; ?>"></td></tr>
		<tr><td> Edat :</td> <td> <input name="edat" type="text" value="<?php echo $arr_resul['edat']; ?>"></td></tr> 
		<tr><td> Correu electr&oacute;nic :</td> <td> <input name="mail" type="text" value="<?php echo $arr_resul['mail']; ?>"></td></tr> 
		<tr><td> Usuari d\'acc&egrave;s:</td> <td><?php echo $arr_resul['nick']; ?></td></tr> 
		<tr><td> Contrasenya :</td> <td> <input name="contrasenya" type="password"></td></tr> 
		<tr><td> Nivell :</td> <td> <input name="nivell" type="text" value="<?php echo $arr_resul['nivell']; ?>"></td></tr> 
		<tr><td colspan="2" align="center"><input type="submit" value="Modificar"></td></tr>
		
		</table>

		<input name="nick" type="hidden" value="<?php echo $arr_resul['nick']; ?>"> 
		<input name="operacio" type="hidden" value="op_modificar_usuari">
		</form>

		<p><a href='index.php?operacio=llistar_usuaris'>Tornar &agrave;rea gesti&oacute;</a>
<?php
	}
		
	mysql_free_result($resul);

	tancar_bd();
}





function modificarusuari($nick, $nomcognoms, $edat, $mail, $pwd, $nivell)
{
	connectar_bd();

	$sql="UPDATE usuaris SET nick='".$nick."', edat='".$edat."', nomcognoms='".$nomcognoms."', mail='".$mail."', nivell='".$nivell."'";
	if($pwd!="")	$sql.=", contrasenya='".$pwd."'"; 
	$sql.=" WHERE nick='".$nick."'";
	

	if ( ! $resul=mysql_query($sql) ) {
		echo " problemes al modificar usuario error al connectar la BD.";
		echo mysql_error();
		exit;
	}
	else
	{
		echo "Usuari modificat:".$nick;
		echo "<p><a href='index.php?operacio=llistar_usuaris'>Tornar</a>";
	}
	
	tancar_bd();
}


?>