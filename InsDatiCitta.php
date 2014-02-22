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
;
	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
 $q_str = INSERT INTO tb_citta(citta) VALUES ($citta);
	$result = mysql_query($q_str);
	if (!$result) {
	die("Errore nella query $query: " . mysql_error());
}
$id_inserito = mysql_insert_id();
mysql_close();
$messaggio = urlencode("Inserimento effettuato con successo (ID=$id_inserito)");
header('location: '.$_SERVER['PHP_SELF'].'?msg='.$messaggio);
} else {
header('Location: ./index.php');
}
?>
