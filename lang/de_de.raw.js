class T {
  constructor() {
    this.page_title = "Vote-O-Mat";
    this.vote_o_mat_title = "Vote-O-Mat 2021";
    this.qa_modal_title = "Fragen &amp; Antworten";
    this.qa_modal_body = '<h4>Wer steht hinter dem Vote-O-Mat?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Wer hat die Thesen erarbeitet?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Woher stammen die Positionen der Gruppen?</h4>\
					<p>Den an der Wahl teilnehmenden Gruppen wurden die Thesen mit der Bitte um Stellungnahme zugeleitet. Neben der reinen\
						Positionierung (Zustimmung/Neutral/Ablehnung/Keine Stellungnahme) konnten sie ihre Position auch in einem kurzen Absatz\
						erläutern.\
					</p>\
					<p>Für ihre Stellungnahmen zu den Thesen sind die Gruppen selbst verantwortlich.</p>\
\
					<h4>Von welcher Wahl reden wir hier überhaupt?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Wie werden die Punkte berechnet?</h4>\
					<p>Deine Antworten werden mit den vorgegebenen Antworten der Gruppen abgeglichen.</p>\
					<ul>\
						<li>Stimmt die Antwort überein, werden der Gruppe 2 Punkte gutgeschrieben;</li>\
						<li>Weicht die Antwort leicht ab (Zustimmung/Neutral oder Neutral/Ablehnung), wird der Gruppe 1 Punkt gutgeschrieben;</li>\
						<li>Sind die Antworten entgegengesetzt oder hat eine Gruppe eine These nicht beantwortet, gibt es keine Punkte für die\
							Gruppe.\
						</li>\
					</ul>\
					<p>Eine These, die du übersprungen hast, wird nicht gewertet. Die erreichbare Höchstpunktzahl wird dadurch geringer.</p>\
					<p>Eine These, die doppelt gewichtet werden soll, wird doppelt gewichtet, das heißt, für sie wird die doppelte Punktzahl\
						gutgeschrieben (0/2/4). Dadurch können insgesamt mehr Punkte erreicht werden.</p>\
\
					<h4>Werden meine Antworten gespeichert?</h4>\
					<p>Nein. Alles läuft vollständig in deinem Browser ab.</p>\
\
					<h4>Ich habe einen inhaltlichen Fehler gefunden!</h4>\
					<p>Gib uns gern Bescheid, wir sehen uns das an. Wer „wir“ sind, steht oben auf dieser Seite.</p>\
\
					<h4>Wer hat den Vote-O-Mat programmiert?</h4>\
					<p>Das steht\
						<a href="https://github.com/SilvanVerhoeven/vote-o-mat">hier</a>. Der Vote-O-Mat ist übrigens freie Software!</p>\
\
					<h4>Ich habe einen Programmierfehler gefunden!</h4>\
					<p>Oh nein! Wenn du den Fehler\
						<a href="https://github.com/SilvanVerhoeven/vote-o-mat">meldest</a>, wird er vielleicht behoben.</p>';
    this.btn_qa_modal_close = "Schließen";
    this.swype_info_message_text = "Wische, um manuell zwischen Thesen zu wechseln";
    this.btn_swype_info_ok = "OK";
    this.start_subtitle = "Der Vote-O-Mat ist ein Wahlpositions&shy;vergleichswerkzeug.";
    this.start_explanatory_text = "<p>Der Vote-O-Mat ermöglicht es dir, deine Meinung zu ausgewählten Thesen mit denen der Gruppen zu vergleichen, die zur $WAHL\
						antreten.\
					</p>\
					<p>Für ihre Stellungnahmen zu den Thesen sind die Gruppen selbst verantwortlich.</p>";
    this.btn_start = "Vote-O-Mat starten!";
    this.btn_start_show_qa = "Fragen &amp; Antworten";
    this.btn_toggle_thesis_more_text = "Erläuterung";
    this.btn_important = "These doppelt gewichten";
    this.btn_yes_text = "Zustimmung";
    this.btn_neutral_text = "Neutral";
    this.btn_no_text = "Ablehnung";
    this.btn_skip_text = "Überspringen";
    this.btn_mahlowat_show_start = "Zurück zur Startseite";
    this.btn_mahlowat_show_qa = "Fragen &amp; Antworten";
    this.btn_mahlowat_skip_remaining_theses = "Alle verbleibenden Thesen überspringen und aktuellen Stand auswerten";
    this.results_title = "Ergebnis";
    this.results_title_summary = "Zusammenfassung";
    this.text_result_below_summary = '<small>Nicht zufrieden mit dem Ergebnis?\
				<button class="btn btn-sm btn-light" onclick="showMahlowatFirstThesis()">Ändere die Antworten oder die Gewichtung!</button>\
			</small>';
    this.results_title_details = "";
    this.btn_results_show_start = "Zurück zur Startseite";
    this.btn_results_show_qa = "Fragen &amp; Antworten";
    this.no_log_data = "Der Vote-O-Mat wurde bisher nicht genutzt.";
  }

  thesis_number(number) {
    return "These " + number;
  }

  get btn_make_thesis_double_weight() {
    return "These doppelt gewichten";
  }

  get btn_thesis_has_double_weight() {
    return "These wird doppelt gewichtet";
  }

  get label_your_choice() {
    return "Deine Wahl";
  }

  achieved_points_text(pointsForList, maxAchievablePoints) {
    return '' + pointsForList + '/' + maxAchievablePoints + ' Punkte';
  }

  get default_text_no_statement() {
    return "<small class='text-muted'>Keine Stellungnahme.</small>";
  }

  get error_loading_config_file() {
    return '<b>Fehler:</b> Die Konfigurationsdatei <a href="config/data.json"><tt>config/data.json</tt></a> konnte nicht geladen\
		werden. Existiert sie und enthält keine Syntaxfehler?';
  }

  get error_loading_setup_file() {
    return '<b>Fehler:</b> Die Konfigurationsdatei <a href="../config/setup.json"><tt>../config/setup.json</tt></a> konnte nicht geladen\
		werden. Existiert sie und enthält keine Syntaxfehler?';
  }

  get error_statistics_module_not_found() {
    return '<b>Fehler:</b> Das Statistik-Modul konnte nicht erreicht werden. Wurde die URL zum Statistik-Modul in <a href="../config/setup.json"><tt>../config/setup.json</tt></a> richtig konfiguriert?';
  }

  get error_statistics_general() {
    return '<b>Fehler:</b> Das Statistik-Modul arbeitet nicht korrekt. Prüfe die Browser-Konsole für weitere Fehlerinformationen.';
  }

  get warning_unknown_checkpoint_prefix() {
    return '<b>Warnung:</b> Die Log-Datei enthält Checkpoint Präfixe, die keiner Sprache zugeordnet werden können. Grund hierfür könnte eine falsche Sprach-Konfiguration oder veraltete Log-Datei sein.<br><b>Behebung:</b> Prüfe mit <a href="../setup.html"><tt>../setup.html</tt></a>, ob die Sprach-Konfiguration im Abschnitt Statistiken korrekt ist. Führe anschließend die Konfiguration aller Vote-O-Mat-Instanzen erneut durch (sollte schnell gehen, die Werte werden vorausgefüllt). Wenn die Sprach-Konfiguration erst kürzlich geändert wurde, kann auch nur die Log-Datei veraltet sein. Lösche dann die gesamte Datei oder aber zumindest Einträge mit folgendem Präfix aus der Log-Datei: ';
  }

  get warning_unknown_checkpoint_id() {
    return '<b>Warnung:</b> Die Log-Datei enthält unbekannte Checkpoints. Grund hierfür könnte eine falsche Konfiguration oder veraltete Log-Datei sein.<br><b>Behebung:</b> Prüfe mit <a href="../setup.html"><tt>../setup.html</tt></a>, ob die aktivierten Checkpoints im Abschnitt Statistiken korrekt eingestellt sind. Passe die Konfiguration ggf. an. Ist die Konfiguration korrekt, kann auch lediglich die Log-Datei veraltet sein. Lösche dann die gesamte Datei oder aber zumindest die Einträge der Log-Datei, die folgendermaßen enden: ';
  }

}