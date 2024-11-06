@extends('layouts.header')
@section('content')
    @include('layouts.alert')
    @push('scripts')
        <script>
            $(function(){
                $("#loginForm").submit(function(){

                    let form = $(this), 
                        formname = "#"+form.attr('id');
    
                    // if ( !input_check_empty('id', '아이디를 입력해주세요.', formname) ) return false;
                    // if ( !input_check_empty('passwd', '비밀번호를 입력해주세요.', formname) ) return false;

                    callAjax($(form).attr('action'), formSerialize(form));
                    return false;
                })
            })
        </script>
    @endpush
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <!-- 24.10.29 김수연 추가 -->
            <div class="login-notice">
                <img src="/assets/image/sub/ic-login-notice.png" alt="">
                <p class="tit">학회 홈페이지 개편으로 모든 회원분들의 비밀번호가 초기화 되었습니다. <br>
                    <span class="text-red">아래 세 가지 케이스</span>에 따라 해당하는 비밀번호로 로그인 후, 보안을 위해 반드시 <span class="text-red">비밀번호 변경</span>을 부탁드립니다.</p>
                <ul>
                    <li>
                        <span>1</span>
                        <p>
                            <strong>
                                휴대전화번호가 등록된 회원 :<br>
                                ksin + 휴대폰번호<br><br>
                            </strong>
                            EX) 010-1234-5678 번호의 회원 →<br>
                            초기 비밀번호 = ksin01012345678
                        </p>
                    </li>
                    <li>
                        <span>2</span>
                        <p>
                            <strong>
                                휴대전화번호가 등록되지 않은 회원 :<br>
                                ksin + 근무처 전화번호<br><br>
                            </strong>
                            EX) 02-1234-5678 번호의 회원 →<br>
                            초기 비밀번호 = ksin0212345678
                        </p>
                    </li>
                    <li>
                        <span>3</span>
                        <p>
                            <strong>
                                ①, ②의 경우에 모두 해당하지 않는 회원 : <br>
                            </strong>
                            초기 비밀번호 = ksin20142015
                        </p>
                    </li>
                </ul>
            </div>
            <!-- //24.10.29 김수연 추가 -->
            
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{ $menu[$main_key]['sub'][$sub_key]['title'] }}</h3>
            </div>
            <!-- s:login -->
            <div class="login-wrap type3">
                <div class="login-form">
                    <form action="{{ route('member.login') }}" method="POST" id="loginForm">
            
                        <fieldset>
                            <legend class="hide">로그인</legend>
                            <div class="login-tit-wrap">
                                <span class="icon"><img src="/assets/image/sub/ic_login_typec.png" alt=""></span>
                                <h3 class="login-tit">LOGIN</h3>
                            </div>
                            <div class="input-box">
                                <input type="text" name="id" id="id" class="form-item" placeholder="아이디를 입력하세요." value="{{ old('id') }}">
                                <input type="password" name="passwd" id="passwd" class="form-item" placeholder="비밀번호를 입력하세요.">
                            </div>
                            <div class="btn-wrap">
                                <p class="text-right">
                                    <a href="#">아이디 <span class="text-gray">/</span> 비밀번호 찾기</a>
                                </p>
                                <button type="submit" class="btn btn-login btn-board color-type7">로그인</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="login-info">
                    <img src="/assets/image/sub/login_logo.png" alt="M2community">
                    <p>
                        대한신경중재치료의학회 홈페이지에 처음 방문하신 분들은<br>
                        회원가입 후 이용 부탁드립니다.
                    </p>
                    <div class="btn-wrap text-center">
                        <a href="#" class="btn btn-board color-type5">회원가입 바로가기 <span class="font-suite next">&gt;</span></a>
                    </div>
                </div>
            </div>
            <!-- //e:login-->
        </div>
    </article>
@endsection
