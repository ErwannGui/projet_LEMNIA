/*
    Script originel de pinzon1992 remodifié pour convenir à notre charte graphique
    (https://www.jqueryscript.net/table/jQuery-Table-Pagination-For-Materialize.html)
*/

$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            activeColor: 'blue',
            prevText:'Précédent',
            nextText:'Suivant',
            showPrevNext:true,
            hidePageNumbers:false,
            perPage:10
        },
        settings = $.extend(defaults, opts);

    var listElement = $this;
    var perPage = settings.perPage;
    var children = listElement.children();
    var pager = $('.pager');

    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }

    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }

    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);
    
    $("#total_reg").html(numItems+" éléments");

    pager.data("curr",0);

    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link" title="'+settings.prevText+'"><i class="material-icons">chevron_left</i></a></li>').appendTo(pager);
    }

    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        
        if(curr < 5){
            if(curr == 0){
                $('<li id="page_num_'+(curr+1)+'" class="z-depth-3 first_page"><a class="page_link black-text" >'+(curr+1)+'</a></li>').appendTo(pager);
            }
            else if(curr == 4){
                $('<li id="page_num_'+(curr+1)+'" class="z-depth-3 last_page"><a class="page_link black-text" >'+(curr+1)+'</a></li>').appendTo(pager);
            }
            else {
                $('<li id="page_num_'+(curr+1)+'" class="z-depth-3"><a class="page_link black-text" >'+(curr+1)+'</a></li>').appendTo(pager);
            }
            curr++;
        }
        else {
            $('<li class="z-depth-3 more_pages"><a class="black-text" disabled>...</a></li>').appendTo(pager);
            break;
        }  

        
        //Default :

        /*$('<li class="z-depth-3"><a class="page_link black-text" >'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;*/
    }

    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link"  title="'+settings.nextText+'"><i class="material-icons">chevron_right</i></a></li>').appendTo(pager);
    }

    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }

  	pager.children().eq(1).addClass("active "+settings.activeColor);

    children.hide();
    children.slice(0, perPage).show();

    $('.page_link').click(clickable);

    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });

    function clickable() {
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    }

    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        // Boucle afin d'afficher les bonnes paginations
        if ($('.first_page').hasClass('active')) {
            $('.last_page').removeClass('last_page');
            $('.first_page').removeClass('first_page');
            $('#page_num_'+(goToPage+6)+'').hide();
            $('#page_num_'+(goToPage+1)+'').addClass('first_page');
            $('#page_num_'+(goToPage+5)+'').addClass('last_page');
            $('#page_num_'+(goToPage+1)+'').show();
        }
        $('.page_link').click(clickable);
        goTo(goToPage);
    }

    var passed = false;

    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        // Boucle afin d'ajouter les paginatins manquantes quand c'est necessaire et les afficher
        if ($('.last_page').hasClass('active')) {
            $('.first_page').removeClass('first_page');
            if (($('.last_page').prop('id') == 'page_num_5') && (passed != true)) {
                $('.last_page').removeClass('last_page');
                var newPager = '<li id="page_num_'+(goToPage+1)+'" class="z-depth-3 last_page"><a class="page_link black-text" >'+(goToPage+1)+'</a></li>';
                $(newPager).insertBefore($('.more_pages'));
                passed = true;
            }
            else {
                $('.last_page').removeClass('last_page');
                if (document.getElementById('page_num_'+(goToPage+1)+'')) {
                    $('#page_num_'+(goToPage+1)+'').addClass('last_page').show();
                }
                else {
                    var newPager = '<li id="page_num_'+(goToPage+1)+'" class="z-depth-3 last_page"><a class="page_link black-text" >'+(goToPage+1)+'</a></li>';
                    $(newPager).insertBefore($('.more_pages'));
                }
            }
            $('#page_num_'+(goToPage-3)+'').addClass('first_page');
            $('#page_num_'+(goToPage-4)+'').hide();
        }
        $('.page_link').click(clickable);
        goTo(goToPage);
    }

    function goTo(page){
        var startAt = page * perPage,
            endOn = (parseInt(startAt) + parseInt(perPage));

        children.css('display','none').slice(startAt, endOn).show();

        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }

        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }

        pager.data("curr",page);
      	pager.children().removeClass("active "+settings.activeColor);
        pager.children().eq(page+1).addClass("active "+settings.activeColor);

    }
};
