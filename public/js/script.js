 /*=.=.=.=.=.=.=.=INDEX=.=.=.=.=.=.=.*/

 //slide inicial com banners
 var slideshowDuration = 8000;
 var slideshow = $('.main-content .slideshow');

 function slideshowSwitch(slideshow, index, auto) {
   if (slideshow.data('wait')) return;

   var slides = slideshow.find('.slide');
   var pages = slideshow.find('.pagination');
   var activeSlide = slides.filter('.is-active');
   var activeSlideImage = activeSlide.find('.image-container');
   var newSlide = slides.eq(index);
   var newSlideImage = newSlide.find('.image-container');
   var newSlideContent = newSlide.find('.slide-content');
   var newSlideElements = newSlide.find('.caption > *');
   if (newSlide.is(activeSlide)) return;

   newSlide.addClass('is-new');
   var timeout = slideshow.data('timeout');
   clearTimeout(timeout);
   slideshow.data('wait', true);
   var transition = slideshow.attr('data-transition');
   if (transition == 'fade') {
     newSlide.css({
       display: 'block',
       zIndex: 2
     });
     newSlideImage.css({
       opacity: 0
     });

     TweenMax.to(newSlideImage, 1, {
       alpha: 1,
       onComplete: function() {
         newSlide.addClass('is-active').removeClass('is-new');
         activeSlide.removeClass('is-active');
         newSlide.css({
           display: '',
           zIndex: ''
         });
         newSlideImage.css({
           opacity: ''
         });
         slideshow.find('.pagination').trigger('check');
         slideshow.data('wait', false);
         if (auto) {
           timeout = setTimeout(function() {
             slideshowNext(slideshow, false, true);
           }, slideshowDuration);
           slideshow.data('timeout', timeout);
         }
       }
     });
   } else {
     if (newSlide.index() > activeSlide.index()) {
       var newSlideRight = 0;
       var newSlideLeft = 'auto';
       var newSlideImageRight = -slideshow.width() / 8;
       var newSlideImageLeft = 'auto';
       var newSlideImageToRight = 0;
       var newSlideImageToLeft = 'auto';
       var newSlideContentLeft = 'auto';
       var newSlideContentRight = 0;
       var activeSlideImageLeft = -slideshow.width() / 4;
     } else {
       var newSlideRight = '';
       var newSlideLeft = 0;
       var newSlideImageRight = 'auto';
       var newSlideImageLeft = -slideshow.width() / 8;
       var newSlideImageToRight = '';
       var newSlideImageToLeft = 0;
       var newSlideContentLeft = 0;
       var newSlideContentRight = 'auto';
       var activeSlideImageLeft = slideshow.width() / 4;
     }

     newSlide.css({
       display: 'block',
       width: 0,
       right: newSlideRight,
       left: newSlideLeft,
       zIndex: 2
     });

     newSlideImage.css({
       width: slideshow.width(),
       right: newSlideImageRight,
       left: newSlideImageLeft
     });

     newSlideContent.css({
       width: slideshow.width(),
       left: newSlideContentLeft,
       right: newSlideContentRight
     });

     activeSlideImage.css({
       left: 0
     });

     TweenMax.set(newSlideElements, {
       y: 20,
       force3D: true
     });
     TweenMax.to(activeSlideImage, 1, {
       left: activeSlideImageLeft,
       ease: Power3.easeInOut
     });

     TweenMax.to(newSlide, 1, {
       width: slideshow.width(),
       ease: Power3.easeInOut
     });

     TweenMax.to(newSlideImage, 1, {
       right: newSlideImageToRight,
       left: newSlideImageToLeft,
       ease: Power3.easeInOut
     });

     TweenMax.staggerFromTo(newSlideElements, 0.8, {
       alpha: 0,
       y: 60
     }, {
       alpha: 1,
       y: 0,
       ease: Power3.easeOut,
       force3D: true,
       delay: 0.6
     }, 0.1, function() {
       newSlide.addClass('is-active').removeClass('is-new');
       activeSlide.removeClass('is-active');
       newSlide.css({
         display: '',
         width: '',
         left: '',
         zIndex: ''
       });

       newSlideImage.css({
         width: '',
         right: '',
         left: ''
       });

       newSlideContent.css({
         width: '',
         left: ''
       });

       newSlideElements.css({
         opacity: '',
         transform: ''
       });

       activeSlideImage.css({
         left: ''
       });

       slideshow.find('.pagination').trigger('check');
       slideshow.data('wait', false);
       if (auto) {
         timeout = setTimeout(function() {
           slideshowNext(slideshow, false, true);
         }, slideshowDuration);
         slideshow.data('timeout', timeout);
       }
     });
   }
 }

 function slideshowNext(slideshow, previous, auto) {
   var slides = slideshow.find('.slide');
   var activeSlide = slides.filter('.is-active');
   var newSlide = null;
   if (previous) {
     newSlide = activeSlide.prev('.slide');
     if (newSlide.length === 0) {
       newSlide = slides.last();
     }
   } else {
     newSlide = activeSlide.next('.slide');
     if (newSlide.length == 0)
       newSlide = slides.filter('.slide').first();
   }

   slideshowSwitch(slideshow, newSlide.index(), auto);
 }

 function homeSlideshowParallax() {
   var scrollTop = $(window).scrollTop();
   if (scrollTop > windowHeight) return;
   var inner = slideshow.find('.slideshow-inner');
   var newHeight = windowHeight - (scrollTop / 2);
   var newTop = scrollTop * 0.8;

   inner.css({
     transform: 'translateY(' + newTop + 'px)',
     height: newHeight
   });
 }

 $(document).ready(function() {
   $('.slide').addClass('is-loaded');

   $('.slideshow .arrows .arrow').on('click', function() {
     slideshowNext($(this).closest('.slideshow'), $(this).hasClass('prev'));
   });

   

   $('.slideshow .pagination .item').on('click', function() {
     slideshowSwitch($(this).closest('.slideshow'), $(this).index());
   });

   $('.slideshow .pagination').on('check', function() {
     var slideshow = $(this).closest('.slideshow');
     var pages = $(this).find('.item');
     var index = slideshow.find('.slides .is-active').index();
     pages.removeClass('is-active');
     pages.eq(index).addClass('is-active');
   });

   var timeout = setTimeout(function() {
     slideshowNext(slideshow, false, true);
   }, slideshowDuration);

   slideshow.data('timeout', timeout);
 });

 if ($('.main-content .slideshow').length > 1) {
   $(window).on('scroll', homeSlideshowParallax);
 }


/*=.=.=.=.=.=.=.=ECOMMERCE=.=.=.=.=.=.=.*/
/*Slider de tabela de preço de planos
  Isso faz as setinhas funcionarem manual e automanicamente*/
 $('#recipeCarouselpf').carousel({
   interval: 10000
 })

 $('.carousel .carousel-item').each(function() {
   var minPerSlide = 3;
   var next = $(this).next();
   if (!next.length) {
     next = $(this).siblings(':first');
   }
   next.children(':first-child').clone().appendTo($(this));

   for (var i = 0; i < minPerSlide; i++) {
     next = next.next();
     if (!next.length) {
       next = $(this).siblings(':first');
     }

     next.children(':first-child').clone().appendTo($(this));
   }
 });

/*=.=.=.=.=.=.=.=DASHBOARD=.=.=.=.=.=.=.*/

//adm
$(function(){
    $('.bt-componente').click(function(){
         var id = $(this).attr('id');
         window.location.href = "/simulation?id=" + id;
    });
});

$(function(){
  $('.bt-lead').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/register-patient?id=" + id;
  });
});

//patient
$(function(){
  $('.bt-patient').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/info-patient?id=" + id;
  });
});
$(function(){
  $('.bt-exame-schedule').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/exame-schedule?id=" + id;
  });
});
//doctors
$(function(){
  $('.bt-doctor').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/info-doctor?id=" + id;
  });
});

//urgency
$(function(){
  $('.bt-urgency').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/attendance-urgency-doctor?id=" + id;
  });
});

$(function(){
  $('.bt-info-urgency').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/info-urgency?id=" + id;
  });
});

$(function(){
  $('.bt-finish').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/finish-attendance-urgency-doctor?id=" + id;
  });
});

/*=.=.=.=.=.=.=.=PATIENT=.=.=.=.=.=.=.*/
//edit
$(function(){
  $('#btn-edit-patient').click(function(){
    $('input[name="name"]').removeAttr('readonly');
    $('input[name="email"]').removeAttr('readonly');
    $('input[name="cellphone"]').removeAttr('readonly');
    $('input[name="born_register"]').removeAttr('readonly');
    $('input[name="cellphone"]').removeAttr('readonly');
    $('input[name="cep"]').removeAttr('readonly');
    $('input[name="citty"]').removeAttr('readonly');
    $('input[name="street"]').removeAttr('readonly');
    $('input[name="number"]').removeAttr('readonly');
    $('input[name="district"]').removeAttr('readonly');
    $('#btn-edit-patient').fadeOut('fast');
    $('#btn-save-edit-patient').fadeIn('fast');
    
  });
});

$(function(){
  $('.bt-exame-follow-up').click(function(){
       var id = $(this).attr('id');
       window.location.href = "/follow-up-exame?id=" + id;
  });
});

/*
$(function(){
  $('#btn-save-edit-patient').submit(function(e) {
   
    var confirmado = confirm('Tem certeza de que deseja salvar as alterações?');
    if(confirmado){

    const name = $('input[name="name"]').val();
    const email = $('input[name="email"]').val();
   
  
    $.ajax({
        url: window.location.href = "/save-edit-patient", // caminho para o script que vai processar os dados
        type: 'POST',
        data: {name: name, email: email},
        success: function(response) {
            $('#resp').html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    return false;
  }else{
    alert('Cancelado');
  }
});
});
*/
$(function(){
  $('#btn-save-edit-patient').click(function(){
  
    var confirmado = confirm('Tem certeza de que deseja salvar as alterações?');
    if(confirmado){
      $("#save-edit-patient").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
    
        const name = $('input[name="name"]').val();
        const email = $('input[name="email"]').val();
        alert( $("#save-edit-patient").serialize());
        var url = window.location.href = "/save-edit-patient";
        
        $.ajax({
               type: "POST",
               url: url,
               data:   {name: name, email: email}, // serializes the form's elements.
               dataType: "application/json",
               async: true,
               success: function(data)
               {
                   alert(data); // show response from the php script.
               }
             });
    
        
    });
    }else{
      alert('Cancelado');
    }
    
  });

});

/*
$(function(){
  $('#btn-save-edit-patient').click(function(){
  
    var confirmado = confirm('Tem certeza de que deseja salvar as alterações?');
    if(confirmado){
      $("#save-edit-patient").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
    
        var form =  $("#save-edit-patient").closest('form').serialize();
        alert( $("#save-edit-patient").serialize());
        var url = window.location.href = "/save-edit-patient";
        
        $.ajax({
               type: "POST",
               url: url,
               data:  $("#save-edit-patient").serialize(), // serializes the form's elements.
               dataType: "json",
               success: function(data)
               {
                   //alert(data); // show response from the php script.
               }
             });
    
        
    });
    }else{
      alert('Cancelado');
    }
    
  });

});

*/

// Global defaults
Chart.defaults.global.animation.duration = 2000; // Animation duration
Chart.defaults.global.title.display = false; // Remove title
Chart.defaults.global.defaultFontColor = '#71748c'; // Font color
Chart.defaults.global.defaultFontSize = 13; // Font size for every label

// Tooltip global resets
Chart.defaults.global.tooltips.backgroundColor = '#111827'
Chart.defaults.global.tooltips.borderColor = 'blue'

// Gridlines global resets
Chart.defaults.scale.gridLines.zeroLineColor = '#3b3d56'
Chart.defaults.scale.gridLines.color = '#3b3d56'
Chart.defaults.scale.gridLines.drawBorder = false

// Legend global resets
Chart.defaults.global.legend.labels.padding = 0;
Chart.defaults.global.legend.display = false;

// Ticks global resets
Chart.defaults.scale.ticks.fontSize = 12
Chart.defaults.scale.ticks.fontColor = '#71748c'
Chart.defaults.scale.ticks.beginAtZero = false
Chart.defaults.scale.ticks.padding = 10

// Elements globals
Chart.defaults.global.elements.point.radius = 0

// Responsivess
Chart.defaults.global.responsive = true
Chart.defaults.global.maintainAspectRatio = false


var chart = document.getElementById('chart3');
console.log(chart);
var myChart = new Chart(chart, {
  type: 'line',
  data: {
    labels: ["One", "Two", "Three", "Four", "Five", 'Six', "Seven", "Eight"],
    datasets: [{
      label: "Lost",
      lineTension: 0.2,
      borderColor: '#d9534f',
      borderWidth: 1.5,
      showLine: true,
      data: [3, 30, 16, 30, 16, 36, 21, 40, 20, 30],
      backgroundColor: 'transparent'
    }, {
      label: "Lost",
      lineTension: 0.2,
      borderColor: '#5cb85c',
      borderWidth: 1.5,
      data: [6, 20, 5, 20, 5, 25, 9, 18, 20, 15],
      backgroundColor: 'transparent'
    },
               {
                 label: "Lost",
                 lineTension: 0.2,
                 borderColor: '#f0ad4e',
                 borderWidth: 1.5,
                 data: [12, 20, 15, 20, 5, 35, 10, 15, 35, 25],
                 backgroundColor: 'transparent'
               },
               {
                 label: "Lost",
                 lineTension: 0.2,
                 borderColor: '#337ab7',
                 borderWidth: 1.5,
                 data: [16, 25, 10, 25, 10, 30, 14, 23, 14, 29],
                 backgroundColor: 'transparent'
               }]
  },
  options: {
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false
        },
        ticks: {
          stepSize: 12
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
        },
      }],
    }
  }
})


