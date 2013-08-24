<?php isset($_GET['from']) ? $back = $_GET['from'] : $back = "index.php";?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>mahlowat - FAQ</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta content="">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  
  <script src="js/jquery-2.0.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <div class="container top-buffer bottom-buffer">
    
    <h1>FAQ</h1>

    <h4>Wer macht den Mahlowat?</h4>
    <p>Die akut, weil das Studierendenparlament das mal so beschlossen hat.</p>
    
    <h4>Wer hat die Thesen erarbeitet?</h4>
    <p><del>Eine Arbeitsgruppe aus fähigen akut-Redaktionsmitgliedern und weiteren Freiwilligen.</del></p>
    <p>Der Sven, weil's nur Platzhalter sind.</p>
    
    <h4>Wo kommen die Positionen der Hochschulgruppen her?</h4>
    <p><del>Den an der Wahl teilnehmenden Hochschulgruppen wurden die Thesen mit der Bitte um Stellungnahme zugeleitet. Neben der reinen Positionierung (Zustimmung/Neutral/Ablehnung/Keine Stellungnahme) konnten sie ihre Position auch in einem kurzen Absatz erläutern.</del></p>
    <p>Auch die hat der Sven ausgewürfelt, weil er Platzhalter brauchte.</p>
    
    <h4>Von welcher Wahl reden wir hier überhaupt?</h4>
    <p>Wir reden hier von der kombinierten Wahl zum XXXVI. Studierendenparlament der Rheinischen Friedrich-Wilhelms-Universität Bonn und den Gremien ebendieser Universität, also Fakultätsräte, Senat und (nur für die Damen) Beirat der Gleichstellungsbeauftragten.</p>
    <p>Die Seite des Wahlausschusses für die SP-Wahl mit vielen Informationen findest du <a href="http://www.wahlen.uni-bonn.de" title="Wahlausschuss zur Wahl des 36. Studierendenparlaments">hier</a>.</p>
    
    <h4>Wer hat das hier programmiert?</h4>
    <p>Der Sven, weil der das kann.</p>
    
    <h4>Funktioniert das hier wie der "echte" Wahl-O-Mat der bpb?</h4>
    <p>Der Sven hat sich Mühe gegeben, die Punkteberechnung so wie beim "echten" Wahl-O-Mat zu gestalten.</p>
    
    <h4>Wie werden die Punkte berechnet?</h4>
    <p>Die Antworten der Testperson (das bist du) werden mit den vorgegebenen Antworten der Hochschulgruppen abgeglichen.</p>
    <ul>
      <li>Stimmt die Antwort überein, werden der Hochschulgruppe 2 Punkte gutgeschrieben;</li>
      <li>Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird der Hochschulgruppe 1 Punkt gutgeschrieben;</li>
      <li>Sind die Antworten entgegengesetzt oder hat eine Hochschulgruppe eine Frage nicht beantwortet, gibt es keine Punkte für die Hochschulgruppe.</li>
    </ul>
    <p>Eine Frage, die die Testperson übersprungen hat, wird nicht gewertet. Entsprechend gibt es dann insgesamt weniger Punkte zu erreichen.</p>
    <p>Eine Frage, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl gutgeschrieben (0/2/4). Entsprechend gibt es insgesamt mehr Punkte zu erreichen.</p>
    
    <h4>Ich habe einen Fehler gefunden!</h4>
    <p>Dann solltest du das <a href="http://www.akut-bonn.de/kontakt/" title="Kontakt zur akut">melden</a>. Wir freuen uns über sachdienliche Hinweise.</p>

    <a class="btn btn-primary" href="<?php echo $back; ?>" title="Zurück zum Mahlowat">Zurück zum Mahlowat</a>
  </div>



  
  </body>
</html>