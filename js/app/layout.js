app
.directive('imgRow', ['$timeout', function($timeout){
   return {
      restrict: 'A',
      link: function(scope, elt, attrs){
         $timeout(function(){
            var open = false;
            var row = $();
            elt.find('img').each(function(){
               if(!open){
                  row = $('<div class="img-row"></div>');
                  $(this).parent().before(row);
                  open = true;
               }
               if($(this).next().size()==0){
                  open = false;
                  if($(this).parent().html().length == 0){
                     $(this).parent().remove();
                  }
               }
               mask = $('<div class="mask"></div>');
               $(this).appendTo(mask);
               mask.appendTo(row);
            });
            elt.find('.img-row').each(function(){
               var imgs = $(this).find('.mask');
               var n = imgs.size();
               imgs.css({
                  width : 100/n + '%',
               });
            });
         });
      }
   };
}]);
