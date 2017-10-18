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
            STNScript.equalHeight('.category-list .views-row');
            STNScript.equalHeight('.view-goi-dich-vu .views-row');
            STNScript.equalHeight('.home-highlight-box3 .row>.col-md-3');
            STNScript.equalHeight('.view-news.view-display-id-page_2 .view-news .views-row,.view-news.view-display-id-page_1 .view-news .views-row');
            STNScript.equalHeight('.view-gallery .views-row');
        },

        createMenuMobile:function(){
            $( "#navigation" ).clone().appendTo( ".mobile-menu-container" );
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
        }

    }


    $(document).ready(function(){
        STNScript.expanderStoryDetail();
        STNScript.createButtonViewChapter();
        STNScript.createMenuMobile();


    })
    $(window).on('load',function(){
        STNScript.autoHeight();

        $(window).resize(function () {
            STNScript.autoHeight();
        })
    })
})(jQuery)