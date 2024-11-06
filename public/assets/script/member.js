$(function(){

    callDatePicker();

    $("#step02Form").submit(function(){
        var formname = "#"+$(this).attr('id');
        // if( false ) {
        if( $("input[name=type]").val() != 'edit' ){
            if (!empty_check('member_level1', '회원 구분을 선택해주세요.', formname)) return false;
            if (!empty_check('member_level3', '상세 회원 구분을 선택해주세요.', formname)) return false;

            if (!empty_check('id', '아이디를 입력해주세요.', formname)) return false;
            var regExId = /^(?=.*[a-z])(?=.*[0-9!@#$%^&*])([a-z0-9!@#$%^&*]{5,14})$/;
            if (!regExId.test($("input[name=id]").val())) {
                alert("아이디는 5~14자 이내의 영문 소문자와 숫자/기호 중 두가지 이상 혼합하여 구성되어야 합니다.");
                $("input[name=id]").focus();
                return false;
            }

            if( $("#dup_check").val() != 'Y' ){
                alert('아이디 중복확인을 해주세요.');
                $("input[name=id]").focus();
                return false;
            }
        }

        if( $("input[name=type]").val() != 'edit' ){
            if( !empty_check('passwd', '비밀번호를 입력해주세요.', formname) ) return false;
            var regExPwd = /^(?=.*[a-z])(?=.*[0-9!@#$%^&*])([a-z0-9!@#$%^&*]{5,12})$/;
            if( !regExPwd.test($("input[name=passwd]").val()) ){
                alert("비밀번호는 5~12자 이내의 영문 소문자와 숫자/기호 중 두가지 이상 혼합하여 구성되어야 합니다.");
                $("input[name=passwd]").focus();
                return false;
            }
            if( !empty_check('passwd_check', '비밀번호 확인을 입력해주세요.', formname) ) return false;
            if( $("input[name=passwd]").val() != $("input[name=passwd_check]").val() ){
                alert('비밀번호가 맞지 않습니다.');
                $("input[name=passwd_check]").focus();
                return false;
            }
        } else {
            if( $("input[name=passwd]").val() ){
                var regExPwd = /^(?=.*[a-z])(?=.*[0-9!@#$%^&*])([a-z0-9!@#$%^&*]{5,12})$/;
                if( !regExPwd.test($("input[name=passwd]").val()) ){
                    alert("비밀번호는 5~12자 이내의 영문 소문자와 숫자/기호 중 두가지 이상 혼합하여 구성되어야 합니다.");
                    $("input[name=passwd]").focus();
                    return false;
                }
                if( !empty_check('passwd_check', '비밀번호 확인을 입력해주세요.', formname) ) return false;
                if( $("input[name=passwd]").val() != $("input[name=passwd_check]").val() ){
                    alert('비밀번호가 맞지 않습니다.');
                    $("input[name=passwd_check]").focus();
                    return false;
                }
            }
        }

        if( !empty_check('name_kr', '이름 (한글)을 입력해주세요.', formname) ) return false;
        if( !empty_check('name_en', '이름 (영문)을 입력해주세요.', formname) ) return false;
        if( !empty_check('birthday', '생년월일을 입력해주세요.', formname) ) return false;
        if( $("input[name=birthday]").val().length < 10 ){
            alert('생년월일을 입력해주세요.');
            $("input[name=birthday]").focus();
            return false;
        }
        if( !empty_check('sex', '성별을 선택해주세요.', formname) ) return false;
        if( !empty_check('mobile2', '휴대폰 번호를 입력해주세요.', formname) ) return false;
        if( !empty_check('mobile3', '휴대폰 번호를 입력해주세요.', formname) ) return false;
        if( !empty_check('email', '개인 E-mail을 입력해주세요.', formname) ) return false;
        if( $("#email_dup_check").val() != 'Y' ){
            alert('이메일 중복확인을 해주세요.');
            $("input[name=email]").focus();
            return false;
        }

        if( $("input[name=type]").val() != 'edit' ){
            if( !$("#fileName").val() ){
                alert('사진을 첨부해주세요.');
                $("#fileName").focus();
                return false;
            }
        } else {
            if( !$("#member_file_del").val() && !$("#fileName").val() ){
                alert('사진을 첨부해주세요.');
                $("#fileName").focus();
                return false;
            }
        }
        if( $("input[name=type]").val() != 'edit' ) {
            if ($("input[name=member_level1]:checked").val() == 'S' && $("input[name=member_level3]:checked").val() == '1') {
                if (!empty_check('regular_type', '신청 구분을 선택해주세요.', formname)) return false;
                if (!empty_check('regular_app', '신청서 제출방식을 선택해주세요.', formname)) return false;
                if ($("input[name=regular_app]:checked").val() == '1') {
                    if (!$("#regular_app_fileName").val()) {
                        alert('신청서를 업로드해주세요.');
                        $("#regular_app_fileName").focus();
                        return false;
                    }
                    if (!$("#card_fileName").val()) {
                        alert('명함 판사진을 첨부해주세요.');
                        $("#card_fileName").focus();
                        return false;
                    }
                }
            }
        }

            if( !empty_check('license_gubun', '의사 면허 번호를 입력해주세요.', formname) ) return false;
            if( !empty_check('license_number', '의사 면허 취득년도를 입력해주세요.', formname) ) return false;
            if( !empty_check('license_get_year', '의사 면허 발행처를 입력해주세요.', formname) ) return false;
            if( !empty_check('license_issue', '의사 면허 발행처를 입력해주세요.', formname) ) return false;

            if( !empty_check('office_name_kr', '병원(근무처)명 국문을 입력해주세요.', formname) ) return false;
            if( !empty_check('office_name_en', '병원(근무처)명 영문을 입력해주세요.', formname) ) return false;
            if( !empty_check('office_gubun', '의료기관구분을 선택해주세요.', formname) ) return false;
            if( !empty_check('office_zipcode', '근무처 우편번호를 입력해주세요.', formname) ) return false;
            if( !empty_check('office_addr', '근무처 주소를 입력해주세요.', formname) ) return false;
            if( !empty_check('office_addr_en', '근무처 주소 영문을 입력해주세요.', formname) ) return false;

            for(var i=1;i<=3;i++){
                if(!$("#office_phone"+i).val() ){
                    alert("근무처 전화번호를 입력해주세요.");
                    $("#office_phone"+i).focus();
                    return false;
                }
            }

            for(var i=1;i<=3;i++){
                if(!$("#office_fax"+i).val() ){
                    alert("근무처 팩스번호를 입력해주세요.");
                    $("#office_fax"+i).focus();
                    return false;
                }
            }

            for(var i=1;i<=3;i++){
                if(!$("#home_phone"+i).val() ){
                    alert("자택 전화번호를 입력해주세요.");
                    $("#home_phone"+i).focus();
                    return false;
                }
            }

            if( !empty_check('post_in', '우편물 수령지를 선택해주세요.', formname) ) return false;

            if( !empty_check('info_agree', '정보 공개 동의를 선택해주세요.', formname) ) return false;
            if( $("input[name=info_agree]:checked").val() == 'Y' ){
                if( !$("input[name=open_agree]").is(":checked") ){
                    alert('개인정보 공개를 선택해주세요.');
                    return false;
                }
            }
            if( !empty_check('sms_agree', 'SMS 수신 여부를 선택해주세요.', formname) ) return false;
            if( !empty_check('email_agree', '우편물 수령지를 선택해주세요.', formname) ) return false;


            if( !empty_check('captcha', '자동화 프로그램 입력 방지 문자를 입력해주세요.', formname) ) return false;
            if( $("#captcha_ok").val() != 'Y' ){
                refreshCaptcha();
                alert('자동화 프로그램 입력 방지 문자가 틀렸습니다.');
                $("#captcha").focus();
                return false;
            }
        // }

    })

    $("#sf").click(function(){
        if( $(this).is(":checked") ) {
            $('#office_name_kr').prop("readonly", false);
            $('#office_name_en').prop("readonly", false);
            $('#office_zipcode').prop("readonly", false);
            $('#office_addr').prop("readonly", false);
        }else {
            $('#office_name_kr').prop("readonly", true);
            $('#office_name_en').prop("readonly", true);
            $('#office_zipcode').prop("readonly", true);
            $('#office_addr').prop("readonly", true);
        }
    });

    $(".onlyBackSpace").keydown(function( event ){

        if( event.keyCode !== 8 ){
            event.preventDefault();
            return false;
        }
    });

    $('input[name=captcha]').keyup(function(){
        $.ajax({
            type:"POST",
            url:"/common/captcha-check",
            data:{
                '_token' : $("meta[name=csrf-token]").attr('content'),
                'captcha' : $("#captcha").val()
            },
            async: false,
            success:function(r){
                $("#captcha_ok").val(r);
            }
        })
    })
})

function fn_go_step2(){
    if( !$("#agree1").is(":checked") ){
        alert('회원가입 약관 동의 및 개인정보 수집 동의에 모두 동의 해 주셔야 회원가입이 가능합니다.');
        return false;
    }
    if( !$("#agree2").is(":checked") ){
        alert('회원가입 약관 동의 및 개인정보 수집 동의에 모두 동의 해 주셔야 회원가입이 가능합니다.');
        return false;
    }
    location.href = '/member/join/step2';
}

function fn_detail_level( ele ){
    $("input[name=member_level2]").val('');
    $("input[name=member_level3]").prop("checked", false);
    if( $(ele).val() == 'S' ){
        $(".member_level1_S_view").show();
        $(".member_level1_N_view").hide();
    } else {
        $(".member_level1_N_view").show();
        $(".member_level1_S_view").hide();
    }
}

function fn_regular_check( ele, level2 ){
    $("input[name=member_level2]").val( level2 );
    if( $(ele).attr('id') == 'member_level3_S_1' ){
        $(".regular_view").show();
    } else {
        $(".regular_view").hide();

        $("input[type=regular_type]").prop("checked", false);

    }
}

function fn_regular_info( ele ){
    if( $(ele).val() == '2' ){
        $(".regular_app2_show").show();
        $(".regular_app1_show").hide();
        $("#regular_app_fileName").val('');
        $("#card_fileName").val('');
    } else {
        $(".regular_app2_show").hide();
        $(".regular_app1_show").show();
    }
}

function openDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            $("#office_zipcode").val(data.zonecode);
            $("#office_addr").val(data.address).focus();
        }
    }).open();
}

function fn_special_major_etc_switch(){
    if( $('#special_major_etc').is(":checked") ){
        $("input[name=special_etc]").prop('readonly', false);
    } else{
        $("input[name=special_etc]").val('');
        $("input[name=special_etc]").prop('readonly', true);
    }
}

function fn_member_duplicate_check(){
    if( !$("input[name=id]").val() ){
        alert('아이디를 입력해주세요.');
        return false;
    }

    $.ajax({
        type:"POST",
        url:"/member/join/data",
        data:{
            'id' : $("input[name=id]").val(),
            'type' : 'dup',
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        dataType: 'json',
        async: false,
        success:function(r){
            if( r.status == 'Fail' ){
                $("#dup_check").val('N');
            } else if( r.status == 'Dup'){
                $("#dup_check").val('N');
                $("input[name=id]").val('');
            }else if( r.status == 'Success' ){
                $("#dup_check").val('Y');
            } else {
                r.msg = 'error';
            }
            alert(r.msg);
            return false;
        }, error:function(e){
            console.log(e);
        }
    })
}

function fn_email_duplicate_check(){
    if( !$("input[name=email]").val() ){
        alert('이메일을 입력해주세요.');
        return false;
    }

    $.ajax({
        type:"POST",
        url:"/member/join/data",
        data:{
            'email' : $("input[name=email]").val(),
            'type' : 'email_dup',
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        dataType: 'json',
        async: false,
        success:function(r){
            if( r.status == 'Fail' ){
                $("#email_dup_check").val('N');
            } else if( r.status == 'Dup'){
                $("#email_dup_check").val('N');
                $("input[name=email]").val('');
            }else if( r.status == 'Success' ){
                $("#email_dup_check").val('Y');
            } else {
                r.msg = 'error';
            }
            alert(r.msg);
            return false;
        }, error:function(e){
            console.log(e);
        }
    })
}

function refreshCaptcha(){
    $.ajax({
        type:"POST",
        url:"/common/captcha-make",
        data:{
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        async: false,
        success:function(r){
            if( r ){
                $("#captcha").val('');
                $('#captcha_img').attr('src', r);
            } else {
                alert('error');
            }
            return false;
        }, error:function(e){
            console.log(e);
        }
    })
}

function fn_agree_check_switch( ele ){
    if( $(ele).val() == 'Y' ){
        $("#agree_check_switch").show();
    } else{
        $("#agree_check_switch").hide();
        $("input[name=open_agree]").prop('checked', false);
        $("input[name=open_img]").prop("checked", false);
    }
}

function fn_search_member( type, val1, val2 ){
    $("#findSuccessShow").hide();
    $("#findSuccessShow").html('');
    $("#findFail2Show").hide();
    $.ajax({
        type:"POST",
        url:"/member/join/data",
        data:{
            'type' : 'find',
            'type2' : type,
            'val1' : val1,
            'val2' : val2,
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        dataType: 'json',
        async: false,
        success:function(r){
            if( r.status == 'Success' ){
                if( type == 'id'){
                    $("#findSuccessShow").html( r.data );
                    $("#findSuccessShow").show();
                } else if( type == 'pwd' ){
                    alert(r.msg);
                    location.reload();
                } else {
                    alert('error');
                }
            } else if( r.status == 'Fail' ){
                alert(r.msg);
            } else if( r.status == 'Fail2' ){
                $("#findFail2Show").show();
            } else {
                alert('error');
            }
            return false;
        }, error:function(e){
            console.log(e);
        }
    })
}

function fn_file_del( sid, target, ele ){
    $.ajax({
        type:"POST",
        url:"/member/join/data",
        data:{
            'type' : 'file_del',
            'target' : target,
            'sid'   : sid,
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        async: false,
        success:function(r){
            $(ele).parents('.attach-file').remove()
            return false;
        }, error:function(e){
            console.log(e);
        }
    })
}

function fn_new_file_del( file_key ){
    $("#"+file_key).parent('.attach-file').hide();
    $("#"+file_key).val('Y');
}

function add_list(target) {
    for(var i=1; i<= 5; i++) {
        if ( $('#' +target  + i).css("display") == "none" ) {
            $('#' +target  + i).show();
            break;
        }
    }
}

function add_list2(target) {
    for(var i=1; i<= 5; i++) {
        if ( $('#' +target  + i).css("display") == "none" ) {
            $('#' +target  + i).show();
            break;
        }
    }
    $('th[class=s_hospital_numbers]').not(':hidden').each(function( index, ele ){
        $(ele).text( (index+1) );
    })
}

function remove_list(target, t_num) {
    var t_name = target+"_name" +t_num;
    var t_term_s = target+"_term_s" +t_num;
    var t_term_e = target+"_term_e" +t_num;

    $("#"+t_name).val('');
    $("#"+t_term_s).val('');
    $("#"+t_term_e).val('');

    $("#"+target+t_num).hide();

}

function remove_list2( target, t_num ){
    var t_name = target+"_name" +t_num;
    var t_detail = target+"_detail" +t_num;

    $("#"+t_name).val('');
    $("#"+t_detail).val('');

    $("#"+target+t_num).hide();

    $('th[class=s_hospital_numbers]').not(':hidden').each(function( index, ele ){
        $(ele).text( (index+1) );
    })

}

function delete_list( target, t_num ){
    var t_name  = target+"_name" +t_num;
    var t_detail= target+"_detail"+t_num;

    $("#"+t_name).val('');
    $("#"+t_detail).val('');

}

function degree_major(str,val) {
    var degree1 = val ;
    if(str == 'last') {
        str = '_' + str;
    }

    $.ajax({
        type: 'post',
        url: '/member/join/data',
        data: {
            'degree': degree1,
            'type'  : 'degree_list',
            '_token' : $("meta[name=csrf-token]").attr('content')
        },
        success: function(e) {
            $("#degree_major" + str).find("option").remove();
            $("#degree_major" + str).append(e);
        }, error: function(e) {
            alert('delete Favorites..');
            location.reload();
        }
    });
}




