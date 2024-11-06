<?php

// check Url
if (!function_exists('checkUrl')) {
    function checkUrl(): string
    {
        $uri = str_replace('://www.', '://', request()->getUri());

        if (strpos($uri, config('site.app.api.url')) !== false) {
            return 'api';
        }

        if (strpos($uri, config('site.app.admin.url')) !== false) {
            return 'admin';
        }

        return 'web';
    }
}

// get App Name
if (!function_exists('getAppName')) {
    function getAppName(): string
    {
        return config('site.app.' . checkUrl() . '.app_name');
    }
}

// get default url
if (!function_exists('getDefaultUrl')) {
    function getDefaultUrl($auth = false): string
    {
        if ($auth) {
            return thisAuth()->check()
                ? getDefaultUrl()
                : url('member/login');
        }

        return route('main');
    }
}

// thisLevel
if (!function_exists('thisLevel')) {
    function thisLevel(): string
    {
        return thisUser()->level ?? '';
    }
}

// isAdmin
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return ((thisUser()->is_admin ?? '') === 'Y');
    }
}

// date Text
if (!function_exists('dateText')) {
    function dateText($case)
    {
        $date = config('site.important-date')[$case];
        $date = \Carbon\Carbon::parse($date);

        return $date->format('F j (D), Y');
    }
}

// D-day
if (!function_exists('DDay')) {
    function DDay($case)
    {
        $date = config('site.important-date')[$case];
        $date = explode('-', $date);

        $currentDate = \Carbon\Carbon::now();
        $targetDate = \Carbon\Carbon::create($date[0], $date[1], $date[2]);

        $daysUntilTarget = $currentDate->diffInDays($targetDate);

        if ($daysUntilTarget > 0) {
            return "D-" . $daysUntilTarget;
        }

        if ($daysUntilTarget == 0) {
            return "D-day";
        }

        return 'END';
    }
}

// 쿠키 가져오기
if (!function_exists('getCookie')) {
    function getCookie($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }

        return null;
    }
}


