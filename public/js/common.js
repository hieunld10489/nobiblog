$(function () {
    var duration = 300;
    var pageHeight = $(document).height();

    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
            $('.to-top').fadeIn(duration);
        } else {
            $('.to-top').fadeOut(duration);
        }

        if($(this).scrollTop() < pageHeight - 880) {
            $('.to-bottom').fadeIn(duration);
        } else {
            $('.to-bottom').fadeOut(duration);
        }
    });

    $('.to-top').click(function(event) {
        event.preventDefault();
        $('html').animate({scrollTop: 0}, duration);
        return false;
    });

    $('.to-bottom').click(function(event) {
        event.preventDefault();
        $('html').animate({scrollTop: pageHeight}, duration);
        return false;
    });

    setTimeout(function() {
        postJSON(getDomain('home/load-page'), {options:{process:false}}, function (res) {
            pr(res);
            if(res.status) {

            } else {

            }
        });
    }, 2000);
});


function logout(url) {
    popupConfirm('ログアウトします。宜しいですか？', function() {
        window.location.href = url;
    });
}

function popupDataForm(title, content, callBackFunc, callBackFuncClose, callBackFuncContentLoaded) {
    return $.confirm({
        title: title,
        content: content,
        columnClass: 'col-md-12',
        draggable: false,
        buttons: {
            formSubmit: {
                text: '確定',
                btnClass: 'btn-blue',
                action: callBackFunc
            },
            cancel: {
                text: 'キャンセル',
                action: callBackFuncClose
            }
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$formSubmit.trigger('click'); // reference the button and click it
            });
        },
        // contentLoaded: function(data, status, xhr){
        onOpen: callBackFuncContentLoaded
    });
}

function ajaxDataForm(params, url, callBackFunc, token) {
    return $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token': token
        },
        data: params,
        url: url,
        cache: false,
        success: callBackFunc
    }).fail(function () {
        popupAlert('request fail');
    });
}

function ajaxUploadForm(file, url, callBackFunc, token) {
    var formData = new FormData();
    formData.append( "file", file );

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-Token': token
        },
        data: formData,
        url: url,
        cache: false,
        processData: false,
        contentType: false,
        success: callBackFunc
    }).fail(function () {
        popupAlert('request fail');
    });
}

function ajax(options, loader, endLoader) {
    loader = loader !== undefined? loader : true;
    endLoader = endLoader !== undefined? endLoader : true;
    if(loader) {
        showLoader(true);
    }

    options.type = options.type || "GET";
    options.headers = options.headers || null;
    options.data = options.data || null;
    options.dataType = options.dataType || "json";
    options.url = options.url || "";
    options.cache = options.cache !== undefined? options.cache : false;

    options.complete = options.complete || function() {
        if(loader && endLoader) {
            showLoader(false);
        }
    };

    return $.ajax(options).fail(function () {
        if(loader) {
            showLoader(false);
        }
        popupAlert('request fail');
    });
}

function popupConfirm(content, callBackFunc, callBackFuncClose, title, options) {
    if(typeof(title) == "undefined") {
        title = 'Xác nhận';
    }

    var okText = options && options.okText? options.okText : 'Xác nhận';
    var closeText = options && options.closeText? options.closeText : 'Hủy';

    $.confirm({
        title: title,
        content: content,
        icon: 'fa fa-info',
        type: 'blue',
        animation: 'opacity',
        closeAnimation: 'opacity',
        animateFromElement: false,
        draggable: false,
        buttons: {
            ok: {
                btnClass: 'btn-primary btn-sm',
                text: okText,
                action: function(){
                    if (callBackFunc) {
                        callBackFunc();
                    }
                }
            },
            close: {
                text: closeText,
                action: function(){
                    if (callBackFuncClose) {
                        callBackFuncClose();
                    }
                }
            }
        }
    });
}

function popupAlert (content, callBackFunc, btnText) {
    if(typeof(btnText) == "undefined") {
        btnText = 'Đóng';
    }
    $.confirm({
        title: 'Thông báo',
        content: content,
        icon: 'fa fa-info',
        type: 'blue',
        animation: 'opacity',
        closeAnimation: 'opacity',
        animateFromElement: false,
        draggable: false,
        buttons: {
            ok: {
                btnClass: 'btn-primary',
                text: btnText,
                action: callBackFunc
            }
        }
    });
}

function popupError (content, callBackFunc, btnText) {
    if(typeof(btnText) == "undefined") {
        btnText = 'Đóng';
    }
    $.confirm({
        title: 'Lỗi',
        icon: 'fa fa-warning',
        content: content,
        type: 'red',
        animation: 'opacity',
        closeAnimation: 'opacity',
        animateFromElement: false,
        draggable: false,
        buttons: {
            ok: {
                btnClass: 'btn-primary',
                text: btnText,
                action: callBackFunc
            }
        }
    });
}

function getJSON(requestPath, callBackFunc, obj) {
    showLoader();
    $.ajax({
        type: 'GET',
        headers: {'X-CSRF-Token': $('#_token').val() },
        contentType: 'application/JSON',
        dataType : 'JSON',
        scriptCharset: 'utf-8',
        url: requestPath,
        cache: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            if (textStatus === 'success') {
                if (callBackFunc) {
                    callBackFunc(data, obj);
                }
            } else {
                pr(data);
            }
        },
        error: function() {
            pr('error');
            showLoader(false);
        },
        complete: function() {
            //pr('complete');
            showLoader(false);
        }
    }).fail(function (xhr, status, error) {
        //popupError('Kết internet không ổn định.');
        popupError(status +' ; '+ error);
    });
}

function postJSON(requestPath, params, callBackFunc, obj) {

    let isProcess = true;

    if (params.hasOwnProperty('options')) {
        let objOption = params.options;

        if(objOption.hasOwnProperty('process')) {
            isProcess = objOption.process;
        }

        delete params.options;
    }

    showLoader(isProcess);
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('#_token').val() },
        data : JSON.stringify(params),
        contentType: 'application/JSON',
        dataType : 'JSON',
        scriptCharset: 'utf-8',
        url: requestPath,
        cache: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            if (textStatus === 'success') {
                if (callBackFunc) {
                    callBackFunc(data, obj);
                }
            } else {
                pr(data);
            }
        },
        error: function() {
            pr('error');
            showLoader(false);
        },
        complete: function() {
            //pr('complete');
            showLoader(false);
        }
    }).fail(function (xhr, status, error) {
        //popupError('Kết internet không ổn định.');
        popupError(status +' ; '+ error);
    });
}

function pr(v) {
    return console.log(v);
}

function floatNumber(t) {
    var times = 0;
    return  ((t + '').replace(/[！-～]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    })).replace(/[。．]+/g, '.')
        .replace(/^\.|[^0-9.]/g, '')
        .replace(/\./g, function (c) {
            times++;
            return (times==1)? c:'';
        });
}

function initDatatable(table_id, config) {
    config.language = {
        "emptyTable":     "条件に一致するデータが見つかりません。",
        "info":           " _TOTAL_ 件中 _START_ から _END_ まで表示",
        "infoEmpty":      " 0 件中 0 から 0 まで表示",
        "infoFiltered":   "（全 _MAX_ 件より抽出）",
        "infoPostFix":    "",
        "infoThousands":  ",",
        "loadingRecords": "読み込み中...",
        "processing":     "処理中...",
        "zeroRecords":    "条件に一致するデータが見つかりません。",
        "paginate": {
            "first":    "先頭",
            "last":     "最終",
            "next":     "次",
            "previous": "前"
        }
    };
    config.dom = '<"text"><"top" <"pull-left" i><"pull-left table-description" <"dataTables_info">><"pull-right" p>><"clearfix">rt<"bottom" <"pull-left" i><"pull-right" p>><"clearfix">';
    config.pageLength = parseInt($PAGE_LENGTH);
    config.processing = true;
    config.serverSide = config.serverSide !== undefined? config.serverSide : true;
    config.paging = config.paging !== undefined? config.paging : true;

    $.each(config.columns, function( index, value ) {
        if(typeof value.name !== 'undefined' && value.name !== "action") {
            // if(typeof value.type !== 'undefined' && value.type === 'html') {
            //
            // } else {
                value.render = $.fn.dataTable.render.text();
                value.orderable = false;
            // }
        }
    });

    return $(table_id).DataTable(config);
}

function initDatePicker(listId) {
    initPicker(listId, 'YYYY/MM/DD', '（西暦）年/月/日');
}

function initDatetimePicker(listId) {
    initPicker(listId, 'YYYY/MM/DD HH:mm:ss', '（西暦）年/月/日 00:00:00');
}

function initTimePicker(listId) {
    if($(listId).length > 0) {
        $.each($(listId), function(index, e) {
            if(!$(e).attr('placeholder')) {
                $(e).attr('placeholder', '00:00');
            }
            /*new Cleave(e, {
                time: true,
                timePattern: ['h', 'm']
            });*/
        });
    }
}

function initPicker(listId, format, placeholder) {
    if($(listId).length > 0) {
        $(listId).datetimepicker({
            useCurrent: false,
            showClear: true,
            showClose: true,
            locale: moment.locale('ja'),
            format: format
        });

        $.each($(listId), function( index, e ) {
            if(!$(e).attr('placeholder')) {
                $(e).attr('placeholder', placeholder);
            }
        });
    }
}

function initCleave(selector, options) {
    options = options || {};
    $(selector).each(function(){
        options.numeralPositiveOnly = this.attributes["data-integer-positive"];
        this.cleave = new Cleave(this, options);
    });
}

function initNumeral(listId) {
    initCleave(listId, {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
}

function initIntegerInput(selector) {
    selector = selector || ".integer-input";
    initCleave(selector, {
        numeralDecimalMark: ".",
        delimiter: ",",
        numeralDecimalScale: 0,
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
}

function convertNumberToMoney(number, n) {
    try {
        if(number === undefined || number === null || number === "") {
            return "";
        }
        n = 0;
        // return formatter.format(number);
        number = parseFloat(number);
        var re = '\\d(?=(\\d{' + (3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return number.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    }
    catch(err) {

    }
}

function convertMoneyToNumber(money) {
    return typeof money !== 'undefined' ? money.replace(/[^0-9.-]+/g, '') : null;
}

// ファイルサイズ表示
function formatBytes(bytes, decimals) {
    if(bytes == 0) return '0 Byte';
    var k = 1000; // or 1024 for binary
    var dm = decimals + 1 || 3;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function getExt(file) {
    return file.split('.').pop();
}

function clearForm(formId, callBackFunc) {
    // $(formId + ' input, ' + formId + ' textarea, ' + formId + ' select').each(function() {
        /*if ($(this).prop('tagName') == 'INPUT' && ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox')) {
            $(this).prop('checked', false);
        } else {
            $(this).val('');
        }*/
    // });

    $(formId)[0].reset();
    if (callBackFunc) {
        callBackFunc();
    }
}

function showLoader(on) {
    if (on === false) {
        setTimeout(function(){
            $('#process-content').modal('hide');
        }, 500);
    } else {
        $('#process-content').modal('show');
    }
}

function getDataValue(field, data, default_value) {
    default_value = default_value || "";
    if(data && data[field]) {
        return data[field];
    }
    return default_value;
}

function ajaxDown(me, form, url, removeSearch) {
    var oldText = $(me).text();

    $(me).text('ダウンロード中・・・');
    $(me).attr('disabled', 'disabled');

    var params = removeSearch? form : {search: form};
    ajaxDataForm(params, url,
        function (res) {
            downloadCsvData(res);

            $(me).text(oldText);
            $(me).removeAttr('disabled');
        }
    );
}


function downloadCsvData(response, me) {
    var type = 'text/csv;charset=utf-16;';
    var result = JSON.parse(response);
    // var blob = new Blob([result.csvData],{type: "text/csv;charset=utf-8;"});
    var blob;
    if(response && result.csvData) {
        blob = new Blob(["\ufeff", result.csvData]);
    } else {
        blob = new Blob([result.csvData],{type: type});
    }

    if (navigator.msSaveBlob) {
        navigator.msSaveBlob(blob, result.fileName);
    } else {
        var link = document.createElement("a");
        var csvUrl = URL.createObjectURL(blob);
        link.href = csvUrl;
        link.style = "visibility:hidden";
        link.download = result.fileName;

        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

function download_file(me, fileURL, fileName, unbind) {
    var oldText = $(me).text();

    $(me).text('ダウンロード中・・・');
    $(me).attr('disabled', 'disabled');
    unbind = unbind !== undefined? unbind : true;
    if(unbind) {
        $(me).unbind('click');
    }
    var req = new XMLHttpRequest();
    req.open("GET", fileURL, true);
    req.responseType = "blob";

    req.onload = function (event) {
        var blob = req.response;

        if (typeof window.navigator.msSaveBlob !== 'undefined') {
            //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
            window.navigator.msSaveBlob(blob, fileName);
        } else {
            var link=document.createElement('a');
            link.href=window.URL.createObjectURL(blob);
            link.download=fileName;
            link.click();
        }

        $(me).text(oldText);
        $(me).removeAttr('disabled');
        $(me).bind('click');
    };
    req.send();
}

// escapeHTML文字
function escapeHtml(text) {
    'use strict';
    return text.replace(/[\"&'\/<>]/g, function (a) {
        return {
            '"': '&quot;', '&': '&amp;', "'": '&#39;',
            '/': '&#47;',  '<': '&lt;',  '>': '&gt;'
        }[a];
    });
}

function base64_encode(str) {
    return btoa(str);
}

function base64_decode(str) {
    return atob(str);
}

function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}
