<?php
/*======================================================================+
 File name   : index2.php
 Begin       : 2010-08-04
 Last Update : 2012-08-27

 Description : The sinx's first page

 Author: Sergio Capretta

 (c) Copyright:
               Sergio Capretta
             
               ITALY
               www.sinx.it
               info@sinx.it

Sinx for Association - Gestionale per Associazioni no-profit
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
=========================================================================+
*/
session_start();
$user = $_SESSION['utente'];
$langu = $_SESSION['lingua'];
$paginaindex2 = "index2.inc";
$linguaindex2 = ($langu.$paginaindex2);
include($linguaindex2);

if ($user) {
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
<h2><? echo $Lbenvenuto; ?></h2>

      <div style="margin-left: 20px;"><small><? echo $Lfrase; ?></center></div></small>
<?php

//Funzione compleanno
$compleanno = date('j-m');
$compleanno2 = date('d-n');

$query = "SELECT nome
	FROM tb_anagrafe
	WHERE datan REGEXP '^$compleanno2' OR datan REGEXP '^$compleanno'
	ORDER BY id_anagrafe";

$rs=mysql_query($query) or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while($row=mysql_fetch_array($rs))
{
  if($row)
  {
    echo "<br><h3>Oggi <i>".$row['nome']."</i> compie gli anni</h3>";
    }
}

mysql_close();
include('./menusx.inc');
echo $Lhelpindex2;
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>

