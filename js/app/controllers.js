app
.controller('MainCtrl',[
	'$scope', '$sce', '$window', '$http', '$location', '$timeout', '$filter',
	function($scope, $sce, $window, $http, $location, $timeout, $filter) {

		var init = function(){
			moment.locale('fr');

			// DATA LOAD
			$scope.tmplPath = tmplPath;
			$scope.basePath = basePath;
			if(typeof json_config !== 'undefined'){ $scope.config = json_config;}
			if(typeof article !== 'undefined'){ $scope.article = article;}
			if(typeof category !== 'undefined'){ $scope.category = category;}
			if(typeof featured !== 'undefined'){ $scope.featured = featured;}
			if(typeof tag !== 'undefined'){
				$scope.tag = tag;
				$scope.tagItems = items;
			}
			if(typeof contact !== 'undefined'){
				$scope.contact = contact;
				$scope.contact.form.formActions = $sce.trustAsHtml($scope.contact.form.formActions);
			}
			if(typeof contacts !== 'undefined'){ $scope.contacts = contacts;}
			if(typeof searchForm !== 'undefined'){
				$scope.searchForm = searchForm;
			}
			if(typeof menu !== 'undefined'){
				$scope.menu = [];
				for(var i=0, l=menu.length; i<l; i++){
					var cur = menu[i];
					if(cur.anchor_css.indexOf('quick')>=0){
						cur.quick = true;
					}
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

			console.log('loaded!!');

		};
		init();
	}
]);
