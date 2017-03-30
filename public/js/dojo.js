
$(function(){
  $('.timer').startTimer({
    onComplete: function(element){
      $('html, body').addClass('bodyTimeoutBackground');
      window.location.href="/submit?submit=1";
    
    }
  });
})

