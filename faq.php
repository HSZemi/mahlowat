<?php 
	isset($_GET['from']) ? $back = $_GET['from'] : $back = "index.php";
	if($back != 'index.php' and substr($back, 0, 14) != 'multiplier.php' and substr($back, 0, 15) != 'result-bars.php' and substr($back, 0, 16) != 'result-table.php' and substr($back, 0, 14) != 'mahlowat.php'){
		$back = "index.php";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Mahlowat - FAQ</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/mahlowat-f.js"></script>
  
  <div class="container" style="margin-top: 20px;">
      <img src="img/mahlowat_logo.png" title="Mahlowat Logo" class="pull-right" onclick="changeText()"/>
	<p id="spruch" class="pull-right"></p>
      <div class="bottom-buffer top-buffer">
    
    <h1>FAQ</h1>

    <h4>Wer macht den Mahlowat?</h4>
    <p>Lorem Ipsum.</p>
    
    <h4>Wer hat die Thesen erarbeitet?</h4>
    <p>Lorem Ipsum.</p>
    
    <h4>Wo kommen die Positionen der Gruppen her?</h4>
    <p>Den an der Wahl teilnehmenden Gruppen wurden die Thesen mit der Bitte um Stellungnahme zugeleitet. Neben der reinen Positionierung (Zustimmung/Neutral/Ablehnung/Keine Stellungnahme) konnten sie ihre Position auch in einem kurzen Absatz erläutern.</p>
    <p>Für ihre Stellungnahmen zu den Thesen sind die Gruppen selbst verantwortlich.</p>
    
    <h4>Von welcher Wahl reden wir hier überhaupt?</h4>
    <p>Lorem Ipsum.</p>
    
    <h4>Wer hat das hier programmiert?</h4>
    <p>Der <a href="http://hszemi.de" title="hszemi.de" target="_blank">Sven</a>, weil der das kann.</p>
    
    <h4>Funktioniert das hier wie der "echte" Wahl-O-Mat der bpb?</h4>
    <p>Es wurde versucht, die Punkteberechnung so wie beim "echten" Wahl-O-Mat zu gestalten.</p>
    
    <h4>Wie werden die Punkte berechnet?</h4>
    <p>Die Antworten der Testperson (das bist du) werden mit den vorgegebenen Antworten der Gruppen abgeglichen.</p>
    <ul>
      <li>Stimmt die Antwort überein, werden der Gruppe 2 Punkte gutgeschrieben;</li>
      <li>Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird der Gruppe 1 Punkt gutgeschrieben;</li>
      <li>Sind die Antworten entgegengesetzt oder hat eine Gruppe eine Frage nicht beantwortet, gibt es keine Punkte für die Gruppe.</li>
    </ul>
    <p>Eine Frage, die die Testperson übersprungen hat, wird nicht gewertet. Entsprechend gibt es dann insgesamt weniger Punkte zu erreichen.</p>
    <p>Eine Frage, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl gutgeschrieben (0/2/4). Entsprechend gibt es insgesamt mehr Punkte zu erreichen.</p>
    
    <h4>Ich habe einen Fehler gefunden!</h4>
    <p>Dann solltest du das melden. Wir freuen uns über sachdienliche Hinweise.</p>

    <a class="btn btn-primary" href="<?php echo $back; ?>" title="Zurück zum Mahlowat">Zurück zum Mahlowat</a>
  </div>



  
  </body>
</html>