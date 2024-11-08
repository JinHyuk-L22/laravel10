@extends('layouts.header')
@section('content')
    @push('css')
        <link type="text/css" rel="stylesheet" href="{{ asset('/assets/script/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css')}}" />
    @endpush
    @push('scripts')
        @include('layouts.alert')
        <script type="text/javascript" src="{{ asset('/assets/script/tinymce/tinymce.min.js') }}" charset="utf-8"></script>

        <script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/plupload.full.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/i18n/ko.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/assets/script/plupload/2.3.6/jquery.plupload.queue/jquery.plupload.queue.min.js') }}"></script>
        <script>

            $(function(){


                callDatePicker();

                $("#postForm").submit(function(e){
                    // e.preventDefault();
                    var formname = "#"+$(this).attr('id');

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

                    var $form = $("#postForm");

                    if($("#file_status").val()=='Y'){
                        return true;
                    }

                    var uploader = $("#plupload").pluploadQueue();

                    if (uploader.files.length > 0) {
                        // When all files are uploaded submit form
                        uploader.bind('StateChanged', function () {
                            if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                                $("#file_status").val("Y");
                                $form.submit();
                            }
                        });
                        uploader.start();

                    } else {
                        return true;
                    }
                    return false;
                })




                $('#plupload').pluploadQueue({
                    runtimes : 'html5,flash',
                    flash_swf_url : '/script/Moxie.swf',
                    silverlight_xap_url : '/script/Moxie.xap',
                    url : '{{ route('file.upload', ['path' => $bbs_name, 'imsi' => $imsi]) }}',
                    dragdrop: true,
                    headers: {
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    filters : {
                        max_file_size : '20mb'
                    },
                    init: {
                        PostInit: function(up) {
                            $(up.getOption('container')).find('.plupload_button.plupload_start').hide();
                        },
                        Error: function (up, err) {
                            if (err.code === plupload.HTTP_ERROR) {
                                up.stop();
                                alert('파일 업로드 에러 - ' + err.message);
                            }
                        },
                        FileUploaded: function (up, file, info) {
                            var data = JSON.parse(info.response);

                            if (data.stored_path !== undefined) {
                                var file_index = $('#' + file.id).index();
                                $('#plupload').append('<input type="hidden" name="plupload_' + file_index + '_stored_path" value="' + data.stored_path + '" />');
                            }

                        }
                    }
                });

                const tinymce_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '/common/tinyUpload');

                    xhr.upload.onprogress = (e) => {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = () => {
                        if (xhr.status === 403) {
                            reject({message: 'HTTP Error: ' + xhr.status, remove: true});
                            return;
                        }

                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        const json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        resolve(json.location);
                    };

                    xhr.onerror = () => {
                        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('_token', $('meta[name=csrf-token]').attr('content'));

                    xhr.send(formData);
                });

                tinymce.init({
                    promotion: false,
                    selector: '.tinymce', // 에디터 사용 클래스
                    language: 'ko_KR',
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic backcolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'removeformat | help',
                    relative_urls: false,
                    remove_script_host: false,
                    convert_urls: true,
                    image_class_list: [
                        {title: 'img-responsive', value: 'img-responsive'},
                    ],
                    image_title: true,
                    automatic_uploads: true,
                    file_picker_types: 'image',
                    images_upload_handler: tinymce_image_upload_handler,
                    file_picker_callback: function (cb, value, meta) {
                        let input = document.createElement('input');

                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');

                        input.onchange = function () {
                            const file = this.files[0];
                            const reader = new FileReader();

                            reader.readAsDataURL(file);
                            reader.onload = function () {
                                const id = 'blobid' + moment().valueOf();
                                let blobCache = tinymce.activeEditor.editorUpload.blobCache;

                                const base64 = reader.result.split(',')[1];
                                const blobInfo = blobCache.create(id, file, base64);

                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), {title: file.name});
                            };
                        };

                        input.click();
                    },
                    setup: function(editor) {

                    }
                });

                $(".onlyBackSpace").keydown(function( event ){

                    if( event.keyCode !== 8 ){
                        event.preventDefault();
                        return false;
                    }
                });

                $('a.popView').click(function(){
                    $frm = $('#postForm');
                    var formname = "#postForm";

                    if( $(formname).find('input[type="radio"][name="popup_select"]:checked').val() == 'P' ){
                        var tiny_text = tinymce.get('popup_content').getContent();
                    } else {
                        var tiny_text = tinymce.get('content').getContent();
                    }

                    var tiny_checker = '';

                    tiny_checker = tiny_text.replace(/(<([^>]+)>)/ig,"");
                    tiny_checker = tiny_text.replace(/<br\/>/ig, "\n");
                    tiny_checker = tiny_text.replace(/<(\/)?([a-zA-Z]*)(\s[a-zA-Z]*=[^>]*)?(\s)*(\/)?>/ig, "");


                    if( !tiny_checker ) {
                        alert('팝업 내용을 입력해 주세요.');
                        return false;
                    }

                    var file_array = [];
                    @if( count($target->files) > 0 )
                        @foreach( $target->files as $fKey => $file )
                            file_array[{{ $fKey }}] = '{{ $file->filename }}';
                        @endforeach
                    @endif

                    console.log( file_array );

                    $.ajax({
                        type: "POST",
                        url: "{{ route('bbs.data', $bbs_name) }}",
                        data: {
                            type            : 'pop_view',
                            temp            : $("input[name=popup_template]:checked").val(),
                            popup_width     : $("input[name=popup_width]").val(),
                            popup_height    : $("input[name=popup_height]").val(),
                            popup_position_y: $("input[name=popup_position_y]").val(),
                            popup_position_x: $("input[name=popup_position_x]").val(),
                            popup_detail    : $("input[name=popup_detail]:checked").val(),
                            linkurl         : $("input[name=linkurl]").val(),
                            content         : tiny_text,
                            file_array      : file_array,
                            _token          : '{{ csrf_token() }}'
                        },
                        success: function(pop) {
                            $(".sub-contents").append(pop);
                            console.log( pop );
                        },
                        error: function(xhr, option, error) {
                            alert(xhr.status); //오류코드
                            alert(error); //오류내용
                        },
                    });
                    return false;
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
    @endpush
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</h3>
            </div>
            <div class="board-wrap">
                <div class="board-write">
                    <form action="{{ route('bbs.data', $bbs_name) }}" method="post" id="postForm">
                        @csrf
                        <input type="hidden" name="sid" value="{{ $target->sid ?? '' }}">
                        <input type="hidden" name="type" value="{{ !empty($target->sid) ? 'edit' : 'write'}}">
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="name" value="{{ Auth::user()->name_kr }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                        <input type="hidden" name="file_status" id="file_status" value="N">
                        <input type="hidden" name="imsi" value="{{ $imsi }}">
                        <fieldset>
                            <legend class="hide">글쓰기</legend>
                            <div class="write-contop text-right">
                                <div class="help-text"><strong class="required">*</strong> 표시는 필수입력 항목입니다.</div>
                            </div>
                            <ul class="write-wrap">
                                <li>
                                    <div class="tit">작성자</div>
                                    <div class="con">{{ Auth::user()->name_kr }}</div>
                                </li>
                                <li>
                                    <div class="tit"><strong class="required">*</strong> 제목</div>
                                    <div class="con">
                                        <input type="text" name="subject" id="subject" class="form-item" value="{{ $target->subject }}">
                                        @if( $bbsConfig['use']['main'] )
                                            <div class="checkbox-wrap cst">
                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="push" id="chk-push" value="Y" {{ $target->push == 'Y' ? 'checked' : '' }}>
                                                    <label for="chk-push">PUSH</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                                @if( $bbsConfig['use']['notice'] )
                                    <li>
                                        <div class="tit"><strong class="required">*</strong> 공지 여부</div>
                                        <div class="con">
                                            <div class="radio-wrap cst">
                                                @foreach( $bbsParams['agree1'] as $aKey => $aVal )
                                                    <div class="radio-group">
                                                        <input type="radio" name="notice" id="notice{{ $aKey }}" value="{{ $aKey }}" {{ $target->notice == $aKey ? 'checked' : '' }}>
                                                        <label for="notice{{ $aKey }}">{{ $aVal }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if( $bbsConfig['use']['popup'] )
                                <li>
                                    <div class="tit"><strong class="required">*</strong> 팝업 설정</div>
                                    <div class="con">
                                        <div class="radio-wrap cst">
                                            @foreach( $bbsParams['agree2'] as $aKey => $aVal )
                                                <div class="radio-group">
                                                    <input type="radio" name="popup" id="popup{{ $aKey }}" value="{{ $aKey }}" onchange="fn_popup_show( $(this).val() );" {{ $target->popup == $aKey ? 'checked' : '' }}>
                                                    <label for="popup{{ $aKey }}">{{ $aVal }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                @endif
                                <li style="display: {{ $target->popup == 'Y' ? '' : 'none' }};" class="popup_details">
                                    <div class="tit">팝업 템플릿</div>
                                    <div class="con">
                                        <div class="radio-wrap cst">
                                            @foreach( $bbsParams['popup_template'] as $aKey => $aVal )
                                                <div class="radio-group">
                                                    <input type="radio" name="popup_template" id="popup_template{{ $aKey }}" value="{{ $aKey }}" {{ $target->popup_template == $aKey ? 'checked' : '' }}>
                                                    <label for="popup_template{{ $aKey }}">{{ $aVal }}</label>
                                                </div>
                                            @endforeach
                                            <a href="javascript:void(0)" class="btn btn-form color-type10 popView">팝업 미리보기</a>
                                        </div>
                                    </div>
                                </li>
                                <li style="display: {{ $target->popup == 'Y' ? '' : 'none' }};" class="popup_details">
                                    <div class="tit">팝업 내용 선택</div>
                                    <div class="con">
                                        <div class="radio-wrap cst">
                                            @foreach( $bbsParams['popup_select'] as $aKey => $aVal )
                                                <div class="radio-group">
                                                    <input type="radio" name="popup_select" id="popup_select{{ $aKey }}" value="{{ $aKey }}" {{ $target->popup_select == $aKey ? 'checked' : '' }}>
                                                    <label for="popup_select{{ $aKey }}">{{ $aVal }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li style="display: {{ $target->popup == 'Y' ? '' : 'none' }};" class="popup_details">
                                    <div class="tit">팝업 사이즈</div>
                                    <div class="con">
                                        <div class="form-group">
                                            <p class="text">사이즈 :</p>
                                            <input type="text" name="popup_width" id="popup_width" class="form-item w-10p" value="{{ $target->popup_width }}">
                                            <p class="text">X</p>
                                            <input type="text" name="popup_height" id="popup_height" class="form-item w-10p" value="{{ $target->popup_height }}">
                                        </div>
                                        <div class="form-group mt-10">
                                            <p class="text">위치 : 위에서</p>
                                            <input type="text" name="popup_position_y" id="popup_position_y" class="form-item w-10p" value="{{ $target->popup_position_y }}">
                                            <p class="text">px, 왼쪽에서</p>
                                            <input type="text" name="popup_position_x" id="popup_position_x" class="form-item w-10p" value="{{ $target->popup_position_x }}">
                                            <p class="text">px</p>
                                        </div>
                                    </div>
                                </li>
                                <li style="display: {{ $target->popup == 'Y' ? '' : 'none' }};" class="popup_details">
                                    <div class="tit">팝업 자세히 보기</div>
                                    <div class="con">
                                        <div class="radio-wrap cst">
                                            @foreach( $bbsParams['popup_detail'] as $aKey => $aVal )
                                                <div class="radio-group">
                                                    <input type="radio" name="popup_detail" id="popup_detail{{ $aKey }}" value="{{ $aKey }}" {{ $target->popup_detail == $aKey ? 'checked' : '' }}>
                                                    <label for="popup_detail{{ $aKey }}">{{ $aVal }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li style="display: {{ $target->popup == 'Y' ? '' : 'none' }};" class="popup_details">
                                    <div class="tit">팝업 시작일 / 종료일</div>
                                    <div class="con">
                                        <div class="form-group date">
                                            <p class="text">시작일 :</p>
                                            <input type="text" name="popup_startdate" id="popup_startdate" class="form-item datepicker onlyBackSpace" value="{{ $target->popup_startdate }}" datepicker oninput="fn_not_korean(this)">
                                            <p class="text">종료일 :</p>
                                            <input type="text" name="popup_enddate" id="popup_enddate" class="form-item datepicker onlyBackSpace" value="{{ $target->popup_enddate }}" datepicker oninput="fn_not_korean(this)">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tit"><strong class="required">*</strong> 공개 여부</div>
                                    <div class="con">
                                        <div class="radio-wrap cst">
                                            @foreach( $bbsParams['open'] as $aKey => $aVal )
                                                <div class="radio-group">
                                                    <input type="radio" name="open" id="open{{ $aKey }}" value="{{ $aKey }}" {{ $target->open == $aKey ? 'checked' : '' }}>
                                                    <label for="open{{ $aKey }}">{{ $aVal }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tit">Link URL</div>
                                    <div class="con">
                                        <input type="text" name="linkurl" id="linkurl" class="form-item" value="{{ $target->linkurl }}">
                                    </div>
                                </li>
                                <li>
                                    <div class="con">
                                        <textarea id="content" name="content" class="tinymce">{!! $target->content !!}</textarea>
                                    </div>
                                </li>
                                <li>
                                    <div class="con" id="plupload">

                                    </div>
                                </li>
                                @if( count($target->files) > 0 )
                                    <li>
                                        <div class="con">
                                            @foreach( $target->files as $file )
                                                <label for="edit_form_delete_files_{{ $file->sid }}" class="lm0 tm5 bm5" style="display: block;">
                                                    <input type="checkbox" id="edit_form_delete_files_{{ $file->sid }}" name="delete_files[]" value="{{ $file->sid }}">
                                                    삭제 - <img src="" alt="" /> {{ $file->filename }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </li>
                                @endif
                            </ul>
                            <div class="btn-wrap text-center">
                                @if( empty($target->sid) )
                                    <button type="submit" class="btn btn-board btn-write">등록</button>
                                @else
                                    <button type="submit" class="btn btn-board btn-modify">수정</button>
                                @endif
                                <a href="{{ route('bbs.list', $bbs_name) }}" class="btn btn-board btn-cancel">취소</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="pconly-wrap m-show">
                <img src="/assets/image/sub/img_pc_only.png" alt="">
                <p>
                    해당 메뉴는 <br>
                    <span>PC</span>에서만 서비스 가능합니다.
                </p>
            </div>
        </div>
    </article>
@endsection
