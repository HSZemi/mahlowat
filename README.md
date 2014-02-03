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

Die Thesen werden in der Datei 'includes/theses.php' gespeichert. Dabei werden im Index 'l' die
eigentlichen Thesen als Array hinterlegt, im Index 's' die Kurzformen bzw. Schlagworte, und im Index
'x' die Erklärungen zu den Thesen, falls vorhanden.

Die Listen werden in der Datei 'includes/hsg.php' verwaltet:
* Im Index 'name' landet der Listenname,
* im Index 'name_x' der Name für die Ergebnisanzeige,
* im Index 'answers' als Array die Antworten der Liste (-1 = Ablehnung, 0 = Neutral, 1 = Zustimmung, 'skip' = keine Antwort),
* im Index 'comments' die Begründungen der Listen zu den einzelnen Thesen als Array.

Zur Installation einfach den Ordner mit allen Dateien auf den Webspace hochladen.


Lizenz
------
Dieses Projekt benutzt jQuery. jQuery ist unter der MIT LICENSE lizensiert (LICENSE-jquery.txt)

Dieses Projekt benutzt bootstrap. bootstrap ist unter der MIT LICENSE lizensiert (LICENSE-bootstrap.txt)

Dieses Projekt ('mahlowat') ist unter der MIT LICENSE lizensiert (LICENSE-mahlowat.txt)

Falls ihr euer eigenes Wahlpositionsvergleichswerkzeug auf Basis des Mahlowat bastelt, wäre ein
Hinweis an mahlowat@hszemi.de cool. Dies ist aber explizit keine Vorschrift.
