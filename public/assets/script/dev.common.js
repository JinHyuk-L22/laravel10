$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


const input_check_empty = ( inputname, rtext, formname ) => {
    let inputType = $(formname).find('input[name="' + inputname + '"]').attr('type'),
    selectType = 'input',
    noneText = false;
    if (!inputType) {
        selectType = $(formname).find('[name="' + inputname + '"]')[0]['nodeName'];
    } else {
        if (inputType == 'text' || inputType == 'number' || inputType == 'date' || inputType == 'hidden' || inputType == 'password' || inputType == 'file') noneText = false;
        else noneText = true;
    }
    if (!noneText) {
        if (!$.trim($(formname).find(selectType + '[name="' + inputname + '"]').val())) {
            alert(rtext);
            $(formname).find(selectType + '[name="' + inputname + '"]').focus();
            return false;
        } else {
            return true;
        }
    } else {
        if (!$(formname).find(selectType + '[name="' + inputname + '"]').is(':checked')) {
            alert(rtext);
            $(formname).find(selectType + '[name="' + inputname + '"]').eq(0).focus();
            return false;
        } else {
            return true;
        }
    }   
}

/* 
    step2 -> step3
    discription : 
    ex) 
*/
const callAjax = (url, obj, isDebug = false) => {

    callbackAjax(url, obj, function (data, error) {
        (data) ? ajaxSuccessData(data) : ajaxErrorData(error);
    }, isDebug);
}

/* 
    step3 -> step4
    discription : 파라미터로 넘어온 json을 encryptData에서 암호화하여 ajax 통신
    ex) 
*/
const callbackAjax = (url, obj, callback, isDebug = false) => {

    $.ajax({
        type: "POST",
        url: url,
        data: encryptData(obj),
        beforeSend: function () {
            spinnerShow();
        },
        complete: function () {
            spinnerHide();
        },
        success: function (data) {
            if (isDebug) console.log(data);
            callback(data, null);
        },
        error: function (error) {
            console.log(456);
            if (isDebug) console.log(error);
            callback(null, error);
        }
    });
}

const callbackMultiAjax = (url, obj, callback, isDebug = false) => {
    $.ajax({
        type: "POST",
        processData: false,
        contentType: false,
        url: url,
        data: encryptMultiData(obj),
        beforeSend: function () {
            spinnerShow();
        },
        complete: function () {
            spinnerHide();
        },
        success: function (data) {
            if (isDebug) console.log(data);
            callback(data, null);
        },
        error: function (error) {
            if (isDebug) console.log(error);
            callback(null, error);
        }
    });
}

const ajaxSuccessData = (obj) => {
    if (obj.log) {
        console.log(obj.log);
    }

    if (obj.alert) {
        actionAlert(obj.alert);
    }

    if (obj.location) {
        locationUrl(obj.location);
    }

    if (obj.winClose) {
        if (obj.winClose.reload) {
            opener.location.reload();
        }

        window.close();
    }

    if (obj.parentsReload) {
        if (opener) {
            opener.location.reload();
        }
    }

    if (obj.removeCss) {
        removeCss(obj.removeCss);
    }

    if (obj.addCss) {
        addCss(obj.addCss);
    }

    if (obj.removeClass) {
        removeClass(obj.removeClass);
    }

    if (obj.addClass) {
        addClass(obj.addClass);
    }

    if (obj.remove) {
        isRemove(obj.remove);
    }

    if (obj.html) {
        addHtml(obj.html);
    }

    if (obj.before) {
        beforeHtml(obj.before);
    }

    if (obj.after) {
        afterHtml(obj.after);
    }

    if (obj.append) {
        appendHtml(obj.append);
    }

    if (obj.prepend) {
        prependHtml(obj.prepend);
    }

    if (obj.openerHtml) {
        openerAddHtml(obj.openerHtml);
    }

    if (obj.openerBefore) {
        openerBeforeHtml(obj.openerBefore);
    }

    if (obj.openerAfter) {
        openerAfterHtml(obj.openerAfter);
    }

    if (obj.openerAppend) {
        openerAppendHtml(obj.openerAppend);
    }

    if (obj.openerPrepend) {
        openerPrependHtml(obj.openerPrepend);
    }

    if (obj.input) {
        addInput(obj.input);
    }

    if (obj.text) {
        addText(obj.text);
    }

    if (obj.attr) {
        addAttr(obj.attr);
    }

    if (obj.data) {
        addData(obj.data);
    }

    if (obj.trigger) {
        isTrigger(obj.trigger);
    }

    if (obj.focus) {
        isFocus(obj.focus);
    }

    if (obj.prop) {
        isProp(obj.prop);
    }
}

const ajaxErrorData = (obj) => {
    let json = {};

    if (isEmpty(obj.responseJSON)) {
        console.log(obj);
    } else {
        json.case = true;
        json.msg = isEmpty(obj.responseJSON.msg) ? (obj.status + ' ERROR') : obj.responseJSON.msg;

        if (!isEmpty(obj.responseJSON.redirect)) {
            json.location = {
                'case': obj.responseJSON.redirect,
                'url': obj.responseJSON.url,
            }
        }

        actionAlert(json);
    }

    spinnerHide();
}

/* 
    step4 -> step5 -> return step3
    discription : step3에서 받은 파라미터로 받은 json을 encryptAction에서 암호화 처리 step3으로 return
    ex) 
*/
const encryptData = (obj) => {
    $.each(obj, function (key, value) {
        obj[key] = encryptAction(value);
    });

    return obj;
}

const encryptMultiData = (obj) => {
    const formDataJson = new FormData();

    obj.forEach((value, key) => {
        formDataJson.append(key, encryptAction(value));
    });

    return formDataJson;
}

/* 
    step1-1 => stpe1-2 => return form
    discription : form 데이터를 배열로 serializeConvertJson에 넘겨 json으로 만들어 return ( callAjax에 사용될 파라미터 생성 )
    ex) callAjax( form.attr('action'), formSerialize(form));
*/
const formSerialize = (target) => {

    let formData = serializeConvertJson($(target).serializeArray());
    const targetData = $(target).data();

    // formData.sid = targetData.sid;
    // formData.case = targetData.case;

    return formData;
}

/*
    step1-2 => return step1-1
    discription : formSerialize에서 받은 form 데이터 배열을 json으로 return
    ex) let formData = serializeConvertJson($(target).serializeArray());
 */
const serializeConvertJson = (obj) => {
    let jsonData = {};

    $(obj).each(function (k, v) {
        jsonData[v.name] = v.value;
    });

    return jsonData;
}

const spinnerShow = () => {
    $("#spinner-div").show();
}

// ajax loading spinner Hide
const spinnerHide = () => {
    $("#spinner-div").hide();
}

/* 
    step5 -> return step4
    discription : crypto-js lib로 json 암호화하여 step4로 return
    ex) 
*/
const encryptAction = (data) => {
    const encKey = "secret phrase";

    switch (true) {
        case typeof data === 'boolean':
            // boolean 일경우 string 으로 변환후 암호화
            return encryptAction(data.toString());

        case Array.isArray(data):
            // 배열인 경우 각 요소를 암호화
            return data.map(val => encryptAction(val));

        case typeof data == 'object':
            // 파일 데이터인 경우 암호화하지 않음
            if (data instanceof Blob || data instanceof File) {
                return data;
            } else {
                // 객체의 각 속성 값을 암호화
                const encryptedObj = {};

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        encryptedObj[key] = encryptAction(data[key]);
                    }
                }

                return encryptedObj;
            }

        case typeof data == 'number':
        case typeof data == 'string':
            // 문자열 또는 숫자인 경우 암호화
            const iv = CryptoJS.lib.WordArray.random(16);
            return CryptoJS.AES.encrypt(data.toString(), encKey, {iv: iv}).toString();

        default:
            // 다른 타입의 데이터는 암호화하지 않음
            return data;
    }
}

const isEmpty = (str) => {
    if (typeof str === 'string') {
        str = str.replace(/ /g, ''); // 공백 제거
        str = str.replace(/\n/g, ""); // 줄바꿈 제거
    }

    return (typeof str === "undefined" || str === null || str === "") ? true : false;
}

const actionAlert = (obj) => {
    alert(obj.msg);

    if (obj.case) {
        delete obj.case;
        delete obj.msg;
        ajaxSuccessData(obj);
    }
}

const locationUrl = (obj) => {
    switch (obj.case) {
        case 'replace':
            window.location.replace(obj.url);
            break;

        case 'reload':
            window.location.reload();
            break;

        case 'blank':
            const openNewWindow = window.open("about:blank");
            openNewWindow.location.href = obj.url;
            break;

        case 'back':
            window.history.back();
            break;

        case 'href':
            location.href = obj.url;
            break;
    }
}

// add html
const addHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).html(data.html);
    });
}

// before html
const beforeHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).before(data.html);
    });
}

// after html
const afterHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).after(data.html);
    });
}

// append html
const appendHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).append(data.html);
    });
}

// prepend html
const prependHtml = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).prepend(data.html);
    });
}

// add css
const addCss = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).css(data.css, data.val);
    });
}

// remove css
const removeCss = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).css(data.css, '');
    });
}

// add class
const addClass = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).addClass(data.class);
    });
}

// remove class
const removeClass = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).removeClass(data.class);
    });
}

// add input
const addInput = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).val(data.input);
    });
}

// add Text
const addText = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).text(data.text);
    });
}

// add attr
const addAttr = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).attr(data.attr, data.val);
    });
}

// add data
const addData = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).data(data.name, data.data);
    });
}

// trigger
const isTrigger = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).trigger(data.event);
    });
}

// prop
const isProp = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).prop(data.event, data.val);
    });
}

// remove
const isRemove = (obj) => {
    $.each(obj, function (key, data) {
        $(data.selector).remove();
    });
}

// focus
const isFocus = (target) => {
    $(target).focus();
}

const logout = () => {
    callAjax('/member/logout', {});
}