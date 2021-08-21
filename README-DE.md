![Vote-O-Mat](img/internal/Vote-O-Mat_Logo.svg)

[English Version](README.md)

Vote-O-Mat ist eine funktionsreichere Version des Wahlpositionsvergleichswerkzeugs [mahlowat](https://github.com/HSZemi/mahlowat). Beide ermöglichen es den Benutzenden, ihre Meinung zu ausgewählten Thesen mit den Meinungen von Gruppen oder Einzelpersonen zu vergleichen, die an einer Wahl teilnehmen.

Vote-O-Mat macht es einfacher *mahlowat* in mehreren Sprachen anzubieten, das Aussehen an eine Marke("Branding") anzupassen und kann anonyme Nutzungsstatistiken anbieten ([siehe Infos zum Datenschutz](#privacy)). Wenn du keine dieser Funktionen benötigen, bist du mit [mahlowat](https://github.com/HSZemi/mahlowat) wahrscheinlich besser beraten.

# Allgemeine Vorgehensweise

Irgendwann in der Zukunft wird es eine Wahl geben. Ein Team von hochqualifizierten Personen erstellt eine Liste von einfachen Thesen, die mit Ja oder Nein beantwortet werden können.

Sobald die an der Wahl teilnehmenden Gruppen oder Kandidierenden feststehen, werden ihnen die Thesen zugeschickt und sie gebeten, eine Positionierung (Ja/Nein/Neutral) und ein kurzes Statement zu jeder These abzugeben.

Eine Person richtet die Basis des Vote-O-Maten ein.

Einige arme Seelen werden dann alle Antworten in einer Konfigurationsdatei für jede Sprache zusammenstellen.

Anschließend muss der Vote-O-Mat nur noch beworben werden.

Viel Spaß!

# <a name="GettingStarted"></a>Getting Started

Daraus besteht ein Vote-O-Mat:

- **Vote-O-Mat** selbst, der eine Übersichtsseite ("Landing Page") mit allen verfügbaren Sprachen bereitstellt
- Eine oder mehrere **Vote-O-Mat-Instanzen** (`vom-instance`), eine Instanz für jede verfügbare Sprache
- Ein **Statistikmodul** (`vom-statistics`), das für die Erstellung und Anzeige der anonymen Nutzungsstatistiken zuständig ist

Um den Vote-O-Mat zum Laufen zu bringen, sind diese drei Schritte notwendig:

- Alle Dateien auf einen Webserver hochladen.
- Eine allgemeine *Setup-Datei* erstellen, die Einstellungen für das Branding, Informationen über die verfügbaren Vote-O-Mat-Sprachen und Statistik-Konfigurationen enthält.
- Eine Vote-O-Mat-Instanz für jede Sprache erstellen.

Für späteren Durchblick: Übersicht über das Verzeichnis des Vote-O-Maten (in Auszügen):

```
vote-o-mat                      # Wurzelverzeichnis des Vote-O-Maten
|--- config
|    |--- setup.json            # Setup-Datei mit den Vote-O-Mat-Einstellungen
|--- vom-instance               # Vorlage für Vote-O-Mat-Instanzen
|    |--- config
|    |    |--- data.json        # Konfigurations-Datei für die jeweilige Vote-O-Mat-Instanz
|    |--- generator.html        # Konfigurations-Tool für config/data.json
|    |--- index.html            # Webseite der Vote-O-Mat-Instanz
|--- vom-statistics
|    |--- hits.log              # Log-Datei mit allen Statistik-Daten
|    |--- index.html            # Webseite, die die Statistiken anzeigt
|--- index.html                 # Übersichtsseite über alle verfügbaren Vote-O-Mat-Sprachen
|--- setup.html                 # Setup-Tool für config/setup.json
```

## Installation

Laden Sie den Vote-O-Maten in ein Verzeichnis Ihrer Wahl herunter, indem Sie den grünen "Code"-Button in der oberen rechten Ecke der GitHub-Website verwenden.

## <a name="upload"></a>Upload

Laden Sie den *Inhalt des Wurzelverzeichnisses `vote-o-mat`* (nicht den Ordner `vote-o-mat` selbst) auf einen Webserver hoch.

Für diese Anleitung gehen wir davon aus, dass der Webserver unter `https://example.com` erreichbar ist.

 **Hinweis:** Der Vote-O-Mat ist normalerweise für alle sichtbar, sobald die Dateien hochgeladen sind. Wenn das keine Option ist, arbeite zuerst *Grundlegende Einrichtung* und *Instanzen Erstellen* durch. Diese Reihenfolge kann allerdings den Einrichtungsprozess verkomplizieren.

## Allgemeine Einrichtung

So richtest du die Basis des Vote-O-Maten ein:

- Öffne das Setup-Tool `setup.html` im Wurzelverzeichnis.
    - Öffne dazu die URL `https://example.com/setup.html` im Browser (solltest du die Dateien bereits hochgeladen haben).
- Gehe durch den Einrichtungsprozess.
    - Während der Einrichtung must du die Links zu den einzelnen Vote-O-Mat-Instanzen eingeben. Wenn du diese noch nicht kennst, lass die Felder vorerst leer. Nachdem alles andere eingerichtet wurde kannst du sie immer noch nachtragen.
    - Du kannst hier auch die Statistiken für den Vote-O-Maten aktivieren. [Erfahre mehr über Statistiken](#statistics)
- Das Setup-Tool erzeugt am Ende einen kryptischen Text.
- Kopiere diesen Text in die Datei `config/setup.json`.
    - Wenn die Datei nicht im Verzeichnis `config` existiert, erstelle sie einfach. Stelle sicher, dass die Datei in `UTF-8`-Kodierung gespeichert wird.

Wenn du später Änderungen an `config/setup.json` vornehmen musst, öffne einfach wieder `setup.html`. Es lädt alle Daten aus einer bestehenden `config/setup.json`, so dass du nicht bei Null anfangen musst.

***Hinweis**: Wenn die `config/setup.json` nicht geladen werden kann, z.B. weil du die Einrichtung vornimmst, bevor die Dateien hochgeladen wurden, wird das Setup-Tool als Notlösung ein Textfeld auf der ersten Seite anbieten. Kopiere hier den Inhalt einer vorhandenen `config/setup.json` manuell hinein, um Änderungen an der bisherigen Datei vorzunehmen.*

## Instanzen Erstellen

Du musst für jede Sprache eine eigene Vote-O-Mat-Instanz erstellen. Das kann recht langwierig sein. Vielleicht willst du das gemeinsam mit anderen Leuten machen. Jede Person konfiguriert dann eine andere Instanz.

- Im Wurzelverzeichnis: Erstelle so viele Vote-O-Mat-Instanzen, wie du benötigst.
    - Kopiere dazu die Vorlage `vom-instance` (du kannst auch die Vorlage selbst als Instanz verwenden).
- Wiederhole folgende Schritte für jede Instanz:
    - Benenne den Ordner der Instanz (nicht das Wurzelverzeichnis) entsprechend der angedachten Sprache um.
        - Beispiel: Benenne den Ordner in `de` um, wenn er die deutsche Vote-O-Mat-Instanz enthält.
    - Öffne das Konfigurations-Tool `generator.html` (das sich im Verzeichnis der Instanz befindet).
    - Gehe durch den Konfigurationsprozess.
        - Du musst alle Thesen, wählbaren Gruppen oder Kandidaten und ihre Antworten hinzufügen.
        - Lege auch die Sprache der Vote-O-Mat-Instanz fest. Wenn die Dateien bisher nicht hochgeladen wurden, ist keine Sprache verfügbar. Überspringe diesen Schritt vorerst.
    - Kopiere und speichere den vom Konfigurationstool erstellten Text in die Datei `config/data.json` (die sich im Verzeichnis der Instanz befindet).
        - Erstellen Sie die Datei, falls sie noch nicht existiert. Speichern Sie sie mit der Kodierung `UTF-8`. Sie wissen, wie es geht.
    - Lege die Anzeigesprache fest (z.B. für die Beschriftung der Buttons). [Erfahre, wie das geht](#DisplayLanguage)

Es ist sicher schon klar, aber der Vollständigkeit halber: Wie das Setup-Tool lädt auch das Konfigurations-Tool bestehende `config/data.json`-Dateien, sodass du einfach Änderungen an der Datei vornehmen kannst. Wenn das Laden nicht möglich ist, zeigt das Tool wieder ... ein Textfeld? Nein, **zwei** Textfelder! Eines für die Eingabe von `../config/setup.json` (aus der `config` im Wurzelverzeichnis) und eines für die `config/data.json` der Instanz.

## Feinschliff

Herzlichen Glückwunsch, du hast den allergrößten Teil des Einrichtungsprozesses hinter dir :)

Wenn du die Dateien noch nicht [hochgeladen](#upload) haben solltest, mach das jetzt.

Solltest du noch nicht die Links zu den Vote-O-Mat-Instanzen gesetzt haben, ist das jetzt der perfekte Moment, um das zu tun:

- Öffne die Datei `setup.html` im Wurzelverzeichnis (über den Browser).
- Gebe die Links zu den Vote-O-Mat-Instanzen ein.
    - Angenommen, die Instanzen wurden beim Erstellen `de` und `en` genannt. Die Links sind dann `https://example.com/de` und `https://example.com/en`.
- Speicher den Setup-Text erneut in `config/setup.json` (im Wurzelverzeichnis).

Wenn du die Vote-O-Mat-Instanzen noch nicht eingestellt haben solltest (z.B. weil Sie die Dateien noch nicht hochgeladen haben), wäre das jetzt *die* Gelegenheit:  
Wiederhole für jede Instanz:

- Öffne `generator.html` (im Verzeichnis der Instanz).
- Gehen zu den Spracheinstellungen.
- Wähle die entsprechende Sprache aus.
- Speichere den Konfigurations-Text erneut in `config/data.json` (im Verzeichnis der Instanz).

Behalte nun ausschließlich die Dateien und Ordner auf dem Webserver, die im Folgenden aufgeführt sind.  
Löschen alle anderen Dateien.

- Die Ordner `config`, `css`, `img`, `js`, und `lang` (und deren Inhalt)
- Die Datei `index.html` (im Wurzelverzeichnis)
- Die Ordner aller Vote-O-Mat-Instanzen (und deren Inhalt)
- *Wenn Statistiken aktiviert sind:* der Ordner `vom-statistics` und seinen Inhalt

Fertig!

## Zugriff

Angenommen, die Vote-O-Mat Dateien wurden auf `https://example.com` hochgeladen und es zwei Instanzen mit den Namen `de` und `en` erstellt.

Die Übersichtsseite mit allen verfügbaren Sprachen kannst du über `https://example.com` aufrufen.

Die einzelnen Vote-O-Mat-Instanzen sind unter `https://example.com/de` und `https://example.com/en` (oder über die Übersichtsseite) zugänglich.

Das Statistik-Dashboard kann unter `https://example.com/vom-statistics` geöffnet werden. [Lerne wie man diesen Link anpasst](#StatisticsDashboard).

# Punkteberechnungen

Die Punkte für die Gruppen im Endresultat werden wie folgt berechnet:

- Die gegebenen Antworten werden mit denen jeder Gruppe verglichen.
- Stimmt die Antwort einer Gruppe mit der gegebenen überein, werden der Gruppe 2 Punkte gutgeschrieben.
- Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird der Gruppe 1 Punkt gutgeschrieben.
- Sind die Antworten entgegengesetzt oder hat eine Gruppe eine These nicht beantwortet, gibt es keine Punkte für die Gruppe.
- Eine These, die übersprungen wurde, wird nicht gewertet. Die erreichbare Höchstpunktzahl wird dadurch geringer.
- Eine These, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl gutgeschrieben (0/2/4). Dadurch können insgesamt mehr Punkte erreicht werden.

# Details für Nerds

## <a name="DisplayLanguage"></a>Anzeigesprache einstellen

Der Vote-O-Mat kommt in drei Sprachen: deutsch (de\_de, Standard), Englisch (en\_gb) und Französisch (fr\_fr).

Wenn du die Anzeigesprache eienr Vote-O-Mat-Instanz anpassen willst, musst du lediglich eine winzige Änderung am der `index.html` vornehmen. Gehe in dieser Datei ganz ans Ende. Dort findest du folgende Abschnitt vor:

```
<!-- Select (uncomment) exactly one of the following languages-->
<script src="../lang/de_de.js"></script>
<!-- <script src="../lang/en_gb.js"></script> -->
<!-- <script src="../lang/fr_fr.js"></script> -->
<!-- end languages-->
```

Um die aktive Anzeigesprache zu ändern, wird die aktuell aktive Sprache auskommentiert (mit `<!--` und `-->` umschlossen) und die Kommentar-Marker um die gewünschte Sprache werden entfernt (also die `<!--` und `-->` werden gelöscht, nicht aber das dazwischen).

Beispiel: Um den Vote-O-Mat auf Französisch zu stellen, sollte das Ergebnis folgendermaßen aussehen:

```
<!-- Select (uncomment) exactly one of the following languages-->
<!-- <script src="../lang/de_de.js"></script> -->
<!-- <script src="../lang/en_gb.js"></script> -->
<script src="../lang/fr_fr.js"></script>
<!-- end languages-->
```

Außerdem können die Texte modifiziert werden. Dies ist wahrscheinlich vor allem beim Fragen-und-Antworten-Teil nötig.

Texte werden direkt in den `*.js`-Dateien angepasst. Diese befinden sich im `lang`-Unterordner.

In den Strings können HTML-Tags verwendet werden. Es sollte darauf geachtet werden, keine Syntaxfehler im JavaScript-Code einzubauen, da diese leider die gesamte Anwendung dysfunktional machen. Frag bei Problemen vielleicht mal befreundete IT-Nerds um Hilfe.

**Obacht!** Um Internet Explorer 11 zu unterstützen (hihi), wurden die Sprachdateien mit [babel](https://babeljs.io) nachbehandelt. Für jede Sprache existiert eine Ausgangsversion (z. B. `de_de.raw.js`) und die mit Babel behandelte Version (z. B. `de_de.js`). Um Texte zu ändern, können die Ausgangsversionen modifiziert und hernach erneut babel ausgeführt werden. Alternativ können die übersetzten Dateien auch direkt modifiziert werden.

```
npm install --save-dev @babel/core @babel/cli @babel/preset-env @babel/node
babel --presets @babel/preset-env lang/de_de.raw.js > lang/de_de.js
babel --presets @babel/preset-env lang/en_gb.raw.js > lang/en_gb.js
babel --presets @babel/preset-env lang/fr_fr.raw.js > lang/fr_fr.js
```

**Fußnote zu Obacht!** Natürlich wurde nicht getestet, ob der Vote-O-Mat noch tatsächlich von Internet Explorer 11 (sic!) unterstützt wird. Sollte es mal zu Problemen kommen, können wir immernoch über eine Problemlösung reden (und ich möchte mich an dieser Stelle ausdrücklich nicht festlegen, ob diese Lösung eine Code-Änderung oder ein Browser-Update ist).

## <a name="statistics"></a>Statistiken

### Was kann ich mit den Statistiken machen?

Das Statistik-Dashboard des Vote-O-Maten hat zwei Funktionen:

- Eine Tabelle, die zeigt, wie oft der Vote-O-Mat genutzt wurde
- Ein Diagramm, das die Nutzung über die Zeit veranschaulicht

Die Nutzung kann in folgende Kategorien aufgeteilt werden:

- Anzahl der Nutzenden, die die Vote-O-Mat-Website öffnen
- Anzahl der Nutzenden, die den Vote-O-Mat starten (d.h. auf "Start" drücken)
- Anzahl der Nutzenden, die den Vote-O-Mat beenden (d.h. die Ergebnisse sehen)

Es ist auch möglich, die Nutzung nach Sprachen zu gruppieren.

Mit diesen Tools können Fragen wie die folgenden beantwortet werden:

- Wie viele Personen haben den Vote-O-Mat benutzt?
- Lohnt sich der Aufwand (für eine bestimmte Sprache)?
- Beenden die Besucher den Vote-O-Mat tatsächlich?
- Welche Werbestrategien haben eine signifikante Wirkung? (Angenommen, die Werbungen werden zu unterschiedlichen Zeiten veröffentlicht, so dass bestimmte Nutzungsspitzen einer bestimmten Werbung zugeschrieben werden können)

Es ist auch möglich, die Rohdaten zu verwenden, um anspruchsvollere Analysen durchzuführen. Man könnte versuchen, die durchschnittliche Dauer abzuschätzen, die Nutzenden benötigen, um den Vote-O-Mat zu absolvieren. Oder auswerten, welche Werbungen Nutzende generieren, die den Vote-O-Maten tatsächlich absolvieren. Letztendlich bleibt es den analysierenden Personen überlassen, was aus den Daten herausgelesen werden kann.

**Hinweis:** Das Statistik-Dashboard und die Rohdaten sind für alle zugänglich. [Erfahre warum](#DataProtection)

### <a name="DataCollection"></a>Wie funktioniert die Datenerfassung?

Der Vote-O-Mat enthält vordefinierte *Checkpoints*. Das sind bestimmte Aktionen innerhalb der Anwendung. Checkpoints sind:

- *enter*: die Startseite einer Vote-O-Mat-Instanz wird angezeigt
- *start*: der Start-Knopf auf der Startseite oder der Neustart-Knopf auf der Ergebnisseite wurde angeklickt, sodass die erste These angezeigt wird
- *result* die Ergebnisse werden nach einem (Neu-)Start der Vote-O-Mat-Instanz angezeigt (ein Zurückgehen auf die Ergebnisseite zum Anpassen der Antworten geht nicht in die Statistik ein)

Jeder Checkpoint kann separat aktiviert werden. Erst dann ist er Teil der gesammelten Daten. Standardmäßig sind alle Checkpoints deaktiviert, so dass keine Daten gesammelt werden und keine Statistiken verfügbar sind.

Jedes Mal, wenn ein aktivierter Checkpoint eingegeben wird, sendet die Vote-O-Mat-Instanz die Checkpoint-ID (*enter*, *start* oder *result*, oder eine jeweils benutzerdefinierte ID) an das Statistikmodul. Der ID kann ein Präfix wie *de-* vorangestellt werden, das für jede Vote-O-Mat-Instanz festgelegt werden kann und es ermöglicht, die Nutzung in verschiedenen Sprachen zu unterscheiden.

Das Statistikmodul speichert jede eingehende Checkpoint-ID (und Präfix) zusammen mit einem Zeitstempel in einer [CSV](https://de.wikipedia.org/wiki/CSV_(Dateiformat))-Datei. Diese sieht wie folgt aus:

```
de-enter;1625303227182
de-start;1625303229297
en-enter;1625333857740
en-start;1625333858632
en-result;1625334140898
de-enter;1625399796756
de-start;1625399797504
de-result;1625399970330
```

### <a name="privacy"></a>Was ist mit dem Datenschutz?

Du fragst dich vielleicht

> Statistik in einer wahlbezogenen Software? Aber was ist mit dem Datenschutz!?

Wenn du das nicht tust, solltest du es tun. Datenschutz ist immer wichtig, in diesem Zusammenhang noch mehr. Deshalb sammelt Vote-O-Mat nur ein Minimum an Daten, die alle anonym sind. [Wie beschrieben (#DataCollection), erhebt der Vote-O-Mat zu keinem Zeitpunkt persönliche Informationen.

### <a name="DataProtection"></a>Wie werden die gesammelten Daten geschützt?

Gar nicht. Da die abgerufenen Daten keine persönlichen Informationen enthalten, hat ein Schutz der Daten keine Priorität. Aus diesem Grund wird die Log-Datei nicht verschlüsselt und die Log-Datei und das Statistik-Dashboard auch durch ein Passwort geschützt.

Trotzdem kannst du diese Funktionen gerne hinzufügen!

## Logging on Steroids - Erweiterte Statistikeinstellungen

Werfen wir einen genaueren Blick auf das Statistikmodul und wie es im Detail konfiguriert werden kann. [Erfahre zuerst, wie die Statistiken funktionieren](#privacy)

### Grundlagen

Standardmäßig werden die Daten chronologisch in einer Log-Datei namens `hits.log` gespeichert, die in `vom-statistics/hits.log` abgelegt wird. Sie verwendet das [CSV-Format] (https://de.wikipedia.org/wiki/CSV_(Dateiformat)), die Werte sind mit `;` getrennt. So kann die Datei leicht mit Software wie Microsoft Excel geöffnet und analysiert werden.

Die gesammelten Daten sehen wie folgt aus:

```
en-enter;1625333857740
en-start;1625333858632
de-enter;1625399796756
de-start;1625399797504
de-result;1625399970330
```

Jede Zeile in dieser Datei wird als *Eintrag* bezeichnet. Ein Eintrag hat die folgende Syntax:

```
{Präfix}{Checkpoint-ID};{Zeitstempel}\n
```

- `Präfix`: Kennung der Vote-O-Mat-Instanz, die den Eintrag gesendet hat *(Standard: leere Zeichenkette)*
- `Checkpoint-ID`: Bezeichner des Checkpoints, der erreicht wurde *(Standard: 'enter', 'start' oder 'result')*
- `Zeitstempel`: UNIX-Zeitstempel in Millisekunden

### Benutzerdefinierte Checkpoint-IDs

Standardmäßig lauten die Checkpoint-IDs so wie die Checkpoints: *enter*, *start* und *result*. Wenn diese IDs für deine Anwendung nicht passen, kann die ID für jeden Prüfpunkt angepasst werden.

- Öffne `setup.html`, um die Checkpoint-IDs anzupassen.
- Gehe weiter zu den Statistikeinstellungen.
- Setze nach Belieben benutzerdefinierte Checkpoint-IDs für die jeweiligen Checkpoints ein. Lasse ein Feld leer, um die jeweilige Standard-ID zu verwenden.

**Achtung:** Mit großer Macht kommt große Verantwortung. Vote-O-Mat verifiziert eingegebene Checkpoint-IDs nicht. Stelle sicher, dass sie keine schädlichen Zeichen wie `;` enthält, die mit dem oben beschriebenen Speicherformat interferieren würden. Du willst wahrscheinlich auch, dass alle IDs unterschiedlich sind.

### Benutzerdefinierte Checkpoint-Präfixe

Theoretisch sind die Checkpoint-Präfixe dazu gedacht, Daten nach der Vote-O-Mat-Sprache zu klassifizieren. In der Praxis kannst du Vote-O-Mat-Instanzen mit ihnen nach Belieben gruppieren.

- Öffne `setup.html`, um Gruppen zu erstellen.
- Gehe weiter zu den Statistikeinstellungen.
- Klappedas Feld für die Sprachpräfixe unten auf der Seite aus.
- Füge für jede Gruppe ein Sprachpräfix hinzu. Du bist frei in der Benennung der Gruppen und ihrer Präfixe.

**Achtung:** Auch hier gilt: Du bist selbst dafür verantwortlich, wenn etwas kaputt geht, da Vote-O-Mat die Gruppen nicht verifiziert. Schädliche Zeichen wie `;` werden nicht gefiltert, uneindeutige Gruppenpräfixe machen die Gruppen unbrauchbar.

Wiederhole für jede Vote-O-Mat-Instanz:

- Öffne `generator.html`, um die Instanz einer Gruppe zuzuordnen.
- Gehe weiter zu den Statistikeinstellungen.
- Wähle die gewünschte Gruppe aus. Wenn du einer Instanz keine Gruppe zuweist, verwendet sie eine leere Zeichenkette als Präfix und wird als "Sonstige" im Dashboard gelistet.
- Du kannst auch mehrere Vote-O-Mat-Instanzen der gleichen Gruppe zuordnen.

**Achtung:** Die Gruppenzuordnung speichert den Gruppennamen und das Gruppenpräfix direkt in der Konfiguration der Vote-O-Mat-Instanz. Wenn du das Gruppenpräfix in `config/setup.json` änderst, wirkt sich diese Änderung nicht auf bereits konfigurierte Instanzen aus, sondern lediglich auf jede zukünftige Konfiguration einer Vote-O-Mat-Instanz.

### Benutzerdefinierter Name und Speicherort der Log-Datei

Die Log-Datei heißt `hits.log` und befindet sich im Verzeichnis des Statistikmoduls, `vom-statistics`. Beides kann geändert werden.

- Öffne `setup.html`, um den Speicherort und den Namen der Log-Datei anzupassen.
- Gehe weiter zu den Statistikeinstellungen.
- Klappe das Feld für die erweiterten Einstellungen unten auf der Seite aus.
- Gebe einen Pfad für die Log-Datei ein. Der Pfad ist relativ zum Verzeichnis des Statistikmoduls, `vom-statistics`.

**Hinweis:** Vote-O-Mat erstellt die Log-Datei, wenn sie nicht vorhanden ist. Vote-O-Mat erstellt jedoch keine Ordner auf dem *Pfad zu* der Log-Datei. Vergewissere dich, dass das Verzeichnis, in dem die Log-Datei abgelegt werden soll, bereits existiert, sonst schlägt die Speicherung fehl.

**Beispiel A:** Der Log-Datei-Pfad `../statistics.csv` erzeugt eine Log-Datei mit dem Namen `statistics.csv` im Wurzelverzeichnis (vorausgesetzt `vom-statistics` befindet sich im Wurzelverzeichnis).

**Beispiel B:** Der Log-Datei-Pfad `test/statistics.log` erzeugt eine Log-Datei mit dem Namen `statistics.log` in einem Ordner `test`, der sich in `vom-statistics` befindet. Dies wird nicht funktionieren, wenn du den Ordner `test` nicht vorher erstellt hast.

**Achtung:** Wie üblich hält Vote-O-Mat dich nicht davon ab, dummes Zeug zu machen. Wenn du einen falschen Pfad eingibst, wird die Speicherung fehlschlagen.

### <a name="StatisticsDashboard"></a>Benutzerdefinierte Statistikmodul-URL

Auf das Dashboard des Statistikmoduls kann man über `https://example.com/vom-statistics/` zugreifen, vorausgesetzt man hat den Vote-O-Mat unter `https://example.com` veröffentlicht.

Hier siehst du, wie du diese URL ändern kannst:

- Angenommen, du möchtest auf das Statistik-Dashboard unter `https://example.com/stats/` zugreifen.
- Benenne den Ordner `vom-statistics` in `stats` um.
- Öffne `setup.html`, um die URL des Statistikmoduls zu ändern.
- Gehe zu den Statistikeinstellungen.
- Klappe das Panel für erweiterte Einstellungen am unteren Ende der Seite aus.
- Gib `stats` in das entsprechende Textfeld ein, den neuen Namen des Ordners (früher `vom-statistics`).
    - *Für Nerds:* Du kannst einen beliebigen Pfad relativ zum Wurzelverzeichnis oder eine komplette URL eingeben.

**Achtung (für Nerds):** Diese Funktion ermöglicht es dir, das komplette Statistikmodul an einen anderen Ort zu verschieben, z.B. auf einen anderen Server. Aus welchem Grund auch immer man das machen wollen würde: Beachte, dass das Modul erwartet, dass sich die `setup.json` unter `../config/setup.json` befindet, relativ zum Verzeichnis des Statistikmoduls.

<a name="troubleshooting"></a>Fehlerbehandlung

### Meine Änderungen in `setup.json` und `data.json` scheinen keine Auswirkungen zu haben.

Speicherst du den vom Setup-/Konfigurations-Tool erzeugten Text in den Dateien? Bearbeitest du die richtige Datei? Befindet sich die Datei am richtigen Ort? Hast du die angepasste Datei auf den Webserver hochgeladen?

Wenn ja, könnte es sich um ein Cache-Problem handeln. Rufe die betreffende Datei im Browser auf (unter `https://example.com/config/setup.json` oder `https://example.com/example-instance/config/data.json`). Drücke `Strg+F5`, um die Datei vollständig neu zu laden. Gehe dann zurück zum Vote-O-Maten (bzw. der Vote-O-Mat-Instanz), lade die Seite neu und überprüfe, ob das funktioniert hat.

### Hilfe! Mein vorheriges Setup/meine Konfiguration ist plötzlich weg, wenn ich `setup.html`/`generator.html` öffne!

Der Vote-O-Mat konnte die Datei `setup.json` oder `data.json` nicht laden.

Arbeitest du lokal auf deinem Computer? Die meisten Browser verbieten es Vote-O-Mat, auf lokale Dateien zuzugreifen. In diesem Fall zeigt dir der Vote-O-Mat zu Beginn des Setup- oder Konfigurationsprozesses ein Textfeld an. Lade das Setup-/Konfigurations-Tool neu, um zum Anfang zurückzukehren. Öffne `setup.json` und/oder `data.json`. Kopiere deren Inhalt in die entsprechenden Textfelder und starte den Vorgang erneut.

Arbeitest du auf dem Webserver? Vergewissere dich, dass die Datei existiert, für den Webserver lesbar ist (du könntest versuchen, mit dem Browser unter `https://example.com/config/setup.json` bzw. `https://example.com/example-instance/config/data.json` direkt auf die Datei zuzugreifen) und syntaktisch korrekt ist.

### Ich kann keine Sprache in `generator.html` auswählen.

Wurden die Sprachen in `setup.html` konfiguriert? Kann die Vote-O-Mat-Instanz auf `setup.json` zugreifen? Befindet sich `setup.json` in `../config` (der Ordner mit dem Namen `config`, in dem Verzeichnis, das auch das Verzeichnis der Vote-O-Mat-Instanz enthält)?

### Die Startseite sieht komisch aus und überall stehen seltsame Dinge wie btn-start oder start-explanatory-text. Außerdem funktioniert nichts.

Es sieht so aus, als ob der JavaScript-Teil kaputt ist. Hast du [die Anzeigesprache](#DisplayLanguage) richtig eingestellt? Die Sprach-Datei könnte auch einen Syntaxfehler enthalten.

### Ich kann in `generator.html` nicht fortfahren.

Du solltest mindestens eine These und eine Liste hinzufügen.

### Ich öffne den Vote-O-Maten aber nichts funktioniert, da ist nur eine rote Warnung!

Hast du die Datei `index.html` direkt im Webbrowser geöffnet? Das funktioniert leider in den meisten Browsern nicht. Versuche, [alles](#upload) auf einen Webserver hochzuladen und die Datei stattdessen von dort aus zu öffnen. Oder betreibe einen lokalen Webserver für die Einrichtung.

Wenn die Dateien hingegen bereits auf einem Webserver liegen und dennoch die Fehlermeldung auftaucht, dann lies sie: Existiert die Datei?
Lässt sich sich mit dem Webbrowser direkt aufrufen oder kommt eine Fehlermeldung? Und nicht zuletzt, enthält sie keine Syntaxfehler?

# Freud und Leid
### Ich habe Probleme beim Einrichten des Vote-O-Maten

Schade! Schau mal [hier](#troubleshooting), hier gibt's günstig Lösungsvorschläge. Wenn da nichts dabei ist, frag mal Freunde. Wenn auch die nicht helfen können, [erstelle ein Issue](https://github.com/SilvanVerhoeven/vote-o-mat/issues) (und hoffe, dass es bemerkt wird).

### Ich möchte einen Fehler melden

Freu! [Erstelle ein Issue](https://github.com/SilvanVerhoeven/vote-o-mat/issues) (und hoffe, dass es bemerkt wird).

### Ich möchte einen Fehler beheben

Freu Freu! [Erstelle einen Pull Request](https://github.com/SilvanVerhoeven/vote-o-mat/pulls) (und hoffe, dass er bemerkt wird).

### Ich möchte mich beschweren / Danke sagen

Ich freue mich immer über Erfolgsgeschichten (oder Geschichten über Misserfolge) unter silvan.verhoeven@student.hpi.de!