<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2010-08-04
 Last Update : 2012-12-27

 Description : secondary menu

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
=========================================================================+*/
session_start();
$user = $_SESSION['utente'];
$langdatiass = $_SESSION['lingua'];
$paginadatiass = "datiassociaz.inc";
$linguadatiass = ($langdatiass.$paginadatiass);
include($linguadatiass);

if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='disabled';
}
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysql_fetch_array($rs);

?>
<center><h2><? echo $Ldatiassociazione; ?></h2></center>
<center><small><? echo $Linsomod; ?></small></center>
<br>
      <form action='./conf_mod_Associaz.php' method='POST' enctype="multipart/form-data">
<table align='center' width='50%'>
<tbody>
	    <tr>
              <td width='70%'><? echo $Llogoassociaz; ?></td>
              <td><img src='./Immagini/logo.png' width="100px"></td>
            </tr>
	    <tr>
              <td width='70%'><font color="red"><? echo $Lnomeassociaz; ?></td>
              <td><input name='nome' size='30%' type='text' value='<? echo $row[nome] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lvia; ?></td>
              <td><input name='indirizzo' size='30%' type='text' value='<? echo $row[indirizzo] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lnumero; ?></td>
              <td><input name='numero' size='30%' type='text' value='<? echo $row[numero] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lcap; ?></td>
              <td><input name='cap' size='30%' type='text' value='<? echo $row[cap] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lcitta; ?></td>
              <td><input name='citta' size='30%' type='text' value='<? echo $row[citta] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lprovincia; ?></td>
              <td><input name='provincia' size='30%' type='text' value='<? echo $row[provincia] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Ltelefono; ?></td>
              <td><input name='tel' size='30%' type='text' value='<? echo $row[tel] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lfax; ?></td>
              <td><input name='fax' size='30%' type='text' value='<? echo $row[fax] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lcfpi; ?></td>
              <td><input name='cf' size='30%' type='text' value='<? echo $row[cf] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lindirizzo; ?>e-mail:</td>
              <td><input name='email' size='30%' placeholder='email@socio.xxx' type='text' value='<? echo $row[email] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo $Lindirizzo; ?>webmail:</td>
              <td><input name='webmail' size='30%' placeholder='http://webmail.dominio.xxx' type='text' value='<? echo $row[webmail] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><? echo ($Lindirizzo.$Lsito); ?></td>
              <td><input name='sito' size='30%' placeholder='http://www.sito.xxx' type='text' value='<? echo $row[sito] ?>'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <? echo($limit); ?>></td>
            </tr>
</table>
</form>
<?php
include('./menusx.inc');
echo $Lhelpdatiassociaz;
include('./botton.inc');

?>