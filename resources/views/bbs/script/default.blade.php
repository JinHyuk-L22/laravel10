<script>
    $(function(){

        let formname = "#postForm", 
            form = $('#postForm');

        callDatePicker();

        $("#postForm").submit(function(e){
            // e.preventDefault();
            var formname = "#"+$(this).attr('id');
            $('input[name=type]').val('post');

            if(!empty_check('subject', '제목을 입력해주세요.', formname)) return false;
            @if( $bbsConfig['use']['notice'] )
                if(!empty_check('notice', '공지 여부를 선택해주세요.', formname)) return false;
            @endif
            @if( $bbsConfig['use']['popup'] )
                if(!empty_check('popup', '팝업 설정 여부를 선택해주세요.', formname)) return false;
                if( $("input[name=popup]:checked").val() == 'Y' ){
                    if( $("input[name=popup_startdate]").val() ){
                        if( $("input[name=popup_startdate]").val().length < 10 ){
                            alert('팝업 시작일을 전부 입력해주세요.');
                            $("input[name=popup_startdate]").focus();
                            return false;
                        }
                    }
                    if( $("input[name=popup_enddate]").val() ){
                        if( $("input[name=popup_enddate]").val().length < 10 ){
                            alert('팝업 종료일을 전부 입력해주세요.');
                            $("input[name=popup_enddate]").focus();
                            return false;
                        }
                    }
                }
            @endif
            if(!empty_check('open', '공개 여부를 선택해주세요.', formname)) return false;

            @if( $bbsConfig['use']['upload'] )
                if($("#file_status").val() == 'Y'){
                    return true;
                }

                var uploader = $("#plupload").pluploadQueue();

                if (uploader.files.length > 0) {
                    // When all files are uploaded submit form
                    uploader.bind('StateChanged', function () {
                        if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                            $("#file_status").val("Y");
                            form.submit();
                        }
                    });
                    uploader.start();

                } else {
                    return true;
                }
                return false;
            @endif
        })


        $('a.popView').click(function(){

            let tiny_text = '', 
                tiny_checker = '';;

            if( $(formname).find('input[type="radio"][name="popup_select"]:checked').val() == 'P' ){
                tiny_text = tinymce.get('popup_content').getContent();
            } else {
                tiny_text = tinymce.get('content').getContent();
            }

            tiny_checker = tiny_text.replace(/(<([^>]+)>)/ig,"");
            tiny_checker = tiny_text.replace(/<br\/>/ig, "\n");
            tiny_checker = tiny_text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");


            if( !tiny_checker ) {
                alert('팝업 내용을 입력해 주세요.');
                return false;
            }

            $(`input[name=type]`).val('popPreview');
            $(`textarea[name=content]`).val(tiny_text);
            callAjax( `{{ route('bbs.data', $bbs_name) }}`, formSerialize(form));

        });

    })

    function fn_popup_show( val ){
    if( val == 'Y' ){
        $(".popup_details").show();
    } else {
        $(".popup_details").hide();
    }
}
</script>