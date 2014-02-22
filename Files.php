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

<table align='center' border='0' width='80%'>
<tbody>
      <tr><td><center><h2>Moduli e files caricati</h2><hr></center></td><td><center><h2>Immagini caricate</h2><hr></center></td></tr>
      
<?php


function dir_list($directory = FALSE)
{
$dirs= array();
$files = array();
if ($handle = opendir("./" . $directory))
{
while ($file = readdir($handle))
{
if (is_dir("./{$directory}/{$file}"))
{
if ($file != "." & $file != "..") $dirs[] = $file; }
else
{
if ($file != "." & $file != "..") $files[] = $file; }
}
}
closedir($handle);
reset($dirs); sort($dirs); reset($dirs);
reset($files); sort($files); reset($files);

//echo "<strong>Cartelle:</strong>\n<ul>"; while(list($key, $value) = each($dirs))
{
//$d++; echo "<li><a href=\"{$value}\">{$value}/</a>\n"; }
$d++; echo "<a href=\"{$value}\">{$value}</a>\n"; }
echo "</ul>\n"; echo "\n<ul>"; while(list($key, $value) = each($files))
{
$f++; echo "<li><a href=\"{$directory}{$value}\">{$value}</a>\n"; }
echo "</ul>\n";

//if (!$d) $d = "0"; if (!$f) $f = "0"; echo "Sono presenti <strong>{$d}</strong> cartelle e <strong>{$f}</strong> file(s).</strong>\n"; }
if (!$d) $d = "0"; if (!$f) $f = "0"; echo "Sono presenti <strong>{$f}</strong> file(s).</strong>\n"; }

?>
    <tr><td VALIGN="top"> <?php dir_list("./Download/"); ?></td>
    <td VALIGN="top"> <?php dir_list("./Immagini/Utenti/"); ?></td></tr>
  </tbody>
</table>
<?php

include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>

