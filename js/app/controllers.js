app
.controller('MainCtrl',[
	'$scope', '$window', '$http', '$location', '$timeout', '$filter',
	function($scope, $window, $http, $location, $timeout, $filter) {

		var init = function(){
			moment.locale('fr');

			// DATA LOAD
			$scope.tmplPath = tmplPath;
			if(typeof article !== 'undefined'){ $scope.article = article;}
			if(typeof category !== 'undefined'){ $scope.category = category;}
			if(typeof featured !== 'undefined'){ $scope.featured = featured;}
			if(typeof searchForm !== 'undefined'){
				$scope.searchForm = searchForm;
			}
			if(typeof menu !== 'undefined'){
				$scope.menu = [];
				for(var i=0, l=menu.length; i<l; i++){
					var cur = menu[i];
					if(_.where($scope.menu, {id : cur.id}).length == 0){
						// cur not treated
						if(cur.parent_id === '1'){
							// cur is highest level parent
							$scope.menu.push(cur);
						} else {
							var parent = _.where(menu, {id : cur.parent_id});
							var tmpParent = _.where($scope.menu, {id : cur.parent_id});
							if(tmpParent.length == 0){
								parent = parent[0];
							} else {
								parent = tmpParent[0];
							}
							if(parent.subLevels == undefined){
								parent.subLevels = [cur];
							} else {
								parent.subLevels.push(cur);
							}
						}
					}
				}
			}



		};
		init();
	}
]);
