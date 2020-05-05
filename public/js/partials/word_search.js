$(function(){
    $('.search-input').change(function () {
        $('.search-input').val($(this).val());
    }).keypress( function ( e ) {
        if ( e.which == 13 ) {
            $('.search-input').val($(this).val());

            // ここに処理を記述
            search(getParam());
        }
    });

    $('.search-type').change(function () {
        $('.search-type').val($(this).val());
    });

    $('.search-word-type').change(function () {
        $('.search-word-type').val($(this).val());
    });

    $('.search-btn').click(function () {
        search(getParam());
    });

    $('.clear-search-btn').click(function () {
        resetParam();

        search(getParam());
    });
});

function getParam() {
    return {
        strSearch: $.trim($('.search-input').val()),
        strType: $.trim($('.search-type').val()),
        strWordType: $.trim($('.search-word-type').val())
    };
}

function resetParam() {
    $('.search-input').val('');
    //$('.search-type').val('');
    //$('.search-word-type').val('');
}

function search(objCondition) {
    let searchUrl = getDomain('home/yogo-result/');
    let aryCondition = [];
    let strType = objCondition.strType,
        strWordType = objCondition.strWordType,
        strSearch = objCondition.strSearch;

    if(strType) {
        searchUrl+=strType;
    }

    if(strWordType || strSearch) {
        searchUrl+='?';

        if(strWordType) {
            aryCondition.push('word_type='+strWordType);
        }

        if(strSearch) {
            aryCondition.push('search='+strSearch);
        }

        if(aryCondition.length > 0) {
            searchUrl+=aryCondition.join('&');
        }
    }

    location.href = searchUrl;
}