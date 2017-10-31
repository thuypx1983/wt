(function($) {
    var current_font_size=16;
    var STNScript = {

        // Equal height function
        // Replace "obj" param with your selector
        equalHeight: function (obj) {
            var currentTallest = 0,
                currentRowStart = 0,
                rowDivs = [],
                $el,
                topPosition = 0;
            $(obj).each(function () {

                $el = $(this);
                $el.height('auto');
                topPostion = $el.offset().top;

                if (currentRowStart != topPostion) {
                    for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                        rowDivs[currentDiv].height(currentTallest);
                    }
                    rowDivs.length = 0;
                    currentRowStart = topPostion;
                    currentTallest = $el.height();
                    rowDivs.push($el);
                } else {
                    rowDivs.push($el);
                    currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                }
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
            });
        },
        //


        autoHeight:function(){
            STNScript.equalHeight('.block-highlight .views-row');
            STNScript.equalHeight('.view-tim-kiem >.view-content .views-row');
        },
         isMobile:function () {
            var w=$(window).width();
            if(w<=990){
                return true;
            }
            return false;
        },
        
        createButtonViewChapter:function () {
            var firstChapter="";
            var first_row=$('.view-display-id-block_all .views-row:first');
            var first_chapter_url="#";
            if(first_row.length==1){
                var first_chapter_url=first_row.find('a').attr('href');
            }
            var html="<div class='view-chapter'>" +
                "<a href='#block-views-chapter-block-all'><i class='fa fa-list'></i> DS Chương</a>" +
                "<a href=\""+first_chapter_url+"\"><i class='fa fa-eye'></i> Đọc truyện</a></div>";
            $('.field-name-field-rating').after(html);
        },

        expanderStoryDetail:function(){
            $('.node-type-story .node-full .field-name-body .field-item').expander({
                slicePoint: 450,
                expandEffect: 'slideDown',
                window:5,
                expandText:'Xem thêm',
                userCollapseText: 'Đóng lại',
                afterCollapse:function(){
                    location.href = "#block-system-main";
                }
            });
        },
        mobileMenu:function () {
            $('.mobile-menu').click(function(){
                $('.all-menu').toggleClass('open');
            })
        },
        fontSize:function (x) {
            var content=$('.field-name-body');
            current_font_size=parseInt(current_font_size)+(x);
            $.cookie('chapter_font_size', current_font_size, { expires: 7 });
            content.css('font-size',current_font_size+'px');
        }
        ,

        settingContent:function () {
            if($('body.node-type-chapter').length!=1) return;

            var content=$('.field-name-body');
            //init
            if($.cookie('chapter_background_color')){
                $('.group-row').css('background-color','#'+$.cookie('chapter_background_color'));
                $('#maunen').val($.cookie('chapter_background_color'));
                if($.cookie('chapter_background_color')=='262626'){
                    $('.group-row').css('color','#fff');
                }
            }
            if($.cookie('chapter_font_family')){
                content.css('font-family',$.cookie('chapter_font_family'));
                $('#fontfa').val($.cookie('chapter_font_family'));
            }
            if($.cookie('chapter_line_height')){
                content.css('line-height',$.cookie('chapter_line_height')+'%');
                $('#fonthe').val($.cookie('chapter_line_height'));
            }
            if($.cookie('chapter_font_size')){
                content.css('font-size',$.cookie('chapter_font_size')+'px');
                current_font_size=$.cookie('chapter_font_size');
            }

            $('.btn-setting').click(function(){
                $('.setting-container').toggleClass('open');
            })

            $('#maunen').change(function(){
                $('.group-row').css('background-color','#'+$(this).val());
                $.cookie('chapter_background_color', $(this).val(), { expires: 7 });
                if($(this).val()=='262626'){
                    $('.group-row').css('color','#fff');
                }else{
                    $('.group-row').css('color','');
                }

            })
            $('#fontfa').change(function(){
                content.css('font-family',$(this).val());
                $.cookie('chapter_font_family', $(this).val(), { expires: 7 });
            })
            $('#fonthe').change(function(){
                content.css('line-height',$(this).val()+'%');
                $.cookie('chapter_line_height', $(this).val(), { expires: 7 });
            })
            $('.node-type-chapter .fa-search-plus').click(function () {
                STNScript.fontSize(2);
            })
            $('.node-type-chapter .fa-search-minus').click(function () {
                STNScript.fontSize(-2);
            })
        },
        
        addToFavorites:function () {
            $('.btn-add-favorites').click(function () {
                if($('#edit-submit--2').length==1){
                    $('#edit-submit--2').trigger('click');
                }else{
                    $('#login-popup').trigger('click');
                }
            })
        },
        chapterError:function () {
            $('body').on('click','#webform-client-form-1204772 .form-submit',function(){
                $(document).find('#edit-submitted-chapter').val(window.location.href);
            })
        }


    }

    $(document).ready(function(){
        STNScript.expanderStoryDetail();
        STNScript.createButtonViewChapter();
        STNScript.mobileMenu();
        STNScript.settingContent();
        STNScript.addToFavorites();
        STNScript.chapterError();
        $('.block-main-hot-story .view-content').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            slidesToShow: 2,
            slidesToScroll: 2,
            mobileFirst:true,
            prevArrow:'<i class="fa fa-angle-left"></i>',
            nextArrow:'<i class="fa fa-angle-right"></i>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: "unslick"
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


    })
    $(window).on('load',function(){
        STNScript.autoHeight();

        $(window).resize(function () {
            STNScript.autoHeight();
        })
    })
})(jQuery)