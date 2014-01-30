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

Lizenz
------
Dieses Projekt benutzt jQuery. jQuery ist unter der MIT LICENSE lizensiert (LICENSE-jquery.txt)
Dieses Projekt benutzt bootstrap. bootstrap ist unter der MIT LICENSE lizensiert (LICENSE-bootstrap.txt)

Dieses Projekt ('mahlowat') ist unter der MIT LICENSE lizensiert (LICENSE-mahlowat.txt)
Falls ihr euer eigenes Wahlpositionsvergleichswerkzeug auf Basis des Mahlowat bastelt, wäre ein
Hinweis an mahlowat@hszemi.de cool, ist aber explizit kein Muss.