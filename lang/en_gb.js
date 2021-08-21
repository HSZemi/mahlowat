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
    this.qa_modal_title = "Questions &amp; Answers";
    this.qa_modal_body = '<h4>Who is behind the Vote-O-Mat?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>Who developed the theses?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>What is the origin of the groups\' statements?</h4>\
					<p>The theses were sent to the groups participating in this election. They could give their position (yes/neutral/no/skip)\
					as well as a short paragraph as an accompanying statement.\
					</p>\
					<p>The groups are solely responsible for their own statements.</p>\
\
					<h4>What is this election you are talking about?</h4>\
					<p>Lorem Ipsum.</p>\
\
					<h4>How are the points calculated?</h4>\
					<p>Your answers are compared to the positions of the groups.</p>\
					<ul>\
						<li>The group gains 2 points if their answer matches yours;</li>\
						<li>A slight deviation (yes/neutral or neutral/no) gains the group still 1 point;</li>\
						<li>If the answers are contrary or if a group has no position on a thesis, the group gains no point.\
						</li>\
					</ul>\
					<p>A thesis that you skipped gains no one any point. The maximum number of points possible decreases.</p>\
					<p>A thesis that you count double gets groups twice the points (0/2/4). This increases the maximum number of points possible.</p>\
\
					<h4>Are my answers stored somewhere?</h4>\
					<p>No. Everything stays in your web browser. Once you close the page, all information is lost forever.</p>\
\
					<h4>I have spotted an error in your content!</h4>\
					<p>Please tell us. Who is »us«? See above.</p>\
\
					<h4>Who programmed the Vote-O-Mat?</h4>\
					<p><a href="https://github.com/SilvanVerhoeven/vote-o-mat">Behold!</a>. By the way: the Vote-O-Mat is free software!</p>\
\
					<h4>I found a programming error!!</h4>\
					<p>Oh no! If you <a href="https://github.com/SilvanVerhoeven/vote-o-mat">report the bug</a>, it might get fixed.</p>';
    this.btn_qa_modal_close = "Close";
    this.swype_info_message_text = "Swype to switch between theses manually";
    this.btn_swype_info_ok = "OK";
    this.start_subtitle = "Vote-O-Mat is a voting advice application. It's a tool, not your mum.";
    this.start_explanatory_text = "<p>The Vote-O-Mat permits you to compare your opinion on selected theses with the opinions of\
		groups that participate in $ELECTION.</p>\
					<p>The views expressed in the groups' statements are their own.</p>";
    this.btn_start = "Start the Vote-O-Mat!";
    this.btn_start_show_qa = "Questions &amp; Answers";
    this.btn_toggle_thesis_more_text = "Explanation";
    this.btn_important = "Count double";
    this.btn_yes_text = "Yes";
    this.btn_neutral_text = "Neutral";
    this.btn_no_text = "No";
    this.btn_skip_text = "Skip";
    this.btn_mahlowat_show_start = "Back to the welcome page";
    this.btn_mahlowat_show_qa = "Questions &amp; Answers";
    this.btn_mahlowat_skip_remaining_theses = "Skip all remaining theses and evaluate the current selections";
    this.results_title = "Result";
    this.results_title_summary = "Summary";
    this.text_result_below_summary = '<small>Don\'t like your results?\
				<button class="btn btn-sm btn-light" onclick="showMahlowatFirstThesis()">Change the answers or the weights!</button>\
			</small>';
    this.results_title_details = "";
    this.btn_results_show_start = "Back to the welcome page";
    this.btn_results_show_qa = "Questions &amp; Answers";
  }

  _createClass(T, [{
    key: "thesis_number",
    value: function thesis_number(number) {
      return "Thesis " + number;
    }
  }, {
    key: "achieved_points_text",
    value: function achieved_points_text(pointsForList, maxAchievablePoints) {
      return '' + pointsForList + '/' + maxAchievablePoints + ' Points';
    }
  }, {
    key: "btn_make_thesis_double_weight",
    get: function get() {
      return "Count double";
    }
  }, {
    key: "btn_thesis_has_double_weight",
    get: function get() {
      return "Counting double";
    }
  }, {
    key: "label_your_choice",
    get: function get() {
      return "Your choice";
    }
  }, {
    key: "default_text_no_statement",
    get: function get() {
      return "<small class='text-muted'>No statement.</small>";
    }
  }, {
    key: "error_loading_config_file",
    get: function get() {
      return '<b>Error</b> Could not load the configuration file \
		<a href="config/data.json"><tt>config/data.json</tt></a>. Does it exist? Does it not contain syntax errors?';
    }
  }]);

  return T;
}();

