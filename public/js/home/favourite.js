$(function() {
    $('.remove-favourite').click(function () {
        removeWord($(this));
    });

    $('.remove-all-favourite').click(function () {
        removeAllWord();
    });
});

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

    let aryLsWordId = strLsWordId.split('|');

    aryLsWordId = $.grep(aryLsWordId, function(value) {
        return value != String(intWordId);
    });

    if($.inArray(String(intWordId), aryLsWordId) === (-1)) {
        $.cookie(getKey(), aryLsWordId.join('|'), { path: '/' });

        // remove row
        $( "span[data-word-id='"+intWordId+"']" ).parent().parent().next().remove();
        $( "span[data-word-id='"+intWordId+"']" ).parent().parent().remove();
    }
}

function removeAllWord() {
    let strLsWordId = readWord();

    if(!strLsWordId) {
        popupError('Không có từ vựng để xoá.');
        return false;
    }

    popupConfirm('Bạn có chắc chắn sẽ xoá hết từ yêu thích không', function() {
        $.cookie(getKey(), '', { path: '/' });

            // remove row
        $('.table tbody').html(
            '<tr>'+
            '<td class="font-weight-normal text-warning text-center" colspan="2">'+
                'Không tìm thấy từ vựng nào'+
            '</td></tr>'
        );
    });
}
