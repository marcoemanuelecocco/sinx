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
include('./top.inc');
include('./menu.inc');
?>
<br>
<table cellspacing="1" cellpadding="1" border="0" width="80%">
    <tbody>
        <tr>
            <td></td>
            <td><span style="font-weight: bold; color: rgb(255, 153, 0);">&nbsp;<span style="color: rgb(51, 102, 255);">Contabilit&agrave: Manuale di Sinx</span></span><br/><hr>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><h4> Prima Nota</h4>
            </td>

            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="vertical-align: top;"/>
            <td style="vertical-align: top;"><font size="2">La pagina per l'inserimento della Prima Nota si presenta con il seguente ordine:<br>La prima sezione riguarda la cancellazione della singola nota; per cancellare una voce si inserisce il numero id della nota e si preme -Cancella-.<br>Il calcolo della Prima Nota viene rifatto automaticamente.<br><br>La seconda sezione riguarda la modifica di una singola voce della Prima Nota; &egrave possibile modificare sia la descrizione che il valore.<br>Per modificare una voce, si indica in numero id della voce da modificare; nella casella "Campo" si indica quale voce modificare (Data, descrizione, dare o avere); nella casella "Nuovo Record" si scrive la nuova voce.<br><br>La terza sezione riguarda l'inserimento di una nuova voce, la data &egrave inserita automaticamente la casella "Operazione" indica la descrizione della voce; si inserisce il valore di dare oppure avere; la casella non interessata si lascia vuota.<br><br>In fondo alla pagina c'&egrave indicata la lista completa della prima nota in ordine di data e il calcolo automatico dei totali con il disavanzo.<br><br><b>Stampa e salvataggio prima nota</b><br>Per stampare la prima nota, &egrave presente un link all'inizio della pagina stessa che rimanda ad una pagina compilata con l'intestazione dell'Associazione e la tabella completa della Prima nota.<br>Nello stesso modo &grave possibile fare il salvataggio dell file in formato pdf indicando invece della stampante la voce: "Stampa su file" ed indicando il nome ed il percorso del file.<br><br>

<h4>Quietanza</h4>
La schermata delle ricevute fiscali si presenta nello stesso stile di tutto il software, con le funzioni impostate nel seguente ordine: Stampa, cancella, modifica, insersci, visualizzazione.<br>tutte le modifiche si basano sull'id della ricevuta; per stampare si inserisce l'id nell'apposita casella, il software intesta e orsina la ricevuta dopodich&egrave basta lanciare il comando di stampa dal men&ugrave del browser.<br><br>Stesso principio anche per il comando 'Cancella', mentr per effettuare la modifica di una ricevuta, oltre ad inserire l'id, &egrave necessario specificare quale campo si vuole modificare ed inserire la nuova voce, tutto nelle specifiche caselle.<br><br>Per inserire una nuova ricevuta, la data viene inserita automaticamente, il nome viene preso dal database dell'anagrafica, quindi &egrave indispensabile che il nominativo venga prima inserito nella sezione delle anagrafiche di Sinx.<br>Infine, si inserisce il valore ricevuto nella casella 'Euro' e la causale.<br>Nel momento in cui si registra la prima nota, viene aggiunta in automatico una voce nella prima nota nella sezione di "entrata cassa" e ricalcolati i totali.<br>Lo stesso vale nel caso in cui si modifica o cancella una ricevuta.<br><br>

<h4>Fatturazione</h4>
La voce Fattura permette di creare e gestire le fatture dell'Associazione.<br>La schermata principale riprende la medesima impostazione delle altre schermate con una visualizzazione a scendere che inizia con la Stampa delle fatture effettuate.<br><br>
<b>Stampa Fatture</b><br>
In Stampa Fatture effettuate &egrave sufficente inserire il numero della fattura da stampare utilizzando la casella combinata e premere sul pulsante "Stampa Fattura".<br>In automatico, la fattura viene preimpostata con la carta intestata dell'Associazione.<br><br>
<b>Registra Incasso Fattura</b><br>
La voce <b>Registra incasso Fattura</b> &egrave impostata in modo che, nel momento in cui l'associazione incassa effettivamente quanto gli spetta secondo una fattura emessa, l'incasso viene registrato in prima nota.<bR>I passaggi sono i seguenti:
<li>Si specifica il numero di fattura incassata utilizzando la casella combinata</li>
<li>Si specifica se l'incasso va in cassa (soldi contanti, assegno ecc.) oppure direttamente in banca (bonifico, transizione elettronica ecc.)</li>
<li>Infine si preme il pulsante "Registra Incasso"</li><br>
Automaticamente il totale della fattura viene registrato come incasso in primanota e vengono ricalcolati i totali della stessa.<br><br>
<b>Compilazione Fattura</b><br>
Per la compilazione della fattura, si procede in questo modo:
<li>Nella casella di testo, si inserisce il numero della fattura</li>
<li>In seguito nella casella combinata si specifica il cliente tenendo presente che il cliente deve essere precedentemente registrato nella sezione dell'anagrafe altrimenti non viene inserito in lista</li>
<li>Si compilano i campi sottostanti formati da descrizione, quantit&agrave, Prezzo unitario e iva in percentuale e <b>senza inserire il simbolo %</b></li>
Fatto questo, si preme il pulsante "Registra Fattura" per la registrazione</li><br>
Nel caso si abbia la necessit&agrave di inserire più voci nella stessa fattura, &egrave sufficente ripetere l'operazione facendo attenzione ad inserire lo stesso numero di fattura e lo stesso cliente.<br>In questo modo, le voci vengono accodate ed i totali ricalcolati in automatico.<br><br>
<b>Visualizzazione Fatture</b>
In questa sezione &egrave possibile visualizzare la fattura completa con i dati inseriti ed i totali.<bR>
Si specifica quale fattura si vuole visualizzare utilizzando la casella combinata e si preme il pulsante "Visualizza Fattura"<br><br>
Infine, in fondo alla pagina, &egrave possibile visualizzare un listato delle fatture effettuate.<br><br>

<h4>Conto economico e stato patrimoniale</h4>
Come per tutte le voci viste fin'ora, anche la pagina del conto economico &egrave formata dalle funzioni di stampa, azzeramento, cancellazione voce e modifica della singola voce.<br>Essendo queste uguali alle precedenti, non verranno ulteriormente spiegate.<br><br>
L'inserimento di una nuova voce del conto economico permette di inserire gi&agrave un valore di base; se il valore &egrave nullo, la voce &egrave comunque richiesta, non pu&ograve essere vuota; in questo caso si inserisce il valore 0.<br>Una nota molto importante da segnalare &egrave il fatto che, nel momento in cui si inserisce una voce in prima nota o si emette fattura o ricevuta, l'importo si carica automaticamente anche nella voce assegnata del conto economico; &egrave implicito quindi, sottolineare che all'inizio dell'uso del gestionale &egrave consigliabile inserire le voci principali del conto economico anche se a valore zero, in modo da poter gi&agrave operare in contabilit&agrave.<br><br>Nell'ordinamento italiano, lo stato patrimoniale &egrave uno dei documenti che, ai sensi dell'art. 2423 c.c. comma 1 del codice civile, compongono il bilancio d'esercizio.<br><br> 
Il modulo "Stato Patrimoniale", al contrario del conto economico, non &egrave collegato alla contabilit&agrave per cui le voci vengono inserite direttamente, non sono influite e non influiscono gli altri moduli.<br>
Nella pagina dello stato patrimoniale, si trova sempre la classica struttura di Sinx per stampare, modificare, inserire e visualizzare le proprie voci
Lo Stato patrimoniale &egrave a sezioni contrapposte, a sinistra vi &egrave l'attivo e a destra il passivo.<br>Lo schema segue quello previsto dall'articolo 2424 per le societ&agrave per azioni che, per effetto del richiamo di cui all'art. 2217 si applica alla generalit&agrave delle imprese.<br><br>

<h4>Rendiconto annuale</h4>
La L.266/91 (art.3 comma 3) stabilisce che nell'atto costitutivo o nello statuto delle Organizzazioni di volontariato devono essere previsti:
<li>l'obbligo di formazione del bilancio;</li>
<li>le modalità di approvazione dello stesso da parte dell'Assemblea degli aderenti.</li><br>

La norma non indica schemi precostituiti ma si limita a richiedere che dal bilancio risultino i beni, i contributi o i lasciti ricevuti.<br>
Tale documento, oltre ad essere obbligatorio per legge, risponde all'esigenza di trasparenza e di pubblicit&agrave nei confronti di tutti i soggetti che vengono a vario titolo in contatto con l'organizzazione, &egrave il principale strumento per dimostrare l'attivit&agarve svolta ed &egrave necessario perche l'organizzazione possa mantenere la qualifica di Ente non commerciale e godere delle agevolazioni fiscali previste.<br>
Il rendiconto secondo la L.266/91 comporta alcune differenze tra ODS e APS, Sinx &egrave predisposto per entrambi da selezionare tramite pulsanti ed in pi&ugrave crea una precompilazione dei conti; all'utente non resta che completare il resto del modulo salvarlo e/o stamparlo.<br><br>

<h4>Nuovo anno sociale</h4>
Utilizzando questa funzione del men&ugrave contabilit&agrave, si ottiene un report della contabilit&agrave completo e pronto per essere salvato/stampato.<br>E' possibile, quindi, visualizzare in ogni momento l'andamento economico completo e, al termine dell'anno associativo o solare, a seconda di come viene gestita la contabilit&agrave, decidere di azzerare i conti per il nuovo anno.<br>Nel caso si avvii un nuovo anno, bisogna ricordarsi di registrare inizialmente le rimanenze per dare la continut&agrave contabile corretta.

</td>

        </tr>
    </tbody>
</table>
            <td valign="top"><br>
		<a href="./ManAnagrafica.php"><img src="./ImmTemplate/flecheg.gif" border='0'></a>
		<a href="./Manuale.php"><small>Indice</small></a>
		<a href="./ManModulistica.php"><img src="./ImmTemplate/fleched.gif" border='0'></a><br>

	    </td>
<?php
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
