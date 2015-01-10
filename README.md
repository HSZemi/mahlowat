mahlowat
========

mahlowat ist die Implementierung eines Wahlpositionsvergleichswerkzeugs.

Implementierung
---------------

Reines PHP, alles im Quelltext.
Benutzt bootstrap by Twitter und jQuery.

Funktionen
----------

Auswahlmöglichkeiten:
* Zustimmung
* Ablehnung
* Neutral
* Überspringen

Bewertung:
Im Vergleich mit den Hochschulgruppen ergibt sich folgende Bepunktung:
* Gleiche Haltung: +2 Punkte
* Zustimmung vs. Neutral: +1 Punkt
* Ablehnung vs. Neutral: +1 Punkt
* Zustimmung vs. Ablehnung: 0 Punkte
* eigene Meinung, aber keine Angabe bei HSG: 0 Punkt
* Überspringen: Frage wird ignoriert

Durch doppelte Gewichtung einzelner Positionen im 2. Schritt verdoppelt sich die Punktzahl für diese.


Installation und Einrichtung
----------------------------

Für die Einrichtung des Mahlowat müssen zwei Dateien angepasst werden: Die, in der die Thesen gespeichert sind, und die, in der die Positionen der Listen hinterlegt werden.
Da es sich dabei um PHP-Dateien handelt, muss darauf geachtet werden, dass hierbei keine Syntaxfehler eingebaut werden (fehlende Kommata, fehlende Klammern etc.).

### Thesen

Die Thesen werden in der Datei 'includes/theses.php' gespeichert. 

Eine These besteht aus 3 Teilen:
* Der Name der These (Index "s"),
* die eigentliche These (Index "l"),
* eine Erläuterung zur These (Index "x").

Beispiel:

```
    Array(
        "s" => 'Thesentitel 1',
        "l" => 'Hier der Text der These 1',
        "x" => 'Ich erläutere These 1, damit eine fundierte Entscheidung getroffen werden kann.'
    ),

```

These 2 hat keine Erläuterung. Deshalb bleibt sie einfach leer.

```
    Array(
        "s" => 'Thesentitel 2',
        "l" => 'Hier der Text der These 3',
        "x" => ''
    ),

```

### Listen


Die zur Wahl antretenden Listen und ihre Antworten werden in der Datei 'includes/hsg.php' gespeichert.

Eine Liste besteht aus 4 Teilen:
* Der Name der Liste (Index "name"),
* der Kurzname der Liste (Index "name_x"),
* ein Array mit den Antworten der Liste zu den Thesen (Index "answers"),
* ein Array mit den Erläuterungen der Liste zu ihren Antworten (Index "comments").

Beispiel:

```
    $hsg_array[0]['name'] = 'Liste X';
    $hsg_array[0]['name_x'] = '<abbr title="Liste X">Liste X</abbr>';
    $hsg_array[0]['answers'] = Array(1,1,-1,'skip',1,-1,'skip',0,1,1);
    $hsg_array[0]['comments'] = Array(
        "Das ist uns sehr wichtig!",
        "Wir sind dagegen.",
        "Wir sind dafür.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben.",
        "Zu dieser These hat Liste X keine Begründung angegeben."
      );
```

Dabei werden die Antworten im entsprechenden Array wie folgt durch Kommas getrennt eingetragen:
* "Zustimmung" entspricht einer 1,
* "Ablehnung" entspricht einer -1,
* "Neutral" entspricht einer 0.
* Falls die Liste keine Antwort abgegeben hat, wird 'skip' notiert.

Das Feature, dass die Listen ihre Antworten selbst eintragen können, ist noch experimentell. 
Die hierfür benutzten Dateien listenabfrage.php und admin/export_hsg.php sollten vor Inbetriebnahme gelöscht werden.

### Installation


Zur Installation wird einfach der Ordner mit allen Dateien auf den Webspace hochgeladen.

Ganz recht, das Ganze funktioniert ohne Datenbankanbindung. Dafür müssen für die Statistik Dateien verändert werden.
Hierzu muss der Prozess des Webservers Schreibrechte für den 'data'-Ordner bekommen. 
Bei Problemen sollte es funktionieren, über den FTP-Client die Ordnerrechte auf '777' zu ändern. 
Hinweis: Dies kann ein Sicherheitsrisiko darstellen, sollte aber nicht.


Lizenz
------
Dieses Projekt benutzt jQuery. jQuery ist unter der MIT LICENSE lizensiert (LICENSE-jquery.txt)

Dieses Projekt benutzt bootstrap. bootstrap ist unter der MIT LICENSE lizensiert (LICENSE-bootstrap.txt)

Dieses Projekt ('mahlowat') ist unter der MIT LICENSE lizensiert (LICENSE-mahlowat.txt)

Falls ihr euer eigenes Wahlpositionsvergleichswerkzeug auf Basis des Mahlowat bastelt, wäre ein
Hinweis an mahlowat@hszemi.de cool. Dies ist aber explizit keine Vorschrift.
