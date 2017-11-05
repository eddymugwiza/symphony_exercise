/**
 * here starts backbone application
 */

window.BaseApp = {
	Views: {},

	Collections : {},

	Models : {},

	start: function () {

		Backbone.emulateHTTP = true;

		this.mainRouter = new BaseApp.MainRouter({
			app: this
		});

		Backbone.history.start();
	}
};