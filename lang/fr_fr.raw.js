class T {
  constructor() {
    this.page_title = "Mahlowat";
    this.qa_modal_title = "Questions-réponses";
    this.qa_modal_body = '<h4>Qui a fait le Mahlowat?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Qui a deviné les théses?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Comment avons-nous obtenu les positions des groupes?</h4>\
					<p>Nous avons envoyé les théses aux groupes qui participent à l\'élection et demandé qu\'ils repondent.\
					Les gropues ont pu donner leur avis (Oui/Neutre/Non/Sauté) ainsi que un bref paragraphe qui explique leur position.\
					</p>\
\
					<h4>Élection? Quelle élection?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Les points comment sont-ils calculés?</h4>\
					<p>vos réponses sont comparées avec les réponses des groupes.</p>\
					<ul>\
						<li>Le groupe gagne 2 points si elle a donné la même réponse que vous;</li>\
						<li>Si il y a une différence minuscule (Oui/Neutre ou Neutre/Non), le groupe gagne 1 point;</li>\
						<li>Des réponses contraires et une thése à laquelle une groupe n\'a pas repondu ne donnent pas de points.\
						</li>\
					</ul>\
					<p>Une thése que vous avez sauté ne donne pas de points. La somme des points atteinable est diminuée.</p>\
					<p>Une thése dont vous avez doublé les points donne double points (0/2/4). La somme des points atteinable est augmentée.</p>\
\
					<h4>Mes réponses sont-elles enregistrées?</h4>\
					<p>Non. Tout est traité dans votre navigateur seulement. Dès que vous fermez la page, tout est perdu.</p>\
\
					<h4>J\'ai trouvé une erreur dans le contenu!</h4>\
					<p>Informez-nous et nous allons examiner cette erreur. Si vous ne savez pas qui c\'est «nous», regardez en haut sur cette page.</p>\
\
					<h4>Qui a programmé le Mahlowat?</h4>\
					<p><a href="https://github.com/hszemi/mahlowat">Regardez ici</a>. Au fait, le Mahlowat est un logiciel libre!</p>\
\
					<h4>J\'ai trouvé une erreur de programmation!</h4>\
					<p>Mon dieu! Si tu signales l\'erreur\
						<a href="https://github.com/hszemi/mahlowat">ici</a>, il se peut que ce sera reparé.</p>';
    this.btn_qa_modal_close = "Fermer";
    this.swype_info_message_text = "Balayez pour changer la thése";
    this.btn_swype_info_ok = "OK";
    this.start_subtitle = "Le Mahlowat est une application qui vous aide a décider pour qui voter.<br>\
		Pourtant, c'est pas votre mêre, alors faites ce que vous voulez.";
    this.start_explanatory_text = "<p>Le Mahlowat vous permet de comparer ton opinion sur des théses selectionnées avec les \
		opinions des goupes qui participent à l'élection.\
					</p>\
					<p>Les groupes sont responsables pour leurs réponses.</p>";
    this.btn_start = "Demarrer le Mahlowat!";
    this.btn_start_show_qa = "Questions-réponses";
    this.btn_toggle_thesis_more_text = "Explication";
    this.btn_important = "Doubler les points";
    this.btn_yes_text = "Oui";
    this.btn_neutral_text = "Neutre";
    this.btn_no_text = "Non";
    this.btn_skip_text = "Sauter";
    this.btn_mahlowat_show_start = "Retourner à la page d'accueil";
    this.btn_mahlowat_show_qa = "Questions-réponses";
    this.btn_mahlowat_skip_remaining_theses = "Sauter les théses restants et evaluer l'état présent";
    this.title_results = "Résultat";
    this.title_results_summary = "Résumé";
    this.text_result_below_summary = '<small>Vous n\'aimez pas votre résultat?\
				<button class="btn btn-sm btn-light" onclick="showMahlowatFirstThesis()">Changez les réponses ou les points doubles!</button>\
			</small>';
    this.title_results_details = "";
    this.btn_results_show_start = "Retourner à la page d'accueil";
    this.btn_results_show_qa = "Questions-réponses";
  }

  thesis_number(number) {
    return "Thése " + number;
  }

  get btn_make_thesis_double_weight() {
    return "Doubler les points";
  }

  get btn_thesis_has_double_weight() {
    return "Points doublés";
  }

  get label_your_choice() {
    return "Votre selection";
  }

  achieved_points_text(pointsForList, maxAchievablePoints) {
    return '' + pointsForList + '/' + maxAchievablePoints + ' Points';
  }

  get default_text_no_statement() {
    return "<small class='text-muted'>Pas de position.</small>";
  }

  get error_loading_config_file() {
    return '<b>Erreur</b> Le fichier de configuration \
		<a href="config/data.json"><tt>config/data.json</tt></a> n\'a pas été trouvé. Existe-t-il? Y a-t-il des erreurs de syntaxe?';
  }

}