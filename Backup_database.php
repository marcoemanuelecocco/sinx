<?php
/*======================================================================+
 File name   : Backup_database.php
 Begin       : 2013-01-09
 Last Update : 2013-08-21

 Description : sistem remote backup and restore

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
if ($user == 'admin') {

	include ('dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

// *** Creo la lista delle tabelle ***
 
$sql = "SHOW TABLES FROM $db_name";
$result_tabelle = mysql_query($sql);
 
if (!$result_tabelle) {
   echo "DB Error, could not list tables\n";
   echo 'MySQL Error: ' . mysql_error();
   exit;
}


// **** AVVIO DEL BACKUP ****
# Creo la funzione datadump
function datadump ($table) {

  # Creo la variabile $result
  $result .= "# Dump of $table \n";
  $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";

  # Conto i campi presenti nella tabella
  $query = mysql_query("select * from $table");
  $num_fields = @mysql_num_fields($query);

  # Conto il numero di righe presenti nella tabella
  $numrow = mysql_num_rows($query);

  # Passo con un ciclo for tutte le righe della tabella
  for ($i =0; $i<$numrow; $i++)
  {
    $row = mysql_fetch_row($query);

    # Ricreo la tipica sintassi di un comune Dump
    $result .= "INSERT INTO ".$table." VALUES(";

    # Con un secondo ciclo for stampo i valori di tutti i campi
    # trovati in ogni riga
    for($j=0; $j<$num_fields; $j++) {
      $row[$j] = addslashes($row[$j]);
      $row[$j] = ereg_replace("\n","\\n",$row[$j]);
      if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
      if ($j<($num_fields-1)) $result .= ",";
    }

    # Chiudo l'istruzione INSERT
    $result .= ");\n";
  }

  return $result . "\n\n\n";
}
# Diamo un nome al file di Dump che verrà creato
$file_name = "Sinx_Backup_".date('d-m-Y').".txt";

# Definiamo le intestazioni
Header("Content-type: application/octet-stream"); 
Header("Content-Disposition: attachment; filename = $file_name");

# Poniamo di voler fare il Dump di 2 tabelle chiamate rispettivamente
# "amici" e "clienti"... Ovviamente potete modificare
# a piacimento!
while ($lista = mysql_fetch_row($result_tabelle)) {
  $table = datadump("{$lista[0]}");




# Stampiamo il contenuto
echo $table; 
}
# Chiudiamo
exit;

mysql_close();
header('Location: conferma.html');
} else {
header('Location: Rip_database.php');
}
?>
