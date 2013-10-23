/*  --  Section Navigation  --  */

(function( $ ){

  var sectionNav = sectionNav || {};

  sectionNav.config = {
    'parent': '#js-section-nav'
   ,'contracted': 'nav__section--contracted'
   ,'expanded': 'nav__section--expanded'
  };

  //  Set all li with child as closed
  sectionNav.init = function(config) {

    // provide for custom configuration via init()
    if (config && typeof(config) === 'object') {
      $.extend(sectionNav.config, config);
    }

    // Get all li in section
    $(sectionNav.config.parent).each(function(){

      $(this).find('li').each(function(){

        //  Check to see if element has child list
        if ($(this).children('ul').length > 0) {
          $(this).addClass(sectionNav.config.contracted);  //  Add status indicator
          $(this).children('ul').addClass('visuallyhidden focusable');  //  Hide child lists
        }

      });

    });

    // Add Event listeners

    $(sectionNav.config.parent + ' a').on('click', function(e) {

      if ($(this).parent('li').children('ul').length > 0) {

        switch ($(this).parents('li').hasClass(sectionNav.config.contracted)) {
        case true:
          //  Open List
          $(this).parents('li').children('ul').removeClass('visuallyhidden focusable');
          $(this).parents('li').removeClass(sectionNav.config.contracted).addClass(sectionNav.config.expanded);
          break;

        case false:
          //  Close list
          $(this).parent('li').children('ul').addClass('visuallyhidden focusable');
          $(this).parent('li').removeClass(sectionNav.config.expanded).addClass(sectionNav.config.contracted);
          break;
        }

        e.preventDefault();
      }

    });

  };

  //  OnLoad
  $(document).ready(function() {

    // To extend the default config settings
    // pass a object as an argument for the init function
    // eg. sectionNav.init({ 'parent': '#js-section-nav'});
    sectionNav.init({'parent': '.product-categories'});

  });

})( jQuery );