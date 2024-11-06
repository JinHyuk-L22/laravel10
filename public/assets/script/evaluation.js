$(function(){
    $("#evaluationForm").submit(function(){
        var formname = "#"+$(this).attr('id');

        if( $("input[name=status]").val() == '1' ){
            return true;
        } else {
            if( !confirm("평가 의뢰 하시겠습니까? 제출 후 내용 수정은 불가능합니다.") ){
                return false;
            }
        }

        if (!empty_check('mobile2', '휴대폰번호를 입력해주세요.', formname)) return false;
        if (!empty_check('mobile3', '휴대폰번호를 입력해주세요.', formname)) return false;

        if (!empty_check('email', '개인 E-mail를 입력해주세요.', formname)) return false;

        if (!empty_check('patient_age', '환자 개인정보 나이를 입력해주세요.', formname)) return false;
        if (!empty_check('patient_sex', '환자 개인정보 성별을 선택해주세요.', formname)) return false;
        if (!empty_check('patient_gubun', '환자 개인정보 구분을 선택해주세요.', formname)) return false;
        if (!empty_check('patient_movement', '환자 개인정보 환자병력을 입력해주세요.', formname)) return false;
        if (!empty_check('title', '의뢰제목을 입력해주세요.', formname)) return false;
        if (!empty_check('gubun_1', '평가구분을 선택해주세요.', formname)) return false;
        if (!empty_check('gubun_2', '평가구분2를 선택해주세요.', formname)) return false;

        if (!empty_check('content', '의뢰내용을 입력해주세요.', formname)) return false;

    })

    $("#statusChanger").click(function(){
        if( !confirm("작성중인 내용을 임시저장 하시겠습니까?") ){
            return false;
        }
        $("input[name=status]").val('1');
        $("#evaluationForm").submit();
    })

    $("#judgeForm").submit(function(){

        var formname = "#"+$(this).attr('id');

        if (!empty_check('vote', '치료적정성 여부를 선택해주세요.', formname)) return false;

        if( !confirm('더 이상 수정이 불가능합니다. 등록하시겠습니까?') ){
            return false;
        }
    })
})
function fn_change_file_list( num ){

    var remove_file = "";

    if( num ){
        for( var li = 1; li < 11; li++ ){
            $("#file_list_num"+li).show();
            if( li > num ){
                $("#file_list_num"+li).hide();
                $("#thumbnail"+li).attr('src', '/assets/image/board/preview.jpg');
                $("#fileName"+li).val('');
                if( $("#file_list_num"+li).attr('data-sid') ){
                    remove_file += $("#file_list_num"+li).attr('data-sid')+',';
                }
            }
        }

        $("input[name=remove_file_sids]").val(remove_file);
    }
}

function fn_file_checker( ele ){

    var file_block = $(ele).parents('.filebox');
    var preview_block = file_block.find('.thumbnail');

    var path = $(ele).val();
    var filename = $(ele).val().split('\\').pop();
    var extension = path.split('.').pop();

    switch(extension) {
        case 'png':
        case 'gif':
        case 'jpg':
        case 'zip':
        case '':
            break;
        default:

            $(ele).replaceWith($(ele).val('').clone(true));

            alert('허용되지 않는 파일입니다.');

            return;
    }

    if(filename == '') { // No file
        return;
    } else if(window.FileReader) {
        if(!ele.files[0] || !ele.files[0].type.match(/image\//)) return;

        var reader = new window.FileReader();
        reader.onload = function (e) {
            preview_block.find('img').attr('src', e.target.result);
        }

        reader.readAsDataURL(ele.files[0]);
    } else if(preview_block.find('img').get(0).filters) { // MSIE
        this.select();
        this.blur();

        var img_src = document.selection.createRange().text;

        preview_block.find('img').css('filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(enable='true',sizingMethod='scale',src=\"" + img_src + "\")");
    } else { // Not Support
        return;
    }
}