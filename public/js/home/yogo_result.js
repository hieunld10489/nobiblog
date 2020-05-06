$(function() {
    $('#ls-content').on('click', '.add-favourite', function () {
        saveWord($(this));
    });

    $('#ls-content').on('click', '.remove-favourite', function () {
        removeWord($(this));
    });
});

function saveWord(me) {
    let intWordId = me.data(getKey());
    let strLsWordId = readWord();

    if(!intWordId) {
        popupError('Từ vựng không tồn tại.');
        return false;
    }

    if(strLsWordId) {
        let aryLsWordId = strLsWordId.split('|');
        if(aryLsWordId.length >= 20) {
            popupError('Số từ yêu thích <= 20.');
            return false;
        }

        if($.inArray(String(intWordId), aryLsWordId) === (-1)) {
            aryLsWordId.push(intWordId);
            $.cookie(getKey(), aryLsWordId.join('|'), { path: '/' });
        }
    } else {
        $.cookie(getKey(), intWordId, { path: '/' });
    }

    me.remove();

    $('#favourite-btn-'+intWordId).html(addButton(intWordId, 'remove'));
}

function removeWord(me) {
    let intWordId = me.data(getKey());
    let strLsWordId = readWord();

    if(!intWordId) {
        popupError('Từ vựng không tồn tại.');
        return false;
    }

    if(!strLsWordId) {
        popupError('Không có từ vựng để xoá.');
        return false;
    }

    if(strLsWordId) {
        let aryLsWordId = strLsWordId.split('|');

        aryLsWordId = $.grep(aryLsWordId, function(value) {
            return value != String(intWordId);
        });

        if($.inArray(String(intWordId), aryLsWordId) === (-1)) {
            $.cookie(getKey(), aryLsWordId.join('|'), { path: '/' });

            // remove row
            $( "button[data-word-id='"+intWordId+"']" ).parent().parent().next().remove();
            $( "button[data-word-id='"+intWordId+"']" ).parent().parent().remove();
        }

        $('#favourite-btn-'+intWordId).html(addButton(intWordId, 'add'));
    }
}

function addButton(id, type) {
    let strHtml = '';
    if(type === 'add') {
        strHtml =
        '<span class="btn-outline-secondary add-favourite" data-word-id="'+id+'">'+
            '<i class="fa fa-star" aria-hidden="true"></i>'+
        '</span>';
    }
    if(type === 'remove') {
        strHtml =
        '<span class="btn-outline-warning remove-favourite" data-word-id="'+id+'">'+
            '<i class="fa fa-star" aria-hidden="true"></i>'+
        '</span>';
    }
    return strHtml;
}
