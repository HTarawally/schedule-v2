$(function() {
	"use strict";

	$(".task").on("click", function(e) {
		var vars = [], hash, hashes, itemID, jqxhr;
		var queryString = $(this).attr("href");

		e.preventDefault(); // prevent default action of link

		hashes = queryString.slice(queryString.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}

		itemID = vars.edit;

		jqxhr = $.get("forms/all.php", {edit : itemID});

		jqxhr.done(function(data) {
			$.get("forms/additem.php", {edit : itemID}, function(data1) {
				var newElement = $("<div id='formHolder' class='container seperated'></div>");

				$(newElement).append(data1);
				$(newElement).append(data);

				$("#formHolder").replaceWith(newElement);

				$("form").on("submit", function(e) {
					checkFormSubmit($(this), e);
				});
			});
		});
	}); // end on click

	setTimeout(function() {
		$("#error").animate({opacity: 0}, 600, function() {
			$("#error").animate({height: 0}, 800);
		});
	}, 3800);

	$("form").on("submit", function(e) {
		checkFormSubmit($(this), e);
	});

	var checkFormSubmit = function(form, e) {
		var field = form.find("input[type=text]");
		var title = field.val().trim();

		if(title != null && title == "") {
				field.attr("placeholder", "Please enter a value");
				e.preventDefault();
		}
	};
});
