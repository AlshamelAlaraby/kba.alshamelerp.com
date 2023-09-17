$( function() {

    function isRTL(){
        return $('html').attr('dir') === 'rtl';
    }

    $('.main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: isRTL(),
        dots: false,
        arrows: true,
        nextArrow:"<button type='button' class='slick-next slick-arrow'><img src='./assets/images/icons/arrow-left.svg' alt=''></button>",
        prevArrow:"<button type='button' class='slick-prev slick-arrow'><img src='./assets/images/icons/arrow-right.svg' alt=''></button>",
    });

    // Close menu on click elsewhere
    $(document).on('click', function(e) {
        if (e.target.id !== 'main-nav' || $("#cart").parent().hasClass('show')) {
            $('#main-nav').collapse("hide");
        }
    });

    $("#cart,#login").on('click', function () {
        $('#main-nav').collapse("hide");
    });

    $(".search-mobile").click(function (e) {
        e.preventDefault();
        $(".search-icon").toggleClass("open");
        $("header .form-inline").toggleClass("show-search");
    });

    function createWrapper() {
        if( !$(".categories-slider").hasClass("slick-initialized") ){
            $('.categories .row')
                .children().not(".col-md-3")
                .wrapAll('<div class="categories-slider col-md-9"></div>');
        }
    }

    function createCategorySlider() {
        $(".categories-slider").not(".slick-initialized").slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            centerPadding: '60px',
            rtl: isRTL(),
            dots: false,
            arrows: true,
            nextArrow:"<button type='button' class='slick-next slick-arrow'><img src='./assets/images/icons/arrow-left.svg' alt=''></button>",
            prevArrow:"<button type='button' class='slick-prev slick-arrow'><img src='./assets/images/icons/arrow-right.svg' alt=''></button>",
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    function removeCategorySlider() {
        $(".categories-slider").slick("unslick");
    }
    function removeWrapper() {
        $('.categories .categories-slider')
            .children()
            .unwrap();
    }

    if ($(window).width() < 960) {
        window.addEventListener("load",createWrapper);
        window.addEventListener("load",createCategorySlider);
    }

    window.addEventListener("resize",function () {
        if ($(window).width() < 960) {
            createWrapper();
            createCategorySlider();
        } else {
            removeCategorySlider();
            removeWrapper();
        }
    });

    $('.product-images').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: isRTL(),
        dots: false,
        arrows: true,
        nextArrow:"<button type='button' class='slick-next slick-arrow'><img src='./assets/images/icons/arrow-left.svg' alt=''></button>",
        prevArrow:"<button type='button' class='slick-prev slick-arrow'><img src='./assets/images/icons/arrow-right.svg' alt=''></button>",
        asNavFor: '.product-thumbnail',
        infinite: true,
    });

    $('.product-thumbnail').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        rtl: isRTL(),
        asNavFor: '.product-images',
        dots: false,
        centerMode: true,
        centerPadding: "35px",
        focusOnSelect: true,
    });

    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // Variables
    var player,
        card  = document.querySelector( '.product-trailer' ),
        play  = document.querySelector( '.product-play' ),
        video = document.querySelector( '.product-video' );


    // Shine effect
    if (card){
        card.onmousemove = function (e) {
            var x = e.pageX - card.offsetLeft;
            var y = e.pageY - card.offsetTop;

            card.style.setProperty( '--x', x + 'px' );
            card.style.setProperty( '--y', y + 'px' );
        };
    }


    // Youtube API
    window.onYouTubePlayerAPIReady = function() {
        player = new YT.Player("video", {
            events: {
                onReady: onPlayerReady
            }
        });
    };

    // Player Ready
    function onPlayerReady(event) {
        play.addEventListener("click", function () {
            card.classList.add("video-is-open");
            setTimeout(function () {
                video.style.display = "block";
                event.target.playVideo();
            }, 500);
            $(".statistics").css("margin", "0 45px")
        });
    }


    // (function renderSlider() {
    //     var min_slide = $(".sliderValue[data-min]");
    //     var max_slide = $(".sliderValue[data-max]");
    //     var min = min_slide.data('min');
    //     var max = max_slide.data('max');
    //     var values = [];
    //     values.push(parseInt(min_slide.val()), parseInt(max_slide.val()));
    //
    //     $("#range-slider").slider({
    //         range: true,
    //         min: min,
    //         max: max,
    //         step: 1,
    //         values: values,
    //         slide: function (event, ui) {
    //             for (var i = 0; i < ui.values.length; ++i) {
    //                 $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
    //             }
    //         },
    //         stop: function (event, ui) {
    //             $("input.sliderValue").trigger('change');
    //         }
    //     });
    //
    //     $("input.sliderValue").change(function () {
    //         var $this = $(this);
    //         $("#slider").slider("values", $this.data("index"), $this.val());
    //     });
    // }());

    $(document).on("click", ".deleteAddress", function (e) {
        e.preventDefault();
        if (confirm("Confirm Delete")) {
            var btn = $(this);
            var url_ = btn.attr('href');
            $.ajax({
                url: url_,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result) {
                        toastr.success("Address was deleted successfuly");
                        btn.closest('.col-md-4').fadeOut();
                        btn.closest('.col-md-6').fadeOut();
                    } else {
                        toastr.error("An error occurred while deleting");
                    }
                }
            });
        }
    });
    $(document).on("change", '#CityList', function (e) {
        var city = $(this).val();
        if (city) {
            var areacity = $("#AreaList option:selected").attr('rel');
            if (city != areacity) $("#AreaList").val("");
            $("#AreaList option").hide();
            $("#AreaList option[rel=" + city + "]").show();
        }
    });
    var newAdress = $(".new-address");

    $(".add-new-address,.editAddress").click(function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        newAdress.load(link);
        setTimeout(function (){
            $("#CityList").trigger("change");
        },1000);
        newAdress.slideDown();
    });
    $(document).on('click',".close-address",function (e) {
        e.preventDefault();
        newAdress.slideUp();
    });
    var newCard = $(".newCard");

    $(".add-new-card").click(function (e) {
        e.preventDefault();
        newCard.slideDown();
    });
    $(document).on('click',".close-card",function (e) {
        e.preventDefault();
        newCard.slideUp();
    });


});
export function renderFilterSlider(min, max, min_val, max_val) {
    var values = [];
    values.push(min_val, max_val);

    $("#range-slider").slider({
        range: true,
        min: min,
        max: max,
        step: 1,
        values: values,
        slide: function (event, ui) {
            for (var i = 0; i < ui.values.length; ++i) {
                $("input.sliderValue[data-index=" + i + "]").val(ui.values[i]);
            }
        },
        stop: function (event, ui) {
            $("input.sliderValue").trigger('change');
        }
    });
}
$("input.sliderValue").change(function () {
    var $this = $(this);
    $("#slider").slider("values", $this.data("index"), $this.val());
});
