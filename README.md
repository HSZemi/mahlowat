mahlowat
========

mahlowat ist die Implementierung eines Wahlpositionsvergleichswerkzeugs.

Implementierung
---------------

Reines PHP, alles im Quelltext. Noch.
Benutzt bootstrap by Twitter.

Funktionen
----------

Auswahlmöglichkeiten:
* Zustimmung
* Ablehnung
* Neutral
* Überspringen

Bewertung:
Im Vergleich mit den Hochschulgruppen ergibt sich folgende Bepunktung (noch):
* Gleiche Haltung: +2 Punkte
* Zustimmung vs. Neutral: -1 Punkt
* Ablehnung vs. Neutral: -1 Punkt
* Zustimmung vs. Ablehnung: -2 Punkte
* eigene Meinung, aber keine Angabe bei HSG: -1 Punkt
* Überspringen: 0 Punkte

Durch doppelte Gewichtung einzelner Positionen im 2. Schritt verdoppelt sich die Punktzahl für diese.