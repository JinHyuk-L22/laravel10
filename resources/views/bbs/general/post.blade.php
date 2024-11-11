@extends('layouts.header')
@section('content')

    @push('scripts')
        @include('layouts.alert')
        
        @include('bbs.script.tinymce')
        @include('bbs.script.plupload')
        @include('bbs.script.default')

    @endpush
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</h3>
            </div>
            <div class="board-wrap">
                <div class="board-write">
                    <form action="{{ route('bbs.data', $bbs_name) }}" method="post" id="postForm">
                        <input type="hidden" name="sid" value="{{ $target->sid ?? '' }}">
                        <input type="hidden" name="type" value="post">
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
                                        <input type="text" name="subject" id="subject" class="form-item" value="{{ $target->subject }}" onlyBackSpace>
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
                                @if( $bbsConfig['use']['link'] )
                                    <li>
                                        <div class="tit">Link URL</div>
                                        <div class="con">
                                            <input type="text" name="linkurl" id="linkurl" class="form-item" value="{{ $target->linkurl }}">
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <div class="con">
                                        <textarea id="content" name="content" class="tinymce">{!! $target->content !!}</textarea>
                                    </div>
                                </li>
                                @if( $bbsConfig['use']['upload'] )
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
