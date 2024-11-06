@extends('layouts.header')
@section('content')
    @include('layouts.alert')
    @push('scripts')

@endpush
<article id="section01" class="section">
    <article class="main-visual-wrap">
        <div class="main-visual js-main-visual">
           <!--  <div class="main-visual-con">
                <div class="inner-layer">
                    <div class="text-wrap">
                        <h2 class="visual-tit icon-tit"><span class="font-elice">대한대한신경중재치료의학회 ddddddd</span></h2>
                        <p class="visual-sub-tit font-elice">Korean Society of <br class="m-show">Interventional Neuroradiology</p>
                        <p class="m-hide">
                            신경중재치료의학은 영상의학기기를 이용하고 신경중재의료기구를 사용하여 <br>
                            비침습적, 비수술적, 비파괴적 방법으로 뇌혈관질환 및 관련신경계질환을 <br>
                            정확히 진단하고 보다 더 안전하고 정확한 방법으로 치료하는 학문입니다.
                        </p>
                    </div>
                    <div class="img-wrap"><img src="/assets/image/main/img_mainvisual.gif" alt=""></div>
                </div>
            </div> -->
            <div class="main-visual-con">
                <div class="inner-layer">
                    <div class="text-wrap">
                        <h2 class="visual-tit icon-tit"><span class="font-elice">대한신경중재치료의학회123</span></h2>
                        <p class="visual-sub-tit font-elice">Korean Society of <br class="m-show">Interventional Neuroradiology</p>
                        <p class="m-hide">
                            신경중재치료의학은 영상의학기기를 이용하고 신경중재의료기구를 사용하여 <br>
                            비침습적, 비수술적, 비파괴적 방법으로 뇌혈관질환 및 관련신경계질환을 <br>
                            정확히 진단하고 보다 더 안전하고 정확한 방법으로 치료하는 학문입니다.
                        </p>
                    </div>
                    <div class="img-wrap"><img src="/assets/image/main/img_mainvisual.gif" alt=""></div>
                </div>
            </div>
			<div class="main-visual-con">
                <div class="inner-layer">
                    <div class="text-wrap">
                        <h2 class="visual-tit icon-tit"><span class="font-elice">대한신경중재치료의학회2</span></h2>
                        <p class="visual-sub-tit font-elice">Korean Society of <br class="m-show">Interventional Neuroradiology</p>
                        <p class="m-hide">
                            신경중재치료의학은 영상의학기기를 이용하고 신경중재의료기구를 사용하여 <br>
                            비침습적, 비수술적, 비파괴적 방법으로 뇌혈관질환 및 관련신경계질환을 <br>
                            정확히 진단하고 보다 더 안전하고 정확한 방법으로 치료하는 학문입니다.
                        </p>
                    </div>
                    <div class="img-wrap"><img src="/assets/image/main/img_mainvisual.gif" alt=""></div>
                </div>
            </div>
        </div>
        <div class="main-visual-paging">
        </div>
    </article>
</article>
<article id="section02" class="section">
    <div class="main-tit-wrap">
        <h2 class="icon-tit"><span>Schedule</span></h2>
        <p>예정 된 일정을 안내 합니다. <br class="m-show">많은 관심과 참여 부탁 드립니다.</p>
    </div>
    <div class="inner-layer">
        <div class="main-calendar js-main-calendar">
            
        </div>
        <div class="slider-arrow">
            <a href="#n" class="prev">prev</a>
            <a href="#n" class="next">next</a>
        </div>
    </div>
</article>
<article id="section03" class="section">
    <div class="main-contents inner-layer">
        <div class="main-tit-wrap">
            <h2 class="icon-tit"><span>News</span></h2>
            <p>대한신경중재치료의학회의 <br class="m-show">주요 정보를 안내해드립니다.</p>
        </div>
        <div>
            <div class="tab-wrap">
                <ul class="main-tab-menu js-tab-menu js-tabcon-menu">
                    <li class="on"><a href="#n">공지사항</a></li>
                    <li><a href="#n">정회원 게시판</a></li>
                    <li><a href="#n">회원동정</a></li>
                </ul>
            </div>
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="btn-wrap text-right m-hide">
                    <a href="#" class="btn btn-small btn-round color-type18">바로가기<span class="ml-10">→</span></a>
                </div>
                <div class="main-news js-main-news">
                    
                </div>
                <div class="slick-attr">
                    <div class="slider-arrow">
                        <a href="#n" class="prev">prev</a>
                        <a href="#n" class="next">next</a>
                    </div>
                    <div class="dots-wrap"></div>
                </div>
            </div>
            <div class="sub-tab-con js-tab-con" style="display: none;">
                <div class="btn-wrap text-right m-hide">
                    <a href="#" class="btn btn-small btn-round color-type18">바로가기<span class="ml-10">→</span></a>
                </div>
                <div class="main-news js-main-news">
                    
                </div>
                <div class="slick-attr">
                    <div class="slider-arrow">
                        <a href="#n" class="prev">prev</a>
                        <a href="#n" class="next">next</a>
                    </div>
                    <div class="dots-wrap"></div>
                </div>
            </div>
            <div class="sub-tab-con js-tab-con" style="display: none;">
                <div class="btn-wrap text-right m-hide">
                    <a href="#" class="btn btn-small btn-round color-type18">바로가기<span class="ml-10">→</span></a>
                </div>
                <div class="main-news js-main-news">
                    
                </div>
                <div class="slick-attr">
                    <div class="slider-arrow">
                        <a href="#n" class="prev">prev</a>
                        <a href="#n" class="next">next</a>
                    </div>
                    <div class="dots-wrap"></div>
                </div>
            </div>
        </div>
    </div>
</article>
<article id="section04" class="section">
    <div class="main-tit-wrap">
        <h2 class="icon-tit"><span>학회활동</span></h2>
    </div>
    <div class="inner-layer">
        <div class="left">
            <div class="book-list">
                <div class="img-wrap">
                    <img src="/assets/image/main/main_book.png" alt="">
                </div>
                <div class="link-wrap">
                    <a href="https://www.neurointervention.org/" target="_blank">Search</a>
                    <a href="https://submit.neurointervention.org/" target="_blank">E-SUBMISSION</a>
                </div>
            </div>
            <h3>NEUROINTERVENTION</h3>
            <p>The Official Journal of KSIN</p>
        </div>
        <div class="right">
            <ul class="quick-list">
                <li><a href="#">해외학회 지원 <br>규정 및 신청</a></li>
                <li><a href="#">치료적정성 <br>평가 신청</a></li>
                <li><a href="#">KSIN 뉴스레터</a></li>
                <li><a href="#">학술대회 <br>영수증 출력</a></li>
            </ul>
        </div>
    </div>
</article>

<div class="none-fullpage section fp-auto-height">

    <div class="ksin-wrap">
        <ul class="ksin-list inner-layer">
            <li><a href="#">
                <img src="/assets/image/main/main_ksin_02.png" alt="">
                <p>KSIN 인증의 찾기</p>
            </a></li>
            <li><a href="#">
                <img src="/assets/image/main/main_ksin_01.png" alt="">
                <p>KSIN 인증병원 찾기</p>
            </a></li>
        </ul>
    </div>

    <article class="sponsor-wrap">
        <div class="inner-layer">
            <p>SPONSORS</p>
            <div class="sponsor-rolling-wrap js-sponsor-rolling">
                <div>
                    <a -href="#n">
                        <img src="/assets/image/common/main_bnr_CNV_240522.gif" alt="존슨앤존슨">
                    </a>
            
                        <a href="https://turquoise-trilby-ca9.notion.site/Cerenovous-f35607d550d041c0b9390ad5f93784ec?pvs=4" target="_blank" class="tit">Johnson&Johnson 뉴스
                           
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                   
                        </a>
               
                </div>
                <div>
                    <a -href="#n">
                        <img src="/assets/image/common/main_bnr_stryker_231214.png" alt="스트라이커">
                    </a>
          
                        <a href="https://turquoise-trilby-ca9.notion.site/Stryker-84d478c99a9c48d9bb205de4443f5799" target="_blank" class="tit">Stryker 뉴스
                      
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                      
                        </a>
            
                </div>
                <div>
                    <a href="http://www.dkls.co.kr/" target="_blank">
                        <img src="/assets/image/common/main_bnr_Dongko_231214.png" alt="동국생명과학">
                    </a>
                 
                        <a href="https://turquoise-trilby-ca9.notion.site/Dongkook-Lifescience-800b53d892a844a98cf0912fb0f10506" target="_blank" class="tit">Dongkook 뉴스
                      
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                       
                        </a>
                 
                </div>
                <div>
                    <a href="https://baltgroup.com/" target="_blank">
                        <img src="/assets/image/common/main_bnr_taewoong_231214.gif" alt="Balt">
                    </a>
        
                        <a href="https://turquoise-trilby-ca9.notion.site/Balt-0f6b36e594b14cedbdfbd288e1e2acf4" target="_blank" class="tit">Balt 뉴스
                          
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                     
                        </a>
             
                </div>
                <div>
                    <a href="https://www.medtronic.com/us-en/e/neurovascular/product-portfolio.html" target="_blank">
                        <img src="/assets/image/common/main_bnr_medtronic_231214.jpg" alt="메드트로닉">
                    </a>
                 
                        <a href="https://turquoise-trilby-ca9.notion.site/Medtronic-e7c081da2bf543a1a16b6814d4ed256f" target="_blank" class="tit">Medtronic 뉴스
                           
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                      
                        </a>
               
                </div>
                <div>
                    <a href="https://www.guerbet.com/ko-kr/" target="_blank">
                        <img src="/assets/image/common/main_bnr_guerbet_231214.gif" alt="게르베">
                    </a>
               
                        <a href="https://turquoise-trilby-ca9.notion.site/Guerbet-fff00ac9aaae41a3ac5aca152c641ffb" target="_blank" class="tit">Guerbet 뉴스
                   
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                      
                        </a>
            
                </div>
                <div>
                    <a href="https://www.bracco.com/" target="_blank">
                        <img src="/assets/image/common/main_bnr_bracco_231214.jpg" alt="브라코이미징코리아">
                    </a>
             
                        <a href="https://turquoise-trilby-ca9.notion.site/Bracco-0e459642be5d4d6d99dac1ed0429287e" target="_blank" class="tit">Bracco 뉴스
                     
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                   
                        </a>
               
                </div>
                <div>
                    <a href="https://www.gehealthcare.co.kr/products/contrast-media" target="_blank">
                        <img src="/assets/image/common/main_bnr_GE_231214.gif" alt="GE Healthcare ">
                    </a>
                 
                        <a href="https://turquoise-trilby-ca9.notion.site/GE-Healthcare-54434d5b9cc049989aa55ee34a15c6b5" target="_blank" class="tit">GE Healthcare 뉴스
                         
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                       
                        </a>
                
                </div>
                <div>
                    <a href="https://www.kr.abbott/" target="_blank">
                        <img src="/assets/image/common/main_bnr_Perclose_231214.gif" alt="애보트메디칼코리아">
                    </a>
                 
                        <a href="https://turquoise-trilby-ca9.notion.site/Abbott-46a67730af1c41f8ae6a5618ef5334cb?pvs=74" target="_blank" class="tit">Abbott 뉴스
                        
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                        
                        </a>
             
                </div>
                <div>
                    <a href="https://www.microvention.com/" target="_blank">
                        <img src="/assets/image/common/main_bnr_terumo_240920.png" alt="microvention">
                    </a>
             
                        <a href="https://turquoise-trilby-ca9.notion.site/MicroVention-6bf59267ce3246548b3b86d181034723" target="_blank" class="tit">Microvention 뉴스
                       
                                <img src="/assets/image/common/main_new_icon.png" alt="New">
                     
                        </a>
              
                </div>
            </div>
        </div>
    </article>

@endsection
