BaseApp.Views.MainView = Backbone.View.extend({

	template : null,

	el: 'div#container',

	events: {
		'click .load-notes' : 'loadNotes',
		'click .get_notes_button' : 'getNotes'
	},

	initialize : function () {
		debugger;
		var template = $('#notes').html();

		this.template = _.template(template);

	},

	render: function () {
		debugger;
		this.$el.html(this.template);

		return this;
	},

	loadNotes: function () {

		$.ajax({
			url: notesLink,
			dataType: 'json',
			data: {},
			success: function (response) {
				text = '<ul>';
				debugger;
				$.each(response.notes , function (i, v) {
					text += '<li>' +  v +'</li>';
				} );
				text += '</ul>';

				$('#container').html(text);
			}
		});
	},

	getNotes: function () {
		$.ajax({
			url: notesLink,
			dataType: 'json',
			data: {},
			success: function (response) {
				text = '<ul>';
				debugger;
				$.each(response.notes , function (i, v) {
					text += '<li>' +  v +'</li>';
				} );
				text += '</ul>';

				$('#container').html(text);
			}
		});
	}
});