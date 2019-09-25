![Mahlowat](img/mahlowat_logo.png)

[English Version](README.md)

Mahlowat ist eine Implementierung eines Wahlpositionsvergleichswerkzeugs (voting advice application, VAA).

Mahlowat ermöglicht es, die eigenen Positionen zu Thesen mit den Positionen von Gruppen oder Personen zu vergleichen,
die zu einer Wahl kandidieren.


Allgemeine Vorgehensweise
--------------------------

Irgendwann(TM) in der Zukunft findet eine Wahl statt. Eine Gruppe von Expertinnen(TM) erarbeitet eine Liste simpler Thesen, die sich mit 
Ja oder Nein beantworten lassen.

Sobald feststeht, wer zur Wahl zugelassen ist, werden die Thesen an die zugelassenen Gruppen oder Personen gesendet und darum gebeten,
zu jeder These die eigene Positionierung (Zustimmung/Ablehnung/Neutral) mit jeweils einer kurzen Begründung zurückzusenden.

Ein armer Tropf darf dann alle Antworten in einer Konfigurationsdatei zusammenfassen (siehe unten).

Schließlich wird ein Mahlowat konfiguriert, veröffentlicht und beworben.

Viel Spaß!


Setup
-----

Um eine Mahlowat aufzusetzen sind drei Schritte notwendig:

 - Erstellen einer Konfigurationsdatei, die alle Thesen, Antworten und Begründungen der teilnehmenden Gruppen enthält
 - Festlegen der Sprache und Anpassen der Texte
 - Hochladen der Dateien auf einen Webserver, wo sie alle sehen können :see_no_evil:

### Konfiguration

Mahlowat bezieht seine Informationen aus einer einzigen Konfigurationsdatei, `config/data.json`. Diese Datei enthält die
Thesen, die Namen der antretenden Gruppen sowie deren Positionen und Begründungen.

Zur Erstellung dieser Konfigurationsdatei bietet sich der mitgelieferte Konfigurator (`generator.html`) an. Falls bereits
eine Konfigurationsdatei existiert, werden deren Inhalte direkt geladen. Für Korrekturen oder das Hinzufügen von
Inhalten muss also nicht immer von vorn begonnen werden.

Nach drei Schritten erhält man einen Text, der nur noch in die Konfigurationsdatei `config/data.json` kopiert werden muss. 
Hinweis: Die Datei muss `UTF-8`-kodiert gespeichert werden.

### Sprache

Mahlowat kommt dreisprachig daher: Detusch (de\_de, Standardeinstellung), Englisch (en\_gb) und Französisch (fr\_fr).

Um die Sprache zu ändern, muss die Datei `index.html` angepasst werden.
Ganz unten befindet sich der entsprechende Abschnitt:

```
<!-- Select (uncomment) exactly one of the following languages-->
<script src="lang/de_de.js"></script>
<!-- <script src="lang/en_gb.js"></script> -->
<!-- <script src="lang/fr_fr.js"></script> -->
<!-- end languages-->
```

Um die aktive Sprache zu ändern, wird die aktuell aktive Sprache auskommentiert (mit `<!--` und `-->` umschlossen) und die Kommentar-Marker
um die gewünschte Sprache werden entfernt (also die `<!--` und `-->` werden gelöscht, nicht aber das dazwischen).
Beispiel: Um die Sprache auf Französisch zu stellen, sollte das Ergebnis folgendermaßen aussehen:

```
<!-- Select (uncomment) exactly one of the following languages-->
<!-- <script src="lang/de_de.js"></script> -->
<!-- <script src="lang/en_gb.js"></script> -->
<script src="lang/fr_fr.js"></script>
<!-- end languages-->
```

Außerdem können die Texte modifiziert werden. Dies ist wahrscheinlich vor allem beim Fragen-und-Antworten-Teil nötig.

Texte werden direkt in den `*.js`-Dateien angepasst. Diese befinden sich im `lang`-Unterordner.

In den Strings können HTML-Tags verwendet werden. Es sollte darauf geachtet werden, keine Syntaxfehler im JavaScript-Code einzubauen, 
da diese leider die gesamte Anwendung dysfunktional machen. Frag bei Problemen einen Erwachsenen oder eine Freundin um Hilfe.

**Obacht!** Um Internet Explorer 11 zu unterstützen (hihi), wurden die Sprachdateien mit [babel](https://babeljs.io)
nachbehandelt. Für jede Sprache existiert eine Ausgangsversion (z. B. `de_de.raw.js`) und die mit Babel behandelte Version
(z. B. `de_de.js`). Um Texte zu ändern, können die Ausgangsversionen modifiziert und hernach erneut babel ausgeführt werden. 
Alternativ können die übersetzten Dateien auch direkt modifiziert werden.

```
npm install --save-dev @babel/core @babel/cli @babel/preset-env @babel/node
babel --presets @babel/preset-env lang/de_de.raw.js > lang/de_de.js
babel --presets @babel/preset-env lang/en_gb.raw.js > lang/en_gb.js
babel --presets @babel/preset-env lang/fr_fr.raw.js > lang/fr_fr.js
```

#### Mehrsprachigkeit

Gegebenenfalls soll der Mahlowat in mehreren Sprachen angeboten werden, zum Beispiel auf Französisch und Deutsch.

Es empfiehlt sich, hierfür mehrere Instanzen zu erzeugen. Die Gruppen oder Kandidierenden würden also die Thesen jeweils auf Deutsch und auf 
Französisch erhalten und nach Positionierungen und Begründungen in beiden Sprachen gefragt werden. Dann würden zwei getrennte Mahlowat-Versionen
erzeugt, eine auf Französisch mit den französischsprachigen Inhalten unter https://example.com/fr, und eine auf Deutsch mit den deutschsprachigen
Inhalten unter https://example.com/de. Man könnte sich dazu eine Startseite vorstellen, die auf die beiden Mahlowat-Instanzen verlinkt.

### Veröffentlichung

Die Ordner `config`, `css`, `img`, `js`, und `lang` mit ihrem Inhalt sowie die Datei `index.html` werden in einen Ordner auf dem Webserver des
Vertrauens hochgeladen.

Fertig!


Punkteberechnung
----------------

The points for the groups in the results at the end are calculated as follows: 
Die Punkte für die Gruppen im Endresultat werden wie folgt berechnet:

 - Die gegebenen Antworten werden mit denen jeder Gruppe verglichen
 - Stimmt die Antwort einer Gruppe mit der gegebenen überein, werden der Gruppe 2 Punkte gutgeschrieben.
 - Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird der Gruppe 1 Punkt gutgeschrieben
 - Sind die Antworten entgegengesetzt oder hat eine Gruppe eine These nicht beantwortet, gibt es keine Punkte für die Gruppe.
 - Eine These, die übersprungen wurde, wird nicht gewertet. Die erreichbare Höchstpunktzahl wird dadurch geringer.
 - Eine These, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl
   gutgeschrieben (0/2/4). Dadurch können insgesamt mehr Punkte erreicht werden.


Demo
----

[Deutsch :de:](https://hscmi.de/mahlowat/de/) [English :uk:](https://hscmi.de/mahlowat/en/) [Français :fr:](https://hscmi.de/mahlowat/fr/)


Fehlerbehandlung
----------------

#### Klicken auf den Start!-Knopf führt zu keiner Reaktion

Die Konfigurationsdatei konnte wohl nicht geladen werden. Stelle sicher, dass sie existiert, vom Webserver gelesen werden kann
(das kann z.B. durch direkten Aufruf der Datei https://example.com/config/data.json mit dem Webbroeser überprüft werden) und 
syntaktisch korrekt ist.


#### Die Startseite sieht komisch aus und überall stehen seltsame Dinge wie btn-start oder start-explanatory-text. Außerdem funktioniert nichts.

Sieht so aus als ob der JavaScript-Teil defekt ist. Ist genau eine Sprachdatei (siehe oben) eingebunden? Sie könnte auch einen Syntaxfehler enthalten.


#### Das Ergebnis ist leer

Man sollte schon mindestens eine These beantworten.


#### Ich öffne den mahlowat aber nichts funktioniert, da ist nur eine rote Warnung!

Die häufigste Ursache hierfür ist, dass die `index.html`-Datei direkt mit den Webbrowser geöffnet wurde. Leider funktioniert dies in den
meisten Browsern nicht. Alle Dateien müssen auf einen Webserver geladen und von dort angezeigt werden. Du kannst auch lokal einen Webserver
zum Testen starten.

Wenn die Dateien hingegen bereits auf einem Webserver liegen und dennoch die Fehlermeldung auftaucht, dann lies sie: Existiert die Datei?
Lässt sich sich mit dem Webbrowser direkt aufrufen oder kommt eine Fehlermeldung? Und nicht zuletzt, enthält sie keine Syntaxfehler?


Freud und Leid
------------

#### Ich möchte einen Fehler melden

Klasse!  [Erstelle ein Issue](https://github.com/HSZemi/mahlowat/issues) (und hoffe, dass es bemerkt wird).


#### Ich möchte einen Fehler beheben

Knorke!  [Stelle einen Pull Request](https://github.com/HSZemi/mahlowat/pulls) (und hoffe, dass er bemerkt wird).

#### Ich möchte mich beschweren/bedanken

Ich freue mich stets über eine E-Mail an mahlowat@hszemi.de!
