var wtVerticalLinks = $('.home #vertical_menu ul li a');
if(wtVerticalLinks.length > 0){
  wtVerticalLinks.each(function(idx , elem){
    $(elem.hash).waypoint({
      handler: function(direction) {
        if(direction == 'down'){
          wtVerticalLinks.each(function(){
            if($(this).hasClass('hovered')){
              $(this).removeClass('hovered');
            }	
          });
          elem.classList.add('hovered');			
          setTimeout(function(){
            if(elem.classList.contains('hovered')){
              elem.classList.remove('hovered');
            }
          }, 2000 );
        }
      },
      offset: '40%'

    });
  })
}
