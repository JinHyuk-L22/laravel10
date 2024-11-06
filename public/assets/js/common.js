$(function (e) {
	$width = $(window).innerWidth(),
    wWidth = windowWidth();

	$(document).ready(function (e) {
        btnTop();
        mainVisual();
        mainCalendar()
        mainNews()
        mainQuickMenu();
        noticeRolling();
        videoRolling();
        sponsorBanner();
        fileUpload();
        popup();
        datepicker();     
        imgMap();
        tableOpen();
		fullpage();

        //갤러리 view 
        if($('.js-gallery-view').length){
            resource_view()
        };  
        
        //인증의찾기
        if ($("div.mapSearch").length){
            mapHover()
        }
        //연혁
        if ($(".history").length) {
            if ($(".historyLine").length == 0) {
                $(".history").append('<div class="historyLine"></div>')
            }
            historyScroll();
            historyOn();
        }

        if ($(".rules-wrap").length){
            ruleMenu_fixed();
            ruleMenu();
        };

		if(wWidth < 1025){
		}else{	
		}
		
		resEvt();
	});

	// resize
	function resEvt() {	  
        if ($(".history").length) {
            historyScroll();
            historyOn(); 
        }
        if ($(".rules-wrap").length){
            ruleMenu_fixed();
            ruleMenu();
        }

		if (wWidth < 1025) {
			mGnb();		
			subConHeight();
			subMenu();
			mTabMenu();

			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').show();
				$('html, body').addClass('ovh');
			}     
			
		} else {		
            gnb();	
			tabMenu();
			if($('.js-dim').hasClass('mobile')){
				$('.js-dim').show();
				$('html, body').removeClass('ovh');
			}
            $('.js-gnb > li > div').removeAttr('style');
            $('.js-sub-menu-list ul').removeAttr('style');
			$('.js-tab-menu, .js-tabcon-menu').removeAttr('style');		
			$('.js-btn-tab-menu').removeClass('on');
			$('body').off('click');
		}

		if(wWidth < 769){
			//touchHelp();
		}
	}

	$(window).resize(function (e) {
		$width = $(window).innerWidth(),
		wWidth = windowWidth();
		resEvt();
	});

	$(window).scroll(function(e){
		if($(this).scrollTop() > 200){
			$('.js-btn-top').addClass('on');
		}else{
			$('.js-btn-top').removeClass('on');
		}

        if ($(".rules-wrap").length){
            ruleMenu_fixed();
        }
        
        if ($("div.years").length){
            years_fixed();
        };
	});
});

function Mobile() {
  return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function windowWidth() {
	if ($(document).innerHeight() > $(window).innerHeight()) {
		if (Mobile()) {
			return $(window).innerWidth();
		} else {
			return $(window).innerWidth() + 17;
		}
	} else {
		return $(window).innerWidth();
	}
}

function subConHeight(){
    $(document).ready(function(e){
        var subConHeight = $(window).outerHeight() - $('.js-header').outerHeight() - $('#footer').outerHeight();
        setTimeout(function(e){
            $('.sub-contents').css('min-height',subConHeight);
        },100);
    });	
}

function fullpage(){	
    if($('.js-fullpage').length){
        $('.js-fullpage').fullpage({
            licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE',
            verticalCentered: true,
            navigation: false,
            navigationPosition: 'right',
            normalScrollElements: '.none-fullpage',
            responsiveWidth: 1240,
            anchors: [
                '1st',
                '2nd',
                '3rd',
                '4th',
                '5th',
            ],
            menu: '.js-fullpage-menu',
            onLeave: function(origin, next , direction){
                if ( next.index != 0 ){
                    $('.main-menu').removeClass('bg');
                }else {
                    $('.main-menu').addClass('bg');
                }
                if ( next.index > 1 ){
                    $('.main-menu').addClass('bk');
                }else {
                    $('.main-menu').removeClass('bk');
                }
                if ( next.index > 3 ){
                    $('.main-menu').addClass('hide');
                    $('.btn-scroll').addClass('hide');
                }else {
                    $('.main-menu').removeClass('hide');
                    $('.btn-scroll').removeClass('hide');
                }
            }
            
        });
    
        $('.js-btn-scroll').click(function () {
            $.fn.fullpage.moveSectionDown();
        });
    }
}

function gnb(){
    $('.js-gnb-list > li > a').off('click');
	$('.js-btn-menu-open').on('click', function (e) {
		$('.js-dim').addClass('pc').show();
		$('.gnb-wrap').stop().animate({ 'right': 0 }, 400);
		$('html, body').addClass('ovh');
		return false;
	});
	$('.js-btn-menu-close, .js-dim').on('click', function (e) {
		$('.js-dim').removeClass('pc').stop().hide();
		$('.gnb-wrap').stop().animate({ 'right': '-100%' }, 400);
		$('html, body').removeClass('ovh');
		return false;
	});
    
    $('.js-gnb-list > li > a').off('click');
	$('.js-gnb-list > li').on('mouseenter',function(e){
        $(this).children('ul').stop().slideDown(400);
        $(this).siblings().children('ul').stop().slideUp(200);
    });
    $('.js-gnb-list').on('mouseleave', function(e){
        $('.js-gnb-list> li > ul').stop().slideUp(200);
    });
}

function mGnb() {
    $('.js-gnb > li').off('mouseenter');
    $('.js-header').off('mouseleave');
	$('.js-btn-menu-open').on('click', function (e) {
		$('.js-dim').addClass('mobile').show();
		$('.gnb-wrap').stop().animate({ 'right': 0 }, 400);
		$('html, body').addClass('ovh');
		return false;
	});
	$('.js-btn-menu-close, .js-dim').on('click', function (e) {
		$('.js-dim').removeClass('mobile').stop().hide();
		$('.gnb-wrap').stop().animate({ 'right': '-100%' }, 400);
		$('html, body').removeClass('ovh');
		return false;
	});
    $('.js-gnb > li > a').off().on('click',function(e){
        if($(this).next('div').length){
            $(this).parent('li').toggleClass('on');
            $(this).next('div').stop().slideToggle();
            $('.js-gnb > li > a').not(this).parent('li').removeClass('on');
            $('.js-gnb > li > a').not(this).next('div').stop().slideUp();
            return false;
        }
    });
}

function mainVisual(){
    $('.js-main-visual').not('.slick-initialized').slick({
        arrows: false,
        dots: true,
        appendDots:$('.main-visual-paging'),
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        customPaging: function(slider, i) { 
            return '<button>' + '0' + (i+1) + '</button><div class="progress"><span></span></div>';
        }
    });
}

function mainCalendar(){
    $('.js-main-calendar').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('#section02 .prev'),
        nextArrow: $('#section02 .next'),
        dots: false,
        infinite:false,
        rows: 2,
        slidesToShow: 3,
        responsive: [
            {
                breakpoint: 1241,
                settings: {
                    rows: 2,
                    slidesToShow: 2,
                }
            }
            ,{
            breakpoint: 769,
                settings: {
                    rows: 1,
                    slidesToShow: 1,
                }
            }
        ]
    });
}

function mainNews(){
    $(".js-main-news").each(function(index, element) {
        $(".js-main-news").on('init', function (event, slick) {
            $(this).find('.slick-slide').removeClass('on');
            $(this).find('.slick-current').addClass('on');
        });
        $(this).not('.slick-initialized').slick({
            arrows: true,
            prevArrow: $(this).parents('.sub-tab-con').find('.prev'),
            nextArrow: $(this).parents('.sub-tab-con').find('.next'),
            dots: true,
            infinite:false,
            slidesToShow: 4,
            appendDots: $(this).parents('.sub-tab-con').find('.dots-wrap'),
            responsive: [
                {
                    breakpoint: 1241,
                    settings: {
                        slidesToShow: 2,
                    }
                }
                ,{
                breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        dots: false,
                    }
                }
            ]
        });
    });
    $(".js-main-news").on('afterChange', function(event, slick, currentSlide, nextSlide){
        $(this).find('.slick-slide').removeClass('on');
        $(this).find('.slick-slide').eq(currentSlide).addClass('on');
    });
    $(".js-main-news .slick-slide").hover(function(){
        $(this).siblings('.slick-slide').removeClass('on');
        $(this).addClass('on');
    });
}

function mainQuickMenu(){
    $('.js-quick-menu').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.btn-rolling-prev'),
        nextArrow: $('.btn-rolling-next'),
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'linear',
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        }]
    });
}

function noticeRolling(){
    $('.js-notice-rolling').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.main-board-wrap .btn-rolling-prev'),
        nextArrow: $('.main-board-wrap .btn-rolling-next'),
        dots: false,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        cssEase: 'linear',
        responsive: [
            {
            breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }
            ,{
            breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });
}

function videoRolling(){
    if($('.video-rolling-wrap').length){
        var swiper = new Swiper(".video-rolling-wrap .swiper-container", {
            centeredSlides: false,
            slidesPerView: 1,  
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 5000,
            },
            loop: true,
            navigation: {
                nextEl: '.video-rolling-wrap .btn-rolling-next',
                prevEl: '.video-rolling-wrap .btn-rolling-prev',
            },
            breakpoints: {        
                768: {                  
                    slidesPerView: 5,
                    centeredSlides: true,
                    effect: 'coverflow',  
                    coverflow: {
                        rotate: 0,
                        stretch: 100,
                        depth: 150,
                        modifier: 1.5,
                        slideShadows : false,
                    },
                }
            },
        });
    }
}

function sponsorBanner(){
    if($('.js-sponsor-rolling a').length > 4){
        $('.js-sponsor-rolling').not('.slick-initialized').slick({
            arrows: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 500,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            responsive: [
                {
                breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                }
                ,{
                breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    } 
}

function subMenu() {
	$('.js-btn-sub-menu').off().on('click', function (e) {
		$(this).next('ul').stop().slideToggle();
		$(this).toggleClass('on');
		return false;
	});
	$('body').off().on('click', function (e){
		if ($('.js-sub-menu-wrap').has(e.target).length == 0){
			$('.js-btn-sub-menu').removeClass('on');
			$('.js-btn-sub-menu:visible +  ul').stop().slideUp();
		}
	});
}

function tableOpen(){
    $('.js-table-open').on('click',function(e){
        $(this).toggleClass('on');
        $(this).next('tr').find('.js-table-open-area').stop().slideToggle();
        $('.js-table-open').not(this).removeClass('on');
        $('.js-table-open').not(this).next('tr').find('.js-table-open-area').stop().slideUp();
        console.log('11')
    });
}

function tabMenu(){
    $('.js-btn-tab-menu').off('click');
    tabConMenu();
}

function tabConMenu(){
    $('.js-tabcon-menu > li').off().on('click',function(e){
        var cnt = $(this).index();
        $(this).addClass('on');
        $(this).siblings().removeClass('on');
        $('.js-tab-con').hide().eq(cnt).stop().fadeIn();
        $('.slick-slider').slick('setPosition');
        return false;
    });
}

function mTabMenu(){
    $('.js-btn-tab-menu').each(function(e){
        var activeTab = $(this).next('ul').children('li.on').children('a').html();
        $(this).html(activeTab);
        $(this).off().on('click',function(e){
            $(this).toggleClass('on');
            $(this).next('ul').stop().slideToggle();
            $('.js-btn-tab-menu').not(this).removeClass('on');
            $('.js-btn-tab-menu').not(this).next('ul').stop().slideUp();
        });
    });
    $('.js-tabcon-menu > li').off().on('click',function(e){     
        var activeTab = $(this).text();
        var cnt = $(this).index();
        $('.type3 .js-btn-tab-menu').text(activeTab);
        $(this).addClass('on');
        $(this).siblings().removeClass('on');
        $('.js-tab-con').hide().eq(cnt).stop().fadeIn();   
        $('.js-btn-tab-menu').removeClass('on');
        if($(this).parent().prev('.js-btn-tab-menu').length){
            $('.js-tabcon-menu').stop().slideUp();
        }
        $('.slick-slider').slick('setPosition');
    });
    
}

function btnTop(){
	$('.js-btn-top').on('click',function(e){
	  $('html, body').stop().animate({'scrollTop':0},400);
		return false;
	});
}

/*
function touchHelp(){
	$('.scroll-x').each(function(e){
		if($(this).height() < 180){
			$(this).addClass('small');
		}
		$(this).scroll(function(e){
			$(this).removeClass('touch-help');
		});
	});
}
*/

function fileUpload(option=null){
    $('.file-upload').each(function(e){
        $(this).parent().find('.upload-name').attr('readonly','readonly');
        $(this).on('change',function(){
            var fileName = $(this).val();
            $(this).parent().find('.upload-name').val(fileName);
        });
    });
}

function popup(){
    $('.js-pop-open').on('click',function(e){
        var popCnt = $(this).attr('href');
        $('html, body').addClass('ovh');
        $(popCnt).css('display','flex');
        return false;
    });
    $('.js-pop-close').on('click',function(e){
        $('html, body').removeClass('ovh');
        $(this).parents('.popup-wrap').css('display','none');
        return false;
    });
    $('.popup-wrap#email').off().on('click', function (e){
		if ($('.popup-contents').has(e.target).length == 0){            
            $('html, body').removeClass('ovh');
			$('.popup-wrap').css('display','none');
		}
	});
}

function datepicker(){
	if($('.datepicker').length){
		$('.datepicker').datepicker({
			dateFormat : "yy-mm-dd",
			dayNamesMin : ["월", "화", "수", "목", "금", "토", "일"],
			monthNamesShort : ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
			showMonthAfterYear: true, 
			changeMonth : true,
			changeYear : true
		});
	}
}

function imgMap(){
    if($('img[usemap]').length){
		$('img[usemap]').rwdImageMaps();
	}
}


//연혁
function historyScroll(){
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var headerH = $("#header").outerHeight();
        var visualH = $(".sub-visual").outerHeight();
        var basicH = headerH + visualH;
        var hisH = $(".history").height ();

        if(scrollTop == $(document).height() - $(window).height()){
            if (wWidth > 960) {
                // 스크롤 끝날때 피씨
                $(".historyLine").css({
                    "height": hisH,
                    "transition": "height 1s"
                });
            } else {
                // 스크롤 끝날때 모바일
                $(".historyLine").css({
                    "height": hisH,
                    "transition": "height 1s"
                });
            }
        } else {
            // 스크롤시
            $(".historyLine").css({
                "height": scrollTop - basicH + 150,
                "transition": "height 0.8s"
            });
        }
        
        historyOn();
    });
    
}

function historyOn(){ 
    var scrollTop = $(window).scrollTop();
    var positionW = $(".history").offset().top;

    var headerH = $("#header").outerHeight();
    var visualH = $(".sub-visual").outerHeight();
    var basicH = headerH + visualH;
    var lineH = scrollTop - basicH + 150;
    
    $('.history .year').each(function(index){
        var positionH3 = $('.history .year').eq(index).offset().top;

        if( lineH + positionW >= positionH3 ){
            $('.history .year').eq(index).addClass('on');
        }else{
            $('.history .year').eq(index).removeClass('on');
        }
    })
}


function ruleMenu_fixed() {
    var scrollValue = $(window).scrollTop(),
        topArea = $('.rules-wrap').offset().top;


    if (scrollValue > topArea) {
        $(".rules-wrap").addClass("fixed");
        $(".rules-menu").addClass("fixed");
    } else {
        $(".rules-wrap").removeClass("fixed");
        $(".rules-menu").removeClass("fixed")
    }
}

function ruleMenu() {
    $(".rules-menu a.prev, .rules-menu a.next").off();
    $(".rules-menu ul, .rules-menu li").removeAttr("style");

    //click
    $(".rules-menu li").on("click", function() {
        $(".rules-menu li").removeClass("on");
        $(this).addClass("on");
    });

    //move
    var win_w = $(window).width(),
        rulesWrapWidth = $(".rules-menu").width(),
        rulesMenuLiWitdh = $(".rules-menu li").outerWidth(),
        rulesMenuWidth = rulesMenuLiWitdh * $(".rules-menu li").length;
    
    var rulesMenuLeft = parseInt($(".rules-menu ul").css("margin-left"));
    
    $(".rules-menu ul").css("width",rulesMenuWidth);

    $(".rules-menu a").on("click", function(){
        var clickBtn = $(this).attr("class");
        rulesMenuLeft = parseInt($(".rules-menu ul").css("margin-left"));
        var basic_w = (rulesMenuWidth + rulesMenuLeft);

        if ( clickBtn == "next" ){
            var newRulesMenuLeft = rulesMenuLeft - rulesMenuLiWitdh;
            if ((basic_w < rulesWrapWidth)) {
            } else {
                $(".rules-menu ul").animate({
                    "margin-left":newRulesMenuLeft
                }, 200);
            }
            return false
        }else if ( clickBtn == "prev" ){                    
            if (rulesMenuLeft >=0) {
            } else {
                var newRulesMenuLeft = rulesMenuLeft + rulesMenuLiWitdh;
                $(".rules-menu ul").animate({
                    "margin-left":newRulesMenuLeft
                }, 200);
            }
            return false
        }else if ( clickBtn == "blockNext" ){
            var newRulesMenuLeft = rulesMenuLeft - (rulesMenuLiWitdh * 2);
            if ((basic_w + rulesMenuLiWitdh) <= rulesWrapWidth) {
                return false;
            } else {
                $(".rules-menu ul").animate({
                    "margin-left":newRulesMenuLeft
                }, 200);
            }
            return false
        }else if ( clickBtn == "blockPrev" ){
            if (rulesMenuLeft >= rulesMenuLiWitdh) {
                return false;
            } else {
                var newRulesMenuLeft = rulesMenuLeft + (rulesMenuLiWitdh * 2);
                $(".rules-menu ul").animate({
                    "margin-left":newRulesMenuLeft
                }, 200);
            }
            return false
        }
    });

}

function years_fixed() {
    scrollValue = $(window).scrollTop();
    yearsTop = $("#header").outerHeight() + $(".sub-visual").outerHeight(true) + $(".sub-tit-wrap").outerHeight(true) + parseInt($(".sub-contents").css("padding-top"));
    
    if (scrollValue > yearsTop) {
        $(".years").addClass("fixed");
    } else{
        $(".years").removeClass("fixed");
    }
}

function resource_view() {
    const visual = $('.gall-view-wrap');
    const progress = $('.gall-progress-bar');
    const initPercent = 100 / ($('.gall-view-wrap').find('img').length);

    progress.css('background-size', initPercent + '% 100%');

    $('.js-gallery-view').not('.slick-initialized').slick({
        arrows: true,
        prevArrow: $('.btn-gall-prev'),
        nextArrow: $('.btn-gall-next'),
        dots: true,
        autoplay: false,
        autoplaySpeed: 3000,
        speed: 1000,
        infinite: false,
        appendDots: $('.gall-cnt-wrap'),
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        customPaging: function (slider, i) {
            return	'<strong class="current">'+(i + 1)+'</strong>' + '<span class="total">'+ slider.slideCount +'</span>';
        }
    });
    visual.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    var calc = ((nextSlide + 1) / slick.slideCount) * 100;
    progress
        .css('background-size', calc + '% 100%')
        .attr('aria-valuenow', calc);
    });
    $('.gall-view-con > a').each(function(e){
        $(this).on('click',function(e){
            var slideSrc = $(this).index();
            $('.js-gallery-view').slick('slickGoTo', slideSrc);
            return false;
        });
    });
}

function mapHover(){
    var mapArea = $("ul.mapList"),
        mapItem = $("ul.mapList li"),
        currItem = $("ul.mapList li.on"),
        currId = currItem.attr("id");
    
    mapArea.addClass(currId);

    mapItem.on("mouseenter", function() {
        mapArea.removeClass(currId);
        var hoverId = $(this).attr("id");
        mapArea.addClass(hoverId);
    });

    mapItem.on("mouseleave", function() {
        mapArea.removeClass();
        mapArea.addClass("mapList");
        mapArea.addClass(currId);
    });
}