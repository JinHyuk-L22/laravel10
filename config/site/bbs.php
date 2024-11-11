<?php

return [

    'params' => [
        'agree1' => [
            'Y' => '설정',
            'N' => '미설정'
        ],
        'agree2' => [
            'Y' => '사용',
            'N' => '미사용'
        ],
        'open' => [
            'Y' => '공개',
            'N' => '비공개'
        ],
        'popup_template' => [
            '99' => '없음',
            '1' => '팝업 템플릿1',
            '2' => '팝업 템플릿2'
        ],
        'popup_select' => [
            'N' => '공지내용과 동일',
            'P' => '팝업 내용 새로 작성'
        ],
        'popup_detail' => [
            'Y' => '설정함',
            'N' => '설정안함',
        ],
    ],

    'general' => [
        'title' => '일반게시판',  // 게시판 이름    
        'skin'  => 'general',    // 게시판 연결 view
        'use'   => [
            'notice'    => true, // 게시판 공지 사용 여부
            'main'      => true, // 메인 페이지에 표시 여부
            'link'      => true, // 링크 URL 항목 사용 여부
            'popup'     => true, // 팝업 사용 여부
            'reply'     => true, // 답글 사용 여부
            'commment'  => true, // 댓글(코멘트) 사용 여부
            'upload'    => true, // 업로드
        ],
        'pageView'  => 10,        // 리스트에 보여질 갯수
        'main_key'  => 'bbs',     // 상위 메뉴명
        'sub_key'   => 'general', // 하위 메뉴명
        'search'    => [          // 검색종류
            'all'       => '전체',
            'subject'   => '제목',
            'content'   => '내용'
        ],
        'permission' => [
            'list'  => function () {
                return true;
            },
            'post'  => function () {
                return isAdmin();
            },
            'show'  => function () {
                return true;
            },
            'data'  => function () {
                return true;
            },
        ],
    ],



];
