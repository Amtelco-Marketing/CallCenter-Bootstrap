/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

    var stateManager = (function () {
      var state = null;

      var setState = function () {
        if ($('body').width() < 0) {
          if (state !== "mobile") {
            state = "mobile";
            displayMobile();
          }
        }
        else {
          if (state !== "desktop") {
            state = "desktop";
            displayDesktop();
          }
        }
      };

      var displayMobile = function () {
        //When mobile state is shown this fires

      };

      var displayDesktop = function () {
        // http://jsfiddle.net/jezzipin/JJ8Jc/
        $(function(){
          $('#header').data('size','big');
        });

        $(window).scroll(function(){
            if($(document).scrollTop() > 0)
            {
                if($('#header').data('size') == 'big')
                {
                    $('#header').data('size','small');
                    $('#header').addClass('scrolled');
                    $('.main-container').stop().animate({
                        'margin-top': '0'
                    }, 600);
                }
            }
            else
            {
                if($('#header').data('size') == 'small')
                {
                    $('#header').data('size','big');
                    $('#header').removeClass('scrolled');
                    $('.main-container').stop().animate({
                        'margin-top': $('#header').height()
                    }, 600);
                }
            }
        });
      };

      return {
        init: function () {
          setState();
        },
        getState: function () {
          return state;
        }
      };

    } ());

    (function(window){
      stateManager.init();
    }(window, undefined));
  }
};


})(jQuery, Drupal, this, this.document);
