/* jquery.nav-main.js
 *  requires _nav-main.less
 * */

(function( $ ){

  var navMain = navMain || {};

  //  Default config settings

  navMain.config = {
    wrapper : '.wrapper'
   ,container : '#js-content'
   ,header : '.header__main'
   ,content : '.content'
   ,nav: '#js-nav'
   ,button : '#js-nav-button'
  };

  navMain.init = function() {

    //  Load Config
    $.extend(navMain.config, window.myconfig);

    //  Hide navigation if JS available
    $(navMain.config.header).addClass("is-expand");
    $(navMain.config.content).addClass("is-expand");
    $(navMain.config.nav).addClass("is-nav-inactive");

    //  Add event listener for changeState
    $(navMain.config.button).on("click", function(){
      navMain.changeState();
    });

  };

  navMain.changeState = function() {

    //  Toggle presentation class
    $(navMain.config.content).toggleClass("is-expand");
    $(navMain.config.header).toggleClass("is-expand");
    $(navMain.config.nav).toggleClass("is-nav-inactive");

  };

  //  Initialise and extend on page load

  $(document).ready(function() {

    // To extend the default config settings
    // add an object to `window.myconfig`
    // eg. window.myconfig = { wrapper: '#js-wrapper'};

    navMain.init();

  });

})( jQuery );
