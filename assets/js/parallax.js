$(window).scroll(function(){

  var wScroll = $(this).scrollTop();

  $('.largeLogo').css({
    'transform' : 'translate(0px, '+ wScroll /2 +'%)'
  });

  $('.fg-element01').css({
    'transform' : 'translate(0px, '+ wScroll /20 +'%)'
  });

  $('.bg-element01').css({
    'transform' : 'translate(0px, '+ wScroll /50 +'%)'
  });

  $('.bg-element02').css({
      'transform' : 'translate(0px, '+ wScroll /50 +'%)'
  });

  $('.foreground').css({
    'transform' : 'translate(0px, -'+ wScroll /40 +'%)'
  });

});
