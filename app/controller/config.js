var onextConf = function(){
	return {
		handleBaseURL: function () {
			var getUrl = window.location,
				baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
			return baseUrl;
		},
		handleBaseURLX: function () {
			var getUrl = window.location,
				baseUrl = getUrl .protocol + "//" + getUrl.host + "/apps/RegOnline/";
			return baseUrl;
		}
	}
}();
var globalWsPath = onextConf.handleBaseURLX()+'api';
var globalReportPath = onextConf.handleBaseURL()+'/cetak';
var globalPath = onextConf.handleBaseURL()+'/public/';
var globalHomePath = onextConf.handleBaseURLX();