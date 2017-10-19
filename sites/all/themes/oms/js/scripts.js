(function($) {
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
            $('.node-full .field-name-body .field-item').expander({
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
        }

    }


    $(document).ready(function(){
        STNScript.expanderStoryDetail();
        STNScript.createButtonViewChapter();
        STNScript.mobileMenu();
    })
    $(window).on('load',function(){
        STNScript.autoHeight();

        $(window).resize(function () {
            STNScript.autoHeight();
        })
    })
})(jQuery)