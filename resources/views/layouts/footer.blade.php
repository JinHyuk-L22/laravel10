                        
                        <button type="button" class="btn-top js-btn-top">
                            <img src="/assets/image/common/ic_top.png" alt="">
                            TOP
                        </button>
                        <footer id="footer">
                            <div class="footer-wrap">
                                <div class="footer-top">
                                    <div class="inner-layer">
                                        <dl>
                                            <dt>학회업무문의</dt>
                                            <dd>
                                                <p>
                                                    <strong>TEL.</strong> <a href="tel:031-994-4382" target="_blank">031-994-4382</a>
                                                </p>
                                                <p>
                                                    <strong>FAX.</strong> 070-4009-3667
                                                </p>
                                                <p>
                                                    <strong>E-mail.</strong> <a href="mailto:ksin@ksin.or.kr" target="_blank">ksin@ksin.or.kr</a>
                                                </p>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>학술행사관련문의</dt>
                                            <dd>
                                                <p>
                                                    <strong>TEL.</strong> <a href="tel:031-926-2729" target="_blank">031-926-2729</a>
                                                </p>
                                                <p>
                                                    <strong>E-mail.</strong> <a href="mailto:conference@ksin.or.kr" target="_blank">conference@ksin.or.kr</a>
                                                </p>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="footer-bottom">
                                    <div class="inner-layer">
                                        <p class="address">
                                            대한신경중재치료의학회 사무국 Secretariat of Korean Society of Interventional Neuroradiology<br>
                                            경기도 용인시 기흥구 강남로 9, 705-2C호 (구갈동, 태평양프라자)
                                        </p>
                                        <ul class="footer-menu">
                                            <li><a href="/member/join/privacy">개인정보 취급방침</a></li>
                                            <li><a href="/member/join/email">이메일 무단 수집 거부</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </footer>
                    </div>
                </section>

            @if( isset($is_main) )
                <ul class="main-menu js-fullpage-menu bg">
                    <li data-menuanchor="1st" class="active"><a href="#1st">메인</a></li>
                    <li data-menuanchor="2nd" class=""><a href="#2nd">학술대회</a></li>
                    <li data-menuanchor="3rd" class=""><a href="#3rd">게시판</a></li>
                    <li data-menuanchor="4th" class=""><a href="#4th">학회활동</a></li>
                </ul>

                <a href="#n" class="btn-scroll js-btn-scroll">
                    <img src="/assets/image/main/ic_scroll.png"alt="">
                </a>
            @endif
        </div>
        <div class="popup-wrap pop-center" id="popup-ksin" style="display: none;"></div>

    </body>

</html>