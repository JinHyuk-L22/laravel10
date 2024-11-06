<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes,viewport-fit=cover">
        <meta name="format-detection" content="telephone=no, address=no, email=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Pragma" content="no-cache">
        <meta name="Author" content="대한신경중재치료의학회">
        <meta name="Keywords" content="대한신경중재치료의학회">
        <meta name="description" content="대한신경중재치료의학회">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>대한신경중재치료의학회</title>
        <link rel="icon" href="{{ asset('/assets/image/favicon.ico') }}">
        <link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sun-typeface/SUITE/fonts/static/woff2/SUITE.css">
        <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.min.css') }}">
        @if( $main_key == 'main')
            <link rel="stylesheet" href="{{ asset('/assets/css/jquery.fullPage.css') }}">
        @endif
        <link rel="stylesheet" href="{{ asset('/assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/common.css') }}">
        <script src="{{ asset('/assets/js/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('/assets/js/jquery-ui.min.js') }}"></script>
        @if( $main_key == 'main')
            <script src="{{ asset('/assets/js/jquery.fullPage.js') }}"></script>
        @endif
        <script src="{{ asset('/assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('/assets/js/common.js') }}"></script>
        <script src="{{ asset('/assets/script/dev.common.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/crypto-js/crypto-js.min.js') }}"></script>
        <script src="{{ asset('/assets/script/moment/moments.js') }}"></script>
        {{-- datepicker --}}
        <script src="{{ asset('assets/script/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/script/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
        {{-- daum post --}}
        <script src="{{ asset('https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js') }}"></script>

        @stack('css')
        @stack('scripts')
    </head>
    <body>
        <!--
            main일 때 class="main",
            sub일 때 class="sub"
        -->
        <div id="wrap" class="{{ $main_key == 'main' ? 'main' : 'sub'}}">
            <header id="header" class="js-header">
                <ul class="util-wrap">
                    <li class="blue-box"><a href="#">ENGLISH</a></li>
                        @if( auth('admin')->check() )
                            <li class="admin"><a href="#">ADMIN</a></li>
                        @endif
                        @if( !auth('web')->check() )
                            <li><a href="{{ route('member.login') }}">로그인</a></li>
                            <li><a href="#">회원가입</a></li>
                        @endif
                        @if( auth('web')->check() )
                            <li><a href="javascript:void(0);" onclick="logout();">로그아웃</a></li>
                            <li><a href="#">My page</a></li>
                        @endif
         
                </ul>

                <div id="dim" class="js-dim"></div>
                <div class="header-wrap">
                    <h1 class="header-logo">
                        <a href="/"><span class="hide">대한신경중재치료의학회</span></a>
                    </h1>
                    {{-- 상단 gnb --}}
                    <ul class="gnb-list js-gnb-list">
                        @foreach( $menu as $mKey => $m )
                            @if( $m['is_show'] )
                                @continue( $mKey == 'mypage' )
                                <li>
                                    <a href="#">{{ $m['title'] }}</a>
                                    @if( isset($m['sub']) )
                                        <ul>
                                            @foreach( $m['sub'] as $smKey => $sub_menu )
                                                @if( $sub_menu['is_show'] )
                                                    @continue( $mKey == 'mypage' && $smKey == 'certify' && empty(Auth::user()->certify) )
                                                    <li>
                                                        <a href="#"><span>{{ $sub_menu['title'] }}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <button type="button" class="btn-menu-open js-btn-menu-open"><span class="hide">메뉴 열기</span></button>
                    <div class="gnb-wrap">
                        <div class="line inner-layer">
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                            <div class="bar"></div>
                        </div>
                        <div class="gnb-header">
                            <div class="gnb-header-top">
                                <div class="header-logo">
                                    <a href="/"><span class="hide">대한신경중재치료의학회</span></a>
                                </div>
                                <button type="button" class="btn-menu-close js-btn-menu-close"><span class="hide">메뉴 닫기</span></button>
                            </div>
                            <ul class="util-menu t-show">
                                <li class="global"><a href="#n"><i>아이콘</i>ENGLISH</a></li>
                                @if( !Auth::check() )
                                    <li class="login">
                                        <a href="#"><i>아이콘</i>로그인</a>
                                    </li>
                                    <li class="signup">
                                        <a href="#"><i>아이콘</i>회원가입</a>
                                    </li>
                                @else
                                    <li class="logout">
                                        <a href="javascript:void(0);" onclick="fn_logout();"><i>아이콘</i>로그아웃</a>
                                    </li>
                                    <li class="mypage">
                                        <a href="#"><i>아이콘</i>My page</a>
                                    </li>
                                @endif
                          
                                    <li class="admin"><a href="#n">대한신경중재치료의학회 관리자 페이지 이동<i>아이콘</i></a></li>
                       
                            </ul>
                        </div>
                        {{-- 전체 메뉴 사이드바 --}}
                        <nav id="gnb">
                            <ul class="gnb js-gnb inner-layer">
                                @foreach( $menu as $mKey => $m )
                                    @if( $m['is_show'] )
                                        @continue( $mKey == 'mypage' && !Auth::check() )
                                        <li>
                                            <a href="#">{{ $m['title'] }}</a>
                                            @if( isset($m['sub']) )
                                                <div class="inner-layer">
                                                    <ul>
                                                        @foreach( $m['sub'] as $smKey => $sub_menu )
                                                            @if( $sub_menu['is_show'] )
                                                                @continue( $mKey == 'mypage' && $smKey == 'certify' && empty(Auth::user()->certify) )
                                                                <li>
                                                                    <a href="#">{{ $sub_menu['title'] }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                <li></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>

            <!--
                main일 때 class="main",
                sub일 때 class="sub"
            -->
            <section id="container" class="{{ $main_key == 'main' ? 'js-fullpage' : 'sub'}}">
                <!--
                    sub01 : 회원가입
                    sub02 : MY PAGE
                    sub03 : 학회소개
                    sub04 : 학술활동
                    sub05 : 회원마당
                    sub06 : 뉴스레터
                    sub07 : 보험소식
                    sub08 : 치료적정성 평가프로그램
                    sub09 : 커뮤니티
                    sub10 : 업계소식
                    sub11 : KSIN 인증의 인증병원
                -->
                @if( !isset($is_main) )
                    <article class="sub-visual sub{{ $menu[$main_key]['class_no'] }}">
                        <div class="sub-visual-con">
                            <div class="sub-visual-text inner-layer">
                                <h2 class="sub-visual-tit">{{ $menu[$main_key]['title'] }}</h2>
                                <ul class="breadcrumb">
                                    <li>{{ $menu[$main_key]['title'] }}</li>
                                    <li>{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</li>
                                </ul>
                            </div>
                        </div>
                    </article>

                <article class="sub-menu-wrap">
                    <div class="sub-menu inner-layer">
                        <a href="/" class="btn-home"><span class="hide">홈</span></a>
                        <ul class="sub-menu-list js-sub-menu-list">
                            <li class="sub-menu-depth01">
                                <a href="#n" class="btn-sub-menu js-btn-sub-menu">{{ $menu[$main_key]['title'] }}</a>
                                <ul>
                                    @foreach( $menu as $m )
                                        @if( $m['is_show'] )
                                            <li>
                                                <a href="#">{{ $m['title'] }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @if( isset( $sub_key ) )
                            <li class="sub-menu-depth02">
                                <a href="#n" class="btn-sub-menu js-btn-sub-menu">{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</a>
                                <ul>
                                    @foreach( $menu[$main_key]['sub'] as $mKey => $sub_menu )
                                        @if( $main_key == 'mypage' && $mKey == 'certify' )
                                            @continue( empty(Auth::user()->certify) )
                                        @endif
                                        @if( $main_key == 'evaluation' && $mKey == 'judge' )
                                            @continue( !Auth::check() || empty(Auth::user()->judge_checker()) )
                                        @endif
                                        @if( $sub_menu['is_show'])
                                        <li class="{{ $mKey == $sub_key ? 'on' : '' }}">
                                            <a href="#">
                                                <span>{{ $sub_menu['title'] }}</span>
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </article>
                @endif
                @yield('content')
                
                @include('layouts.footer')
            </section>