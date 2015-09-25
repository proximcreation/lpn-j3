app.
filter('domain', function() {
	return function (url) {
	  	return url.split('//')[1].split('/')[0];
	};
}).
filter('cleanLimitTo', function() {
	return function (s) {
	  	return (s.substr(s.length-2, s.length).indexOf('.')>=0) ? s : s + ' ...';
	};
}).
filter('hour', function() {
	return function (t) {
	  	return moment(t).format('H:mm');
	};
}).
filter('date', function() {
	return function (t) {
	  	return moment(t).format('ddd D MMM');
	};
}).
filter('lower', function() {
	return function (s) {
	  	return s.toLowerCase();
	};
}).
filter('catTitle', function() {
	return function (s) {
		s = s.charAt(0).toUpperCase() + s.substr(1).toLowerCase();
		s = s.replace(' ', 's ') + 's';
	  	return s;
	};
}).
filter('link', function(){
	return function(l){
		var res = '';
		if(l%1===0){
			res = 'BP'+l;
		} else if(l.indexOf('http')>=0){
			res = l.slit('://')[1];
		} else{
			res = l;
		}
		return res;
	};
});
