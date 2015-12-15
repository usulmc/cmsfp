<?php
// Portal gèneric 
// Autors: Cicles Factory http://www.ciclesfactory.com
// Llicencia Creative Commons - Distribuible lliurement indicant-ne l'origen
// s'accepten ampliacions i millores en els mateixos termes.
 
include "seguretat.php";
include "funcions.php";
include "fperfilusuaris.php";
 
connecta_amb_sessio(); 

?>

<?php
capsalera();
?>

<!-- start page -->
<div id="page">
	<!-- start content -->
  <div id="content">
	<div class="post">
<?php    
    if( !hiha_sessio() ){
	echo "<h2 class='title'></h2>";
	echo "<p class='meta'><small>ERROR: Plana restringida</small></p>";
}
    
	echo '<h2 class="title">PERFIL Usuari: '.id_usuari().' </h2>';
?>			
	<p class="links">&nbsp;</p>
	<div class="entry"> 
<?php

if(isset($_REQUEST["operacio"]))
{
	$operacio=$_REQUEST["operacio"];
	$nom=id_usuari();
	if( $operacio=="editar" && isset($_REQUEST["nick"]) )
	{
		// construeix formulari per editar camps d'un usuari
		$nom = $_REQUEST["nick"];
		formulariperfilusuari($nom);
	}
	else if( $operacio=="perfil" &&  isset($_REQUEST["nomcognoms"]) && isset($_REQUEST["edat"]) && isset($_REQUEST["mail"]) && isset($_REQUEST["nick"]) )
	{
		//modifica valors d'un usuari  
		$nomcognoms = $_REQUEST["nomcognoms"];
		$edat = $_REQUEST["edat"];
		$mail = $_REQUEST["mail"];
		$nick = $_REQUEST["nick"];
	
		perfilusuari($nick, $nomcognoms, $edat, $mail);
	}
	else if( $operacio=="editarpwd" && isset($_REQUEST["nick"]) )
	{
		// construeix formulari per editar camps d'un usuari
		$nom = $_REQUEST["nick"];
		formularipwdusuari($nom);
	}
	else if( $operacio=="pwd" &&  isset($_REQUEST["pwd"]) && isset($_REQUEST["pwd1"]) )
	{
		//modifica valors d'un usuari  
		$pwd = $_REQUEST["pwd"];
		$pwd1 = $_REQUEST["pwd1"];
		$nick = $_REQUEST["nick"];
	
		pwdusuari($nick, $pwd, $pwd1);
	}
	else
	{
		echo "Operació no reconeguda";
	}
}

?>

</td></tr>
        
        </div>
	  </div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
		<?php 
		formularientradaportal();
		?>
            </li>
		</ul>
			
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
<?php
peu();
?>
</div>
</body>
</html>
