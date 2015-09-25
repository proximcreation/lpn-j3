app.
directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
}).
directive('autoheight', ['$timeout', function($timeout){
   return {
      restrict: 'A',
      link: function(scope, element, attrs){
         var elt = element[0];
         $(document).ready(function(){
            $timeout(function(){
               if(attrs.what === 'children'){
                  if(attrs.copy === undefined){
                     $(elt).children().height($(elt).children().first().width()*attrs.rh/attrs.rw)
                  }
                  else{
                     $(elt).children().height($(attrs.copy).height() + parseFloat($(attrs.copy).css('padding-top')) + parseFloat($(attrs.copy).css('padding-bottom')));
                  }
               }
               else{
                  if(attrs.copy === undefined){
                     $(elt).height($(elt).width()*attrs.rh/attrs.rw);
                  }
                  else{
                     $(elt).height($(attrs.copy).height() + parseFloat($(attrs.copy).css('padding-top')) + parseFloat($(attrs.copy).css('padding-bottom')));
                  }
               }
            },500);
         });
      }
   };
}]).
directive('screenWatch', ['$window', function($window) {
    return {
        restrict : 'A',
        link : function (scope, element, attrs) {
            $(window).resize(function(){
                // console.log($(window).innerWidth());
                scope.$apply(
                    function() {
                        scope.client.screen = {
                            ih : $(window).innerHeight(),
                            iw : $(window).innerWidth(),
                            ri : $(window).innerWidth()/$(window).innerHeight(),
                            h : $window.outerHeight,
                            w: $window.outerWidth,
                            r : $window.outerWidth/$window.outerHeight
                        };
                    }
                );
            });
        }
    };
}]).
directive('scrollWatch', ['$window', function($window) {
    return {
        restrict : 'A',
        link : function (scope, element, attrs) {
            $(window).scroll(function(){
                scope.$apply(function() {
                     scope.scroll = {
                         x : $window.scrollX,
                         y : $window.scrollY
                     };
                 });
            });
        }
    };
}]).
directive('attachedMenu', ['$window', function($window) {
   return {
      restrict : 'A',
      link : function (scope, element, attrs) {
         // var elt = element[0];
         // scope.base = $(elt).offset().top;
         // $(window).scroll(function(){
         //    scope.$apply(function() {
         //       if(scope.base < $window.scrollY){
         //          $(elt).addClass("fixed");
         //       }
         //       else{
         //          $(elt).removeClass("fixed");
         //       }
         //    });
         // });
      }
   };
}]).
directive('horizontalScroll', ['$window', function($window){
    return {
        restrict: 'A',
        link : function(scope, element, attrs) {
            function scrollHorizontally(e) {
                d = 100;
                e = $window.event || e;
                var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

                var slider = $(element[0]);
                slider.each(function(){
                    var s = $(this).scrollLeft();
                    $(this).scrollLeft(s - delta*d);
                });

                e.preventDefault();
            }
            if (window.addEventListener) {
                // IE9, Chrome, Safari, Opera
                window.addEventListener("mousewheel", scrollHorizontally, false);
                // Firefox
                window.addEventListener("DOMMouseScroll", scrollHorizontally, false);
            } else {
                // IE 6/7/8
                window.attachEvent("onmousewheel", scrollHorizontally);
            }
        }
    };
}]);
