/**
 * Created by eddy on 31.7.17..
 */
/**
 * this is backbone main Router
 * @type {Selection.extend}
 */
BaseApp.MainRouter = Backbone.Router.extend({

	app : null,


	routes : {
		''	  : 'home',
		'home'	  : 'home',
		'notes' : 'notes'
	},

	initialize : function () {
		// debugger;
		// var mainView = new BaseApp.Views.MainView();
		// mainView.render();
	},

	home: function () {

		var mainView = new BaseApp.Views.MainView();
		mainView.render();
		_view = mainView;
	},

	notes : function () {

debugger;
		if(typeof notesLink === 'undefined'){
			notesLink = '/getNotes';
		}
		var url = '{{ path("welcome/Eddy", {"region_id": "region_id"}) }}';
		$.ajax({
			url: url,
			dataType: 'json',
			data: {},
			success: function (response) {
				text = '<ul>';
				debugger;
				$.each(response.notes , function (i, v) {
					text += '<li>' +  v +'</li>';
				} );
				text += '</ul>';

				$('#container').append(text);
			}
		});
	}

});
