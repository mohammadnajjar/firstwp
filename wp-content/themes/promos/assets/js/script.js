(function ($) {
    "use strict";
    //Js code for search box

    $(".first_click").on("click", function () {
        $(".search-box-text").addClass("search_box");
        $(".search-wrapper").addClass("hide-show");
        $(".search-box-text").addClass("SlideUpIn");
        $(".search-box-text").removeClass("SlideDownOut");
    });
    $(".second_click").on("click", function () {
        $(".search-box-text").removeClass("search_box");
        $(".search-wrapper").removeClass("hide-show");
        $(".search-box-text").removeClass("SlideUpIn");
        $(".search-box-text").addClass("SlideDownOut");
    });



    $(window).on('scroll', function () {
        if ($(this).scrollTop > 100) {
            $('.main-navigation').addClass('affix');
        }
        else {
            $('.main-navigation').removeClass('affix');
        }
    });
    /* ========== Menu icon color ========== */
    $('.main-menu-icon').css('color', function () {
        var iconColorAttr = $(this).data('fa-color');
        return iconColorAttr;
    });
    /* ========== Horizontal navigation menu ========== */
    if ($('.main-header').length) {
        var mainHeader = $('.main-header'),
            mainHeaderHeight = mainHeader.height(),
            menu_toggle = mainHeader.find('.bar-menu'),
            mainMenuListWrapper = $('.main-menu > ul'),
            mainMenuListDropdown = $('.main-menu ul li:has(ul)');

        /* ========== Dropdown Menu Toggle ========== */
         menu_toggle.click(function(){
            mainMenuListWrapper.slideToggle();
            $('.site-navigation').toggleClass('menu-open');
            $(this).toggleClass('active');
        });

        mainMenuListDropdown.each(function () {
            $(this).append('<span class="dropdown-plus"></span>');
            $(this).addClass('dropdown_menu');
        });

        $('.dropdown-plus').on("click", function () {
            $(this).prev('ul').slideToggle(300);
            $(this).toggleClass('dropdown-open');
        });

        $('.dropdown_menu a').append('<span></span>');
    }

    /*--------------------------------------------------------------
 Keyboard Navigation
----------------------------------------------------------------*/
if ($(window).width() < 1024) {
    $("#primary-menu")
      .find("li")
      .last()
      .bind("keydown", function (e) {
        if (e.which === 9) {
          e.preventDefault();
          $("#site-navigation").find(".bar-menu").focus();
        }
      });

    $("#primary-menu > li:last-child button:not(.active)").bind("keydown", function (e) {
      if (e.which === 9) {
        e.preventDefault();
        $("#site-navigation").find(".bar-menu").focus();
      }
    });
} else {
    $("#primary-menu").find("li").unbind("keydown");
}
menu_toggle.on('keydown', function (e) {
    var tabKey = e.keyCode === 9;
    var shiftKey = e.shiftKey;

    if( menu_toggle.hasClass('active') ) {
        if ( shiftKey && tabKey ) {
            e.preventDefault();
            mainMenuListWrapper.slideUp();
            $('#site-navigation').removeClass('menu-open');
            menu_toggle.removeClass('active');
        };
    }
});
    
})(jQuery);