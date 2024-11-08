@extends('layouts.header')
@section('content')
    @include('layouts.alert')
    @push('scripts')
        <script>
            function fn_show_regist_target_pop( sid ){
                $.ajax({
                    type: 'post',
                    url: '/bbs/event/data',
                    data: {
                        'type'  : 'regist_target',
                        'sid'   : sid,
                        '_token' : $("meta[name=csrf-token]").attr('content')
                    },
                    success: function(e) {
                        $("#targetEle").append(e);
                    }, error: function(e) {
                        // console.log(e);
                        alert('delete Favorites..');
                        // location.reload();
                    }
                });
            }
        </script>
    @endpush
    <article class="sub-contents" id="targetEle">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</h3>
            </div>
            <div class="board-wrap">
                <div class="sch-wrap type2">
                    <form action="" method="">
                        <feildset>
                            <legend class="hide">검색</legend>
                            <div class="form-group">
                                <select name="search_key" id="search_key" class="form-item sch-cate">
                                    @foreach( $bbsConfig['search'] as $sKey => $sVal )
                                        <option value="{{ $sKey }}" {{ request()->search_key == $sKey ? 'selected' : '' }}>{{ $sVal }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="search_val" id="search_val" class="form-item sch-key" placeholder="검색하실 내용을 입력하세요." value="{{ request()->search_val }}">
                                <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                                <button type="reset" class="btn btn-reset" onclick="location.href='{{ route('bbs.list', $bbs_name) }}'">검색 초기화</button>
                            </div>
                        </feildset>
                    </form>
                </div>
                @if( isAdmin() )
                    <div class="btn-wrap text-right" style="margin-bottom: 15px;">
                        <a href="{{ route('bbs.post', $bbs_name) }}" class="btn btn-board color-type5">등록</a>
                    </div>
                @endif
                <ul class="board-list">
                    <li class="list-head">
                        <div class="bbs-no bbs-col-xs n-bar">번호</div>
                        <div class="bbs-tit n-bar">제목</div>
                        <div class="bbs-admin bbs-col-xs">파일</div>
                        <div class="bbs-cate bbs-col-s n-bar">조회수</div>
                        <div class="bbs-date bbs-col-m">작성일</div>
                        @if( isAdmin() )
                            <div class="bbs-show bbs-col-s">공개여부</div>
                            <div class="bbs-admin bbs-col-s">관리</div>
                        @endif
                    </li>

                    <!-- 공지 type1 -->
                    @foreach( $notice_bbss as $bbs )
                        <li class="active">
                            <div class="bbs-no bbs-col-xs n-bar">
                                <img src="/assets/image/board/ic_notice.png" alt="공지" class="ic-notice">
                            </div>
                            <div class="bbs-tit n-bar">
                                <a href="{{ route('bbs.show', [$bbs_name, $bbs->sid]) }}" class="ellipsis">{{ $bbs->subject }}</a>
                                @if( $bbs->created_at->addDays(2)->format('Y-m-d H:i:s') > now() )
                                    <span class="ic-new">N</span>
                                @endif
                                @if( $bbs->comments()->count() )
                                    <span class="ic-cnt">{{ $bbs->comments()->count() }}</span>
                                @endif
                            </div>
                            <div class="bbs-admin bbs-col-xs">
                                @if( $bbs->files()->count() )
                                    <img src="/assets/image/board/ic_attach_file.png" alt="">
                                @endif
                            </div>
                            <div class="bbs-hit bbs-col-s n-bar">{{ $bbs->ref }}</div>
                            <div class="bbs-name bbs-col-m">{{ $bbs->created_at->format('Y-m-d') }}</div>
                            @if( isAdmin() )
                                <div class="bbs-show bbs-col-s">
                                    <select name="" id="" onchange="fn_bbs_change( '{{ $bbs_name }}', 'open', '{{ $bbs->sid }}', $(this).val() )">
                                        @foreach( $bbsParamConfig[$bbs_name]['open'] as $oKey => $oVal )
                                            <option value="{{ $oKey }}" {{ $bbs->open == $oKey ? 'selected' : '' }}>{{ $oVal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="bbs-admin bbs-col-s">
                                    <div class="btn-admin">
                                        <a href="{{ route('bbs.post', [$bbs_name, $bbs->sid]) }}" class="btn btn-modify"><span class="hide">수정</span></a>
                                        <a href="javascript:void(0);" onclick="fn_bbs_change( '{{ $bbs_name }}', 'del', '{{ $bbs->sid }}', 'Y' );" class="btn btn-delete"><span class="hide">삭제</span></a>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                    <!-- 공지 type1 -->

                    @if( count($bbss) )
                        @foreach( $bbss as $bKey => $bbs )
                        <li>
                            <div class="bbs-no bbs-col-xs n-bar">
                                {{ $bbss->currentPage() > 1 ? ( $bbss->total()-( ($bbss->currentPage()-1) * 15 ) ) - $bKey : $bbss->total() - $bKey }}
                            </div>
                            <div class="bbs-tit n-bar">
                                <a href="{{ route('bbs.show', [$bbs_name, $bbs->sid]) }}" class="ellipsis">{{ $bbs->subject }}</a>
                                @if( $bbs->created_at->addDays(2)->format('Y-m-d H:i:s') > now() )
                                    <span class="ic-new">N</span>
                                @endif
                                @if( $bbs->comments()->count() )
                                    <span class="ic-cnt">{{ $bbs->comments()->count() }}</span>
                                @endif
                            </div>
                            <div class="bbs-admin bbs-col-xs">
                                @if( $bbs->files()->count() )
                                    <img src="/assets/image/board/ic_attach_file.png" alt="">
                                @endif
                            </div>
                            <div class="bbs-hit bbs-col-s n-bar">{{ $bbs->ref }}</div>
                            <div class="bbs-date bbs-col-m">{{ $bbs->created_at->format('Y-m-d') }}</div>
                            @if( isAdmin())
                                <div class="bbs-show bbs-col-s">
                                    <select name="" id="" onchange="fn_bbs_change( '{{ $bbs_name }}', 'open', '{{ $bbs->sid }}', $(this).val() )">
                                        @foreach( $bbsParamConfig[$bbs_name]['open'] as $oKey => $oVal )
                                            <option value="{{ $oKey }}" {{ $bbs->open == $oKey ? 'selected' : '' }}>{{ $oVal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="bbs-admin bbs-col-s">
                                    <div class="btn-admin">
                                        <a href="{{ route('bbs.post', [$bbs_name, $bbs->sid]) }}" class="btn btn-modify"><span class="hide">수정</span></a>
                                        <a href="javascript:void(0);" onclick="fn_bbs_change( '{{ $bbs_name }}', 'del', '{{ $bbs->sid }}', 'Y' );" class="btn btn-delete"><span class="hide">삭제</span></a>
                                    </div>
                                </div>
                            @endif
                        </li>
                        @endforeach
                    @else
                        <!-- no data -->
                        <li class="no-data text-center">
                            등록된 게시글이 없습니다.
                        </li>
                    @endif
                </ul>
                <div class="paging-wrap">
                    {{ $bbss->links('layouts.page', ['list'=>$bbss]) }}
                </div>
            </div>
        </div>
    </article>
@endsection
