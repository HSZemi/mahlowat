"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var T =
/*#__PURE__*/
function () {
  function T() {
    _classCallCheck(this, T);

    this.page_title = "Vote-O-Mat";
    this.vote_o_mat_title = "Vote-O-Mat 2021";
    this.qa_modal_title = "Questions-réponses";
    this.qa_modal_body = '<h4>Qui a fait le Vote-O-Mat?</h4>\
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
					<h4>Qui a programmé le Vote-O-Mat?</h4>\
					<p><a href="https://github.com/SilvanVerhoeven/vote-o-mat">Regardez ici</a>. Au fait, le Vote-O-Mat est un logiciel libre!</p>\
\
					<h4>J\'ai trouvé une erreur de programmation!</h4>\
					<p>Mon dieu! Si tu signales l\'erreur\
						<a href="https://github.com/SilvanVerhoeven/vote-o-mat">ici</a>, il se peut que ce sera reparé.</p>';
    this.btn_qa_modal_close = "Fermer";
    this.swype_info_message_text = "Balayez pour changer la thése";
    this.btn_swype_info_ok = "OK";
    this.start_subtitle = "Le Vote-O-Mat est une application qui vous aide a décider pour qui voter.<br>\
		Pourtant, c'est pas votre mêre, alors faites ce que vous voulez.";
    this.start_explanatory_text = "<p>Le Vote-O-Mat vous permet de comparer ton opinion sur des théses selectionnées avec les \
		opinions des goupes qui participent à l'élection.\
					</p>\
					<p>Les groupes sont responsables pour leurs réponses.</p>";
    this.btn_start = "Demarrer le Vote-O-Mat!";
    this.btn_start_show_qa = "Questions-réponses";
    this.btn_toggle_thesis_more_text = "Explication";
    this.btn_important = "Doubler les points";
    this.btn_yes_text = "Oui";
    this.btn_neutral_text = "Neutre";
    this.btn_no_text = "Non";
    this.btn_skip_text = "Sauter";
    this.btn_vote_o_mat_show_start = "Retourner à la page d'accueil";
    this.btn_vote_o_mat_show_qa = "Questions-réponses";
    this.btn_vote_o_mat_skip_remaining_theses = "Sauter les théses restants et evaluer l'état présent";
    this.results_title = "Résultat";
    this.results_title_summary = "Résumé";
    this.text_result_below_summary = '<small>Vous n\'aimez pas votre résultat?\
				<button class="btn btn-sm btn-light" onclick="showVoteOMatFirstThesis()">Changez les réponses ou les points doubles!</button>\
			</small>';
    this.results_title_details = "";
    this.btn_results_show_start = "Retourner à la page d'accueil";
    this.btn_results_show_qa = "Questions-réponses";
  }

  _createClass(T, [{
    key: "thesis_number",
    value: function thesis_number(number) {
      return "Thése " + number;
    }
  }, {
    key: "achieved_points_text",
    value: function achieved_points_text(pointsForList, maxAchievablePoints) {
      return '' + pointsForList + '/' + maxAchievablePoints + ' Points';
    }
  }, {
    key: "btn_make_thesis_double_weight",
    get: function get() {
      return "Doubler les points";
    }
  }, {
    key: "btn_thesis_has_double_weight",
    get: function get() {
      return "Points doublés";
    }
  }, {
    key: "label_your_choice",
    get: function get() {
      return "Votre selection";
    }
  }, {
    key: "default_text_no_statement",
    get: function get() {
      return "<small class='text-muted'>Pas de position.</small>";
    }
  }, {
    key: "error_loading_config_file",
    get: function get() {
      return '<b>Erreur</b> Le fichier de configuration \
		<a href="config/data.json"><tt>config/data.json</tt></a> n\'a pas été trouvé. Existe-t-il? Y a-t-il des erreurs de syntaxe?';
    }
  }]);

  return T;
}();

