<div class="popup-wrap type5" style="display: block;" id="notice_popup">
    <div class="popup-contents" style="width:auto; min-width:{{ $bbs->popup_width }}px; max-width:{{ $bbs->popup_width }}px; min-height:{{ $bbs->popup_height }}px; 
        max-height:{{ $bbs->popup_height }}px; margin:0; margin-top:{{ $bbs->popup_position_y }}px; margin-left:{{ $bbs->popup_position_x }}px;">
        <div class="popup-conbox">
            <h2 class="popup-contit">{{ $bbs->subject }}</h2>
            <div class="popup-con">
                {!! $bbs->content !!}
            </div>
            @if( isset($sample) )
                <div class="popup-attach-con">
                    @foreach( $files as $file )
                        <a href="javascript:void(0);">{{ $file }}</a>
                    @endforeach
                </div>
            @endif
            <div class="btn-wrap text-center">
                @if( $bbs->popup_detail == 'Y' )
                    <a href="{{ !empty($bbs->sid) ? route('bbs.show', [$bbs->code, $bbs->sid]) : '#' }}" class="btn btn-pop-more">자세히보기</a>
                @endif
                @if( !empty($bbs->linkurl) )
                    <a href="{{ $bbs->linkurl }}" class="btn btn-pop-link">바로가기</a>
                @endif
            </div>
        </div>
        <div class="popup-footer">
            <form action="" method="post" name="popForm">
                <div class="checkbox-wrap">
                    <div class="checkbox-group">
                        <input type="checkbox" name="pop-close" id="pop-close-1" value="1" onclick="fn_set_cookie(1);">
                        <label for="pop-close-1">오늘 하루 열지 않기</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="pop-close" id="pop-close-7" value="7" onclick="fn_set_cookie(7);">
                        <label for="pop-close-7">7일 동안 열지 않기</label>
                    </div>
                </div>
                <a href="javascript:void(0)" onclick="$('#notice_popup').remove()" class="btn full-right">닫기</a>
            </form>
        </div>
    </div>
</div>