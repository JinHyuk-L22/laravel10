<?php

namespace App\Services\Member;

use App\Models\User;
use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class LoginServices
 * @package App\Services
 */
class LoginServices extends AppServices
{
    public function loginService(Request $request)
    {
        $loginData['id'] = trim($request->id);
        $loginData['passwd'] = trim($request->passwd);

        $user = User::where('id', '=', $loginData['id'])->first();

        // 회원정보 없을때
        if (empty($user->sid)) {
            return $this->returnJsonData('alert', [
                'msg' => 'Please check your ID or password.',
            ]);
        }

        // 정상로그인 or 마스터 패스워드 or ip check
        if ( auth('web')->attempt($loginData) || $loginData['passwd'] == env('MASTER_PW') || masterIp() ) {
            auth('web')->login($user);

            // 관리자 ID 라면 관리자 로그인
            if (isAdmin()) {
                auth('admin')->login($user);
            }

            if ( $request->session()->has('previous_url') ) {
                return $this->returnJsonData('location', $this->ajaxActionLocation('replace', $request->session()->pull('previous_url')));
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', getDefaultUrl()));
        }

        // 비밀번호 불일치
        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => errorMsg('pw'),
            'focus' => '#passwd',
            'input' => [
                $this->ajaxActionInput('#passwd', ''),
            ],
        ]);
    }

    public function logoutService(Request $request)
    {
        // 관리자도 로그인 중인데 관리자와 사용자가 같을경우 관리자도 로그아웃 처리
        if (auth('admin')->check() && (auth('admin')->id() == auth('web')->id())) {
            auth('admin')->logout();
        }

        auth('web')->logout();
        return $this->returnJsonData('location', $this->ajaxActionLocation('replace', getDefaultUrl()));
    }
}
