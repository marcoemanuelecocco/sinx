<?php
/*Sinx for Association - Gestionale per Associazioni no-profit
    Copyright (C) 2011 by Sergio Capretta

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
session_start();
$user = $_SESSION['utente'];
if ($user) {

	$id_mod = $_POST['id_mod'];
	$nrecord = $_POST['record'];

	$record = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");
	$Tabella = $_GET[Tabella];
	$Voce = $_GET[Voce];
	$Record = $_GET[Riferimento];

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

 
		$sql="UPDATE $Tabella SET $Voce = '$record' WHERE $Record = '$id_mod'"; //inserisco i valori nel database
		$result=mysql_query($sql);

	if (!$result) {
 die(header('location: ./errore.html'));//"Errore nella query $query: " . mysql_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.html'); //Vado alla pagina di conferma
		}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
