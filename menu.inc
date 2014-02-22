<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2010-08-04
 Last Update : 2013-01-13

 Description : Header and principal
               menu

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
$langmenu = $_SESSION['lingua'];
$paginamenu = "menu.inc";
$linguamenu = ($langmenu.$paginamenu);
include($linguamenu);

if ($user) {

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");
	
$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysql_fetch_array($rs);

?>

<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td style="width: 15%;"></td>
      <td style="width: 5px;"></td>
      <td ></td>

<!-- **** LOGOUT **** -->
	<td align='center' width='15%'></td>
    </tr>


    <tr>
      <td style="height: 5px; width: 15%;" bgcolor="#6d931c"></td>
      <td style="height: 5px; width: 5px;" bgcolor="#6d931c"></td>
      <td style="height: 5px;" bgcolor="#6d931c"></td>
      <td style="height: 5px; width: 15%;" bgcolor="#6d931c"></td>
    </tr>
    <tr>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="height: 5px;" bgcolor="#c7c7c7"></td>
    </tr>


    <tr>
      <td style="vertical-align: top; " bgcolor="#e8e8e8"><span style="font-weight: bold;">Menu<br>
      <br>

	      <hr style="width: 100%; height: 2px;">
      </span>

<div id='cssmenu'>
<ul>
   <li class='has-sub'><a href='#'><span><? echo $Lassociazione; ?></span></a>
      <ul>
         <li><a  target="_blank" href='<? echo $row[sito] ?>'><span>aol -<? echo $Lsito; ?></span></a></li>
         <li><a  target="_blank" href='<? echo $row[webmail] ?>'><span>aol - Web Mail</span></a></li>
         <li><a href='./dati_Associaz.php'><span>a-- -<? echo $Ldatiassociazione; ?></span></a></li>
         <li class='last'><a href='./Rip_database.php'><span>a-- - Backup</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lanagrafica; ?></span></a>
      <ul>
         <li><a href='./InsAnagrStud.php'><span>a-- -<?echo $Lfondatori; ?></span></a></li>
         <li><a href='./InsAnagrIns.php'><span>a-- -<? echo $Lassociati; ?></span></a></li>
         <li><a href='./InsAnagrExtra.php'><span>a-- -<? echo $Laltri; ?></span></a></li>
         <li><a href='./ricerca.php'><span>aol -<? echo $Lcerca; ?></span></a></li>
         <li><a href='./Rubrica.php'><span>aol -<? echo $Lrubrica; ?></span></a></li>
         <li class='last'><a href='./stampa_soci.php'><span>aol -<? echo $Llibrosoci ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lcontabilita; ?></span></a>
      <ul>
         <li><a href='./InsPrimanota.php'><span>ao- -<? echo $Lprimanota; ?></span></a></li>
         <li><a href='./InsRicFisc.php'><span>ao- -<? echo $Lquietanza; ?></span></a></li>
         <li><a href='./InsFattura.php'><span>ao- -<? echo $Lfattura; ?></span></a></li>
         <li><a href='./InsContoEconomico.php'><span>a-- -<? echo $Lcontoec; ?></span></a></li>
         <li><a href='./InsStatoPatrimoniale.php'><span>a-- -<? echo $Lstatopat; ?></span></a></li>
         <li><a href='./Rendiconto.php'><span>a-- -<? echo $Lrendiconto; ?></span></a></li>
         <li class='last'><a href='./Nuovo_Anno_soc.php'><span>a-- -<? echo $Lnuovoannosociale; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lgestione; ?></span></a>
      <ul>
<!--         <li><a href='./InsProgetto.php'><span>Progetti</span></a></li> -->
         <li><a href='./CompModuli.php'><span>ao- -<? echo $Lmoduli; ?></span></a></li>
         <li><a href='./Calendario2.php'><span>ao- -<? echo $Lcalendario; ?></span></a></li>
         <li><a href='./Comp_email.php'><span>a-- - E-Mail</span></a></li>
         <li><a href='./InsUtente.php'><span>a-- -<? echo $Lutenti; ?></span></a></li>
         <li><a href='./gest_files.php'><span>a-- -<? echo $Lfileseimmagini; ?></span></a></li>
	 <li class='last'><a href='./Log.php'><span>a-- -<? echo $Llog; ?></span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span><? echo $Lspecifiche; ?></span></a>
      <ul>
         <li><a href='./nclasse.php'><span>a-- -<? echo $Lfunzioniassociati; ?></span></a></li>
         <li class='last'><a href='./nmateria.php'><span>a-- -<? echo $Ltipoassociati; ?></span></a></li>
      </ul>
   </li>
   <li><a href='./Manuale.php'><span><? echo $Lmanuale; ?></span></a></li>
   <li class='last'><a href='./logout.php'><span><? echo $Luscita; ?></span></a></li>
</ul>
</div>



<td style="height: 5px;" bgcolor="#c7c7c7"></td>
      <td style="vertical-align: top;">

<?php
} else {
header('Location: ./index.php');
}
?>

