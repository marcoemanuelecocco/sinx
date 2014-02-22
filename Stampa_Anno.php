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
if ($user == 'admin') {

include('./Intestazione.php');

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

?>
     <p align="center"><b>*** Libro soci ***</b></p><br>

<?php
$classe = $_POST['classi'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE tipologia = 'Ins' OR tipologia = 'Stud' ORDER BY nome";

$rs=mysql_query($Query_nome)
or die("Errore nella query $query: " . mysql_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr>
	<td width='150'><small><b>nome </b></small></td>
	<td width='150'><small><b>indirizzo </b></small></td>
	<td width='150'><small><b>Citta </b></small></td>
	<td width='150'><small><b>provincia </b></small></td>
	<td width='150'><small><b>Cod Fisc </b></small></td>
	<td width='150'><small><b>Tipo </b></small></td>
	<td width='150'><small><b>Funzione </b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td width='150'><small>$row[nome]</small></td>
	<td width='150'><small>$row[indirizzo]</small></td>
	<td width='150'><small>$row[citta]</small></td>
	<td width='150'><small>$row[provincia]</small></td>
	<td width='150'><small>$row[nomerif]</small></td>
	<td width='150'><small>$row[materia]</small></td>
	<td width='150'><small>$row[classe]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;

// **** STAMPA PRIMA NOTA CASSA ****

?>
<BR><HR><BR>
     <p align="center"><b>*** Registro prima nota semplice ***</b></p><br>

<?php
// popolo la tabella della primanota
$Query_nome = "SELECT * FROM tb_primanota ORDER BY id_primanota";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table style="position: absolute; right: 70px;" width='38%' border='0' bgcolor="#D1D1D1">
	<tr>
	<td height='35px' align='center' width='200'><small><b>Cassa</b></small></td>
	<td height='35px' align='center' width='200'><small><b>Banca</b></small></td>
	</tr>
</table>
<br><br>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' bgcolor="#D1D1D1">
	<tr>
	<td width='125'><small><b>data_registr</b></small></td>
	<td width='150'><small><b>descrizione</b></small></td>
	<td width='100' align='right'><small><b>entrata</b></small></td>
	<td width='100' align='right'><small><b>uscita</b></small></td>
	<td width='100' align='right'><small><b>entratab</b></small></td>
	<td width='100' align='right'><small><b>uscitab</b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
EOM;
}

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>
	<tr>
	<td height='15px' width='125'><small>$row[data_registr]</small></td>
	<td height='15px' width='150'><small>$row[descrizione]</small></td>
	<td height='15px' width='100' align='right'><small>$row[entrata]</small></td>
	<td height='15px' width='100' align='right'><small>$row[uscita]</small></td>
	<td height='15px' width='100' align='right'><small>$row[entratab]</small></td>
	<td height='15px' width='100' align='right'><small>$row[uscitab]</small></td>
	</tr>
</table>

EOM;
}

//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysql_query($query);
$entrata_tot = mysql_fetch_row($result);
?>
<table>
<table border='0' cellpadding='0' cellspacing='0' width='95%'>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small>Entrata Cassa</small></td>
	<td height='30px' align='right' width='10%'><small><?php echo $entrata_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysql_query($query);
$uscita_tot = mysql_fetch_row($result);
?>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small>Uscite Cassa</small></td>
	<td height='30px' align='right' width='10%'><small><?php echo $uscita_tot[0]; ?></small></td>
</tr>
<tr>
<td width='80%'></td>
	<td height='30px' width='10%'><small><b>Guad/Perdita</b></small></td>
	<td height='30px' align='right' width='10%'><small><b><?php echo ($entrata_tot[0]-$uscita_tot[0]); ?></b></small></td>
</tr></table><br>

<?php
//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysql_query($query);
$entratab_tot = mysql_fetch_row($result);
?>

<table border='0' cellpadding='0' cellspacing='0' width='95%'>
<tr>
<td width='80%'></td>
<hr style="width: 20%; height: 2px; position: absolute; right: 60px"><br>
	<td height='30px' width='10%'><small>Entrata Banca</small></td>
	<td height='30px' align='right' width='150'><small><?php echo $entratab_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysql_query($query);
$uscitab_tot = mysql_fetch_row($result);
?>
<tr>
<td width='80%'></td>
	<td height='30px' width='150'><small>Uscite Banca</small></td>
	<td height='30px' align='right' width='150'><small><?php echo $uscitab_tot[0]; ?></small></td>
</tr>
<tr>
<td width='80%'></td>
	<td height='30px' width='150'><small><b>Guad/Perdita</b></small></td>
	<td height='30px' align='right' width='150'><small><b><?php echo ($entratab_tot[0]-$uscitab_tot[0]); ?></b></small></td>
</tr><br>
</table>

<!-- popolo la tabella delle fatture -->
<BR><HR><BR>
	<p align="center"><b>*** Elenco Fatture ***</b></p>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>num</b></small></td>
	<td width='125'><small><b>data</b></small></td>
	<td width='100'><small><b>nome</b></small></td>
	<td width='100' align='right'><small><b>Tot Iva inclusa</b></small></td>
	</tr>
<?php

$a = '1';
do {
$Query = "SELECT id_tot_fatture, tot_fattura, nome, data
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
	LIMIT 1";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
	{
echo <<<EOM
		<tr>
		<td height='25px' width='125' align='center'><small>$row[id_tot_fatture]</small></td>
		<td height='25px' width='125'><small>$row[data]</small></td>
		<td height='25px' width='100'><small>$row[nome]</small></td>
		<td height='25px' width='100' align='right'><small>$row[tot_fattura]</small></td>
		</tr>


EOM;
	}
$a++;
} while ($a <= 1000);
echo <<<EOT
</table><p></p>
EOT;
?>


<BR><HR><BR>
	<p align="center"><b>*** Elenco ricevute ***</b></p>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>num ricevuta</b></small></td>
	<td width='125'><small><b>data</b></small></td>
	<td width='150'><small><b>nome</b></small></td>
	<td width='100' align='right'><small><b>euro</b></small></td>
	<td width='100' align='right'><small><b>descr</b></small></td>
	</tr>
<?php
// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute ORDER BY id_ric";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id_ric]</small></td>
	<td height='25px' width='20%'><small>$row[data]</small></td>
	<td height='25px' width='30%'><small>$row[nome]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[euro]</small></td>
	<td height='25px' width='30%' align='right'><small>$row[descr]</small></td>
	</tr>

EOM;
}
echo <<<EOT
</table><p></p>
EOT;
?>


<!-- **** STAMPA CONTO ECONOMICO **** -->
<BR><HR><BR>
	<p align="center"><b>*** Conto economico ***</b></p>
<?php
// popolo la tabella della conto economico


{
echo <<<EOM

<table width='80%' border='0' align='center'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Proventi e ricavi</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Costi e Oneri</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella costi/ricavo -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'ricavi' ORDER BY id";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysql_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='30%'><small>$row[descrizione]</small></td>
	<td height='25px' width='15%'><small>$row[valore]</small></td>
	</tr>
</table>
EOM;
}
      ?>
    </td>
    <td width="50%">
<?php

 $Query = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'oneri' ORDER BY id";

$ros=mysql_query($Query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($riga=mysql_fetch_array($ros))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$riga[id]</small></td>
	<td height='25px' width='30%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='15%'><small>$riga[valore]</small></td>
	</tr>
</table>
EOM;
}

?>
    </td>
  </tr>
</table>

<?php
//Calcolo delle somme
$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'ricavi'";
$result = mysql_query($query);
$entrata = mysql_fetch_row($result);

$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'oneri'";
$result = mysql_query($query);
$uscita = mysql_fetch_row($result);
?>
<hr style="width: 20%; height: 2px; position: center;"><br>
<table width='80%' border='0' align ='center'>
<tr>
	<td height='30px' width='20%'><small>Totale Proventi</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale spese</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $uscita[0]; ?> &euro;</small></td>
</tr>
<tr>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'><small><b>Avanzo di Gestione</b></small></td>
	<td height='30px' align='right' width='20%'><small><b><?php echo ($entrata[0]-$uscita[0]); ?> &euro;</b></small></td>
</tr>
<tr>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo (($entrata[0]-$uscita[0])+$uscita[0]); ?> &euro;</small></td>
</table><br>


<!-- Visualizzazione Stato Patrimoniale -->
<BR><HR><BR>
	<p align="center"><b>*** Stato Patrimoniale ***</b></p>
<?php
// popolo la tabella


{
echo <<<EOM

<table width='80%' border='0' align='center'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Attivit&agrave</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Passivit&agrave</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella attività/passività -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_stato_patrimoniale WHERE costoricavo = 'attivita' ORDER BY id";

$rs=mysql_query($Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysql_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='30%'><small>$row[descrizione]</small></td>
	<td height='25px' width='15%'><small>$row[valore]</small></td>
	</tr>
</table>
EOM;
}
      ?>
    </td>
    <td width="50%">
<?php

 $Query = "SELECT * FROM tb_stato_patrimoniale WHERE costoricavo = 'passivita' ORDER BY id";

$ros=mysql_query($Query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($riga=mysql_fetch_array($ros))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$riga[id]</small></td>
	<td height='25px' width='30%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='15%'><small>$riga[valore]</small></td>
	</tr>
</table>
EOM;
}

?>
    </td>
  </tr>
</table>

<?php
//Calcolo delle somme
$query = "SELECT SUM(valore) FROM tb_stato_patrimoniale where costoricavo = 'attivita'";
$result = mysql_query($query);
$entrata = mysql_fetch_row($result);

$query = "SELECT SUM(valore) FROM tb_stato_patrimoniale where costoricavo = 'passivita'";
$result = mysql_query($query);
$uscita = mysql_fetch_row($result);
?>
<hr style="width: 20%; height: 2px; position: center;"><br>
<table width='80%' border='0' align ='center'>
<tr>
	<td height='30px' width='20%'><small>Totale Proventi</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale spese</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $uscita[0]; ?> &euro;</small></td>
</tr>
<tr>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'><small><b>Avanzo di Gestione</b></small></td>
	<td height='30px' align='right' width='20%'><small><b><?php echo ($entrata[0]-$uscita[0]); ?> &euro;</b></small></td>
</tr>
<tr>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo (($entrata[0]-$uscita[0])+$uscita[0]); ?> &euro;</small></td>
</table><br>
<?php
mysql_close();

} else {
header('Location: ./index.php');
}
?>



