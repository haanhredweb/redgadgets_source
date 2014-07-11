var j = jQuery.noConflict();
j(document).ready(function(){

    // Params from module
    var galleryMinSlides = num_of_thumbnails;
    var galleryMaxSlides = num_of_thumbnails;

    // Global params for slider and gallery handle
    var bxslider;
    var gallery;
    var curSlideIdx = 0; // Current slide index
    var beginGallerySlideIdx = 0; // Current index of first slide in gallery

    if (thumbnail == 0)
    {
        thumbnail_controls = 0;
    }

    var slide_width = window['slide_width_' + module_id];

    bxslider = eval(getBxsliderStr(slide_width));

    gallery = j('.gallery_'. module_id).bxSlider({
        slideWidth: thumbnail_width,
        adaptiveHeight: true,
        minSlides: galleryMinSlides,
        maxSlides: galleryMaxSlides,
        slideMargin: 5,
        pagerCustom: '#bx-pager',
        controls: thumbnail_controls,
        infiniteLoop: true,
        onSliderLoad: function(){
            j('.gallery .slide a img').css('border', '3px solid transparent');
            j('.gallery .slide a[data-slide-index="0"] img').css('border', '3px solid red');
        },
        onSlideNext: function(){
            beginGallerySlideIdx += galleryMaxSlides;
            if(beginGallerySlideIdx >= gallery.getSlideCount())
            {
                beginGallerySlideIdx = 0;
            }
        },
        onSlidePrev: function(){
            beginGallerySlideIdx -= galleryMaxSlides;
            if(beginGallerySlideIdx < 0)
            {
                beginGallerySlideIdx = gallery.getSlideCount() - (gallery.getSlideCount() % galleryMaxSlides);
            }
        }
    });

    j('.gallery .slide a').click(function(){
        j('.gallery .slide a[data-slide-index="' + curSlideIdx + '"] img').css('border', '3px solid transparent');
        curSlideIdx = j(this).attr('data-slide-index');
        j('.gallery .slide a[data-slide-index="' + curSlideIdx + '"] img').css('border', '3px solid red');
        bxslider.goToSlide(curSlideIdx);
    });

    // Check if the current slide appear in gallery bar
    var isCurSlideAppearInGallery = function()
    {
        var result = false;

        temp = curSlideIdx - beginGallerySlideIdx;
        if(gallery.getSlideCount() - beginGallerySlideIdx < galleryMaxSlides
            && curSlideIdx < beginGallerySlideIdx)
        {
            temp += gallery.getSlideCount();
        }

        if(0 <= temp && temp < galleryMaxSlides)
        {
            result = true;
        }

        return result;
    };
});

function getBxsliderStr(slideWidth)
{
    var strSlideWidth = "";

    if (slideWidth != 0)
    {
        strSlideWidth = "slideWidth: " + slideWidth + ",";
    }

    var strCommand = "j('.bxslider_" + module_id + "').bxSlider({" +
        strSlideWidth +
        "adaptiveHeight: adaptive_height," +
        "mode: animation_effect," +
        "captions: true," +
        "speed: transition_duration," +
        "pause: display_time," +
        "auto: auto_play," +
        "autoHover: pause_when_mouseover," +
        "autoControls: false," +
        "controls: bxslider_controls," +
        "video: true," +
        "useCSS: true," +
        "responsive: true," +
        "pager: pager," +
        "onSlideNext: function(){" +
            "if(thumbnail)" +
            "{" +
                "j('.gallery .slide a[data-slide-index=\"' + curSlideIdx + '\"] img').css('border', '3px solid transparent');" +
                "curSlideIdx ++;" +
                "if(curSlideIdx == bxslider.getSlideCount())" +
                "{" +
                    "curSlideIdx = 0;" +
                "}" +
                "j('.gallery .slide a[data-slide-index=\"' + curSlideIdx + '\"] img').css('border', '3px solid red');" +

                "if(isCurSlideAppearInGallery() == false)" +
                "{" +
                    "gallery.goToNextSlide();" +
                "}" +
            "}" +
        "}," +
        "onSlidePrev: function(){" +
            "if(thumbnail)" +
            "{" +
                "j('.gallery .slide a[data-slide-index=\"' + curSlideIdx + '\"] img').css('border', '3px solid transparent');" +
                "curSlideIdx --;" +
                "if(curSlideIdx == -1)" +
                "{" +
                    "curSlideIdx = bxslider.getSlideCount() - 1;" +
                "}" +
                "j('.gallery .slide a[data-slide-index=\"' + curSlideIdx + '\"] img').css('border', '3px solid red');" +

                "if(isCurSlideAppearInGallery() == false)" +
                "{" +
                    "gallery.goToPrevSlide();" +
                "}" +
            "}" +
        "}" +
    "});";

    return strCommand;
}

