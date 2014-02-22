<?php
/*======================================================================+
 File name   : Install.php
 Begin       : 2013-01-09
 Last Update : 2013-01-13

 Description : step 1 to install software

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


echo("<h2><center>Aggiornamento Database</center></h2>");

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");


//Modifica conto economico
$sql = "ALTER TABLE `tb_conto_economico` MODIFY COLUMN valore NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo mysql_error(); 
} else { 
echo "Tabella <b>Conto economico</b> aggiornata<br>"; 
} 

//Modifica fatture
$sql = "ALTER TABLE `tb_fatture` MODIFY COLUMN euro NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>valore Fatture</b> aggiornata<br>"; 
} 

//Modifica fatture
$sql = "ALTER TABLE `tb_fatture` MODIFY COLUMN totale NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>totale fatture</b> aggiornata<br>"; 
} 

//Modifica Prima nota
$sql = "ALTER TABLE `tb_primanota` MODIFY COLUMN entrata NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>entrata prima nota</b> aggiornata<br>"; 
} 
$sql = "ALTER TABLE `tb_primanota` MODIFY COLUMN uscita NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>uscita prima nota</b> aggiornata<br>"; 
} 
$sql = "ALTER TABLE `tb_primanota` MODIFY COLUMN entratab NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>entrata banca prima nota</b> aggiornata<br>"; 
} 
$sql = "ALTER TABLE `tb_primanota` MODIFY COLUMN uscitab NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>uscita banca prima nota</b> aggiornata<br>"; 
} 

//Modifica Ricevute
$sql = "ALTER TABLE `tb_ricevute` MODIFY COLUMN euro NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>ricevute</b> aggiornata<br>"; 
} 

//Modifica Prima nota
$sql = "ALTER TABLE `tb_tot_fatture` MODIFY COLUMN tot_fattura NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>totale fattura</b> aggiornata<br>"; 
} 

//Modifica Stato patrimoniale
$sql = "ALTER TABLE `tb_stato_patrimoniale` MODIFY COLUMN valore NUMERIC(8,2)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>stato patrimoniale</b> aggiornata<br>"; 
} 
$sql = "ALTER TABLE `tb_stato_patrimoniale` MODIFY COLUMN descrizione VARCHAR(125)";

$result = mysql_query($sql); 
if (!$result) { 
echo "Impossibile modificare la tabella<br>"; 
} else { 
echo "Tabella <b>stato patrimoniale</b> aggiornata<br>"; 
} 

//POPOLO LO STATO PATRIMONIALE
$sql = "INSERT INTO `tb_stato_patrimoniale` (`descrizione`, `valore`, `costoricavo`) VALUES
(' QUOTE ASSOCIATIVE ANCORA DA VERSARE', '0', 'attivita'),
('', '', 'attivita'),
('', '0', 'attivita'),
('1 Spese di costituzione:', '0', 'attivita'),
('2 Concessioni,licenze,software:', '0', 'attivita'),
('3 Diritti di utilizzo delle opere di ingegno:', '0', 'attivita'),
('4 Spese manutenzione:', '0', 'attivita'),
('5 Oneri pluriennali:', '0', 'attivita'),
('6 Altre', '0', 'attivita'),
('', '0', 'attivita'),
('1 Terreni e fabbricati:', '0', 'attivita'),
('2 Impianti,macchinari e attrezzature:', '0', 'attivita'),
('3 Mobili arredi:', '0', 'attivita'),
('4 Macchine elettriche ufficio:', '0', 'attivita'),
('5 Altri beni di uso durevole:', '0', 'attivita'),
('', '0', 'attivita'),
('1 Partecipazioni in imprese', '0', 'attivita'),
('2 Crediti immobilizzati', '0', 'attivita'),
('di cui esigibili entro l esercizio successivo', '0', 'attivita'),
('3 Altri titoli', '0', 'attivita'),
('', '', 'attivita'),
('', '0', 'attivita'),
('1 Materie prime, sussidiarie e di consumo', '0', 'attivita'),
('2 Prodotti in corso di lavorazione e semilavorati', '0', 'attivita'),
('3 Lavori in corso su ordinazione', '0', 'attivita'),
('4 Prodotti finiti e merci', '0', 'attivita'),
('5 Acconti', '0', 'attivita'),
('', '0', 'attivita'),
('1 Verso soci', '0', 'attivita'),
('2 Verso Enti per contributi da ricevere -deliberati ma non ancora erogati-', '0', 'attivita'),
('3 Verso altri', '0', 'attivita'),
('', '0', 'attivita'),
('1 Partecipazioni non immobilizate', '0', 'attivita'),
('2 Altri titoli non immobilizati', '0', 'attivita'),
('', '0', 'attivita'),
('1 Depositi bancari e postali', '0', 'attivita'),
('2 Assegni', '0', 'attivita'),
('3 Denaro e valori in cassa', '0', 'attivita'),
(' RATEI E RISCONTI ATTIVI', '', 'attivita'),
('', '', 'passivita'),
(' Fondo di dotazione dell Ente', '0', 'passivita'),
('', '0', 'passivita'),
('1 Riserve statutarie', '0', 'passivita'),
('2 Fondi vincolati per decisione degli organi istituzionali', '0', 'passivita'),
('3 Fondi vincolati destinati da terzi', '0', 'passivita'),
('4 Contributi in conto capitale vincolati dagli organi istituzionali', '0', 'passivita'),
('5 Contributi in conto capitale vincolati da terzi', '0', 'passivita'),
('6 Riserve vincolate', '0', 'passivita'),
('', '0', 'passivita'),
('1 Risultato gestionale dell esercizio in corso', '0', 'passivita'),
('2 Riserve accantonate negli esercizi precedenti', '0', 'passivita'),
('3 Contributi in conto capitale liberamente utilizzabili', '0', 'passivita'),
('4 Lasciti testamenti e donazioni -se beni di utilita  pluriennali-', '0', 'passivita'),
('', '', 'passivita'),
('1 Fondi Per trattamento di quiescienza', '0', 'passivita'),
('2 Altri', '0', 'passivita'),
(' TRATTAMENTO DI FINE RAPPORTO LAVORO SUBORDINATO', '0', 'passivita'),
('', '', 'passivita'),
('1 Debiti verso banche', '0', 'passivita'),
('2 Debiti verso altri finanziatori', '0', 'passivita'),
('3 Acconti', '0', 'passivita'),
('4 Debiti verso fornitori', '0', 'passivita'),
('5 Debiti tributari', '0', 'passivita'),
('6 Debiti verso istituti di previdenza e sicurezza sociale', '0', 'passivita'),
('7 Altri debiti', '0', 'passivita'),
(' RATEI E RISCONTI PASSIVI', '0', 'passivita')";
$result = mysql_query($sql); 
 
// Verifico se la tabella è stata creata oppure no oppure già esiste
if (!$result) { 
echo "Impossibile popolare la tabella oppure la tabella già esiste"; 
} else { 
echo "Predispongo la tabella del stato patrimoniale<br>";
echo "AGGIORNAMENTO DATABASE COMPLETATO";
} 

mysql_close();

include('./botton.inc');

?>
<center><a href='./index.php'>Torna alla home</a></center>