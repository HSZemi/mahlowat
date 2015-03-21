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
Im Vergleich mit den Listen ergibt sich folgende Bepunktung:
* Gleiche Haltung: +2 Punkte
* Zustimmung vs. Neutral: +1 Punkt
* Ablehnung vs. Neutral: +1 Punkt
* Zustimmung vs. Ablehnung: 0 Punkte
* eigene Meinung, aber keine Angabe bei Liste: 0 Punkte
* Überspringen: Frage wird ignoriert

Durch doppelte Gewichtung einzelner Positionen im 2. Schritt verdoppelt sich die Punktzahl für diese.


Installation und Einrichtung
----------------------------

Vor dem Start müssen eingetragen werden:
* Die zur Wahl antretenden Listen,
* die Thesen,
* die Bewertung und Statements der Listen zu den Thesen.

Für die Einrichtung des Mahlowat steht die Datei `generator.html` zur Verfügung. Sie wird einfach mit einem Webbrowser aufgerufen. Dort lässt sich die gesamte Konfiguration erstellen, die dann in einer .json-Datei (`config/data.json`) gespeichert wird. Wichtig: Die Datei muss UTF-8-kodiert sein.

Existiert diese .json-Datei bereits, werden ihre Inhalte beim Start in den Konfigurator geladen.



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
