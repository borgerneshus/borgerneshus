/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*! Main */
+function ($) {


jQuery(document).scroll(function(e){
    /*
     * Keep navnbar on top while scrolling
     */
    /*var scrollTop = jQuery(document).scrollTop();
    if(scrollTop > 0){
        jQuery('.navbar').removeClass('navbar-static-top').addClass('navbar-fixed-top');
    } else {
        jQuery('.navbar').removeClass('navbar-fixed-top').addClass('navbar-static-top');
    }*/
});

    Drupal.behaviors.resetSearch = {
        attach: function (context) {
            if ($('#search_input').exists() && $.fn.fastLiveFilter !== undefined) {
                $('#search_input').fastLiveFilter('.fastfilter');
            }
        }
    };

/*
 * Main ready
 */
jQuery(document).ready(function(){
    backgroundImageSourceCredit();
    var isiOS = (navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone'));
    var isAndroid = navigator.userAgent.match('Android');
    var isWP = navigator.userAgent.match('Windows Phone') || navigator.userAgent.match('IEMobile');
    if($('.icon-margin.fa.fa-map-marker.fa-2x').length != 0)
    {
        var map = $('#map_data').html();
        var map_display = $('#map').html();
        $('#map').remove();
        $('#map_data').remove();
        if (isiOS) {

            $('.icon-margin.fa.fa-map-marker.fa-2x').after('<a href="http://maps.apple.com/?saddr=Current%20Location&daddr=Odense,' + $.trim(map) + '">' + map_display + '(Vis vej)</a> ');

        } else if (isAndroid) {
            $('.icon-margin.fa.fa-map-marker.fa-2x').after('<a href="http://maps.google.com/?saddr=Current%20Location&daddr=Odense,' + $.trim(map) + '">' + map_display + '(Vis vej)</a> '); 

        } else if (isWP) {
            $('.icon-margin.fa.fa-map-marker.fa-2x').after('<a href="maps:' + $.trim(map) + '">' + map + '(Vis vej)</a> ');
        }
        else {    // if (isOtherPlatform)
            $('.icon-margin.fa.fa-map-marker.fa-2x').after('<a href="http://maps.google.com/?saddr=Current%20Location&daddr=Odense,' + $.trim(map) + '">' + map_display + '(Vis vej)</a> ');
        }
    }
    else
    {
        /*
         * Look for list map-data
         */
        $('.List-map-link').each(function()
        {
            var isiOS = (navigator.userAgent.match('iPad') || navigator.userAgent.match('iPhone'));
            var isAndroid = navigator.userAgent.match('Android');
            var isWP = navigator.userAgent.match('Windows Phone') || navigator.userAgent.match('IEMobile');
            
            var map = $(this).find('#map_data').html();
            var map_display = $(this).find('#map').html();
            

            if (isiOS) {

            $(this).after('<a href="http://maps.apple.com/?saddr=Current%20Location&daddr=' + $.trim(map) + '">' + map_display + '(Vis vej)</a> ');

            } else if (isAndroid) {
                $(this).after('<a href="http://maps.google.com/?saddr=Current%20Location&daddr=' + $.trim(map) + '">' + map_display + '(Vis vej)</a> '); 

            } else if (isWP) {
                $(this).after('<a href="maps:' + $.trim(map) + '">' + map + '</a> ');
            }
            else {    // if (isOtherPlatform)
                $(this).after('<a href="http://maps.google.com/?saddr=Current%20Location&daddr=' + $.trim(map) + '">' + map_display + '(Vis vej)</a> ');
            }
            $(this).find('#map').remove();
        });
    }
    /*
     * Some Mobile adaptations
     */
    if(isiOS || isAndroid || isWP)
    {
       $(".pane-better-jump-menu").toggleClass('js-hide');
       $(".pane-menu-arrangement-menu").toggleClass('js-hide');
    }
    /*
     * Make translation dialog close on selection
     */
    jQuery('body').on('click','.gtflag',function(){
        jQuery('#gtranslate').modal('hide');
    });
    jQuery('body').on('click','.nturl',function(){
        jQuery('#gtranslate').modal('hide');
    });
        if ($('iframe').exists()) {
           //resizeIframe($('iframe'));
           // $('iframe').attr('style', 'position: absolute; left: 0px; top: 0px; width: 90%; height: 100%');
           // $('iframe').parent().attr('style', 'position: relative; width: 100%; height: 0px; padding-bottom: 60%;');
        }

    checkSize();
    // run test on resize of the window
    $(window).resize(checkSize);
        
});


    jQuery.fn.exists = function () {
        return this.length > 0;
    };


    function checkSize() {
        //$('.pane-page-content').css("height", $(document).height() - 270);

        if ($(window).width() < 768) {

            if ($(window).width() < 768) {
                /*
                 * Rearrange blocks on mobile
                 */
                $('.col-lg-4 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').prependTo($('.col-lg-8 .col-md-8 .col-sm-8 .col-xs-12 .col-xs-height .col-full-height').parent());
                $('h2').prependTo($('.col-lg-8 .col-md-8 .col-sm-8 .col-xs-12 .col-xs-height .col-full-height').parent());

            } else {

                $('.col-lg-8 .col-md-8 .col-sm-8 .col-xs-12 .col-xs-height .col-full-height').prependTo($('.col-lg-4 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').parent());
                $('.col-lg-4 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').prependTo($('h2').parent());
            }

            $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());
        } else {

            $('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());
        }
    };
    
    function backgroundImageSourceCredit()
    {
        //Insert the source credit from the settings.
       var image_credit = Drupal.settings.oc_harrypotter.img_src;
       var html = $('<div class="oc-bg-img-credit hidden-xs" >Foto: '+image_credit+'</div>');
       $('#footer').before(html);
    }

 }(jQuery);
 function resizeIframe(iframe) {
    iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
}