<?php
/*======================================================================+
 File name   : DatiComini.inc
 Begin       : 2010-08-04
 Last Update : 2012-10-27

 Description : Common data entry registries

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
$langdaticom = $_SESSION['lingua'];
$paginadaticom = "daticomuni.inc";
$linguadaticom = ($langdaticom.$paginadaticom);
include($linguadaticom);

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
	    <tr>
	      <td width='150'><? echo $Lpimmagine; ?><input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i><? echo $Listrimmagine; ?></small></i></sub></td>
	    </tr>
            <tr>
              <td width='150'><font color="red"><? echo $Lnomedaticomuni; ?></td>
              <td><input name='nome' size='30' type='text'><br><small><sub><i><? $Listrnome; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><? echo $Lindirizzo; ?></td>
              <td><input name='indirizzo' size='30' type='text'><br><small><sub><i><? echo $Listrindirizzo; ?></small></i></sub></td>
            </tr>
<tr>
              <td><? echo $Lregione; ?></td>

<td><select name="regioni" >
   <option value="" selected="selected"><? echo $Lscegli; ?></option>
<?php
$query = "SELECT nome_regione FROM regioni ORDER BY nome_regione";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select></td>
</tr>
<tr>
             <td><? echo $Lprovincia; ?></td>

<td><select name="provincie" >
   <option value="" selected="selected"><? $Lscegli; ?></option>
<?php
$query = "SELECT nome_provincia FROM province ORDER BY nome_provincia";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select></td>
</tr>
<tr>
             <td><? echo $Lcomune; ?></td>

<td><select name="comuni" >
   <option value="" selected="selected"><? echo $Lscegli; ?></option>
<?php
$query = "SELECT cap, comune FROM comuni ORDER BY comune ASC";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo cap");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"], " - ", $row["1"]. "</option>";

}
?>
  </select></td></tr>
            <tr>
              <td width='150'><? echo $Ltel; ?></td>
              <td><input name='tel' size='30' type='tel' min='0' max='3499999999'><br><small><sub><i><? echo $Listrtel; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><? echo $Lcell; ?></td>
              <td><input name='tel2' size='30' type='tel' min='0' max='3499999999'><br><small><sub><i><? echo $Listrtel; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'>e-mail:</td>
              <td><input name='email' size='30' type='email' placeholder='email@socio.xxx'></td>
            </tr>
            <tr>
              <td width='150'><? echo $Ldatanasc; ?></td>
              <td><input name='datangg' size='2' type='number' min='1' max='31'> - 
		  <input name='datanmm' size='2' type='number' min='1' max='12'> -
		  <input name='datanaaaa' size='4' type='number' min='1900' max='2100'><br><small><sub><i><? echo $Listrdatan; ?></small></i></sub>
	      </td>
            </tr>
            <tr>
              <td width='150'><? echo $Lcodfiscale; ?></td>
              <td><input name='nomerif' size='30' type='text'></td>
            </tr>
            <tr>
              <td width='150'><? echo $Lassociato; ?></td>
              <td><input type="checkbox" name="check" checked="checked" value="1"><? echo $Lassociatoattivo; ?></td>
            </tr>
	    <tr>
	      <td width='150'><? echo $Lnote; ?></td>
	      <td><textarea name="note" rows="5" cols="40"></textarea></td>
	    </tr>