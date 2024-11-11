<?php

namespace App\Services\Bbs;

use Carbon\Carbon;
use App\Models\Bbs;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


/**
 * Class SignupServices
 * @package App\Services
 */
class BbsServices extends AppServices{

    public function dataAction(Request $request){

        switch ($request->type) {
            case 'popPreview'   : return $this->popPreview($request);
            case 'post'         : return $this->post($request);
            default:
                return notFoundRedirect();
        }
    }

    private function popPreview( Request $request ){

        $bbs = new Bbs();
        $bbs->subject           = $request->subject;
        $bbs->content           = $request->content;
        $bbs->popup_width       = $request->popup_width;
        $bbs->popup_height      = $request->popup_height;
        $bbs->popup_position_y  = $request->popup_position_y;
        $bbs->popup_position_x  = $request->popup_position_x;
        $bbs->popup_detail      = $request->popup_detail;
        $bbs->linkurl           = $request->linkurl;

        return $this->returnJsonData( 'append', [
                $this->ajaxActionHtml( '.sub-contents', view("popup.templates.template".$request->popup_template, ['bbs' => $bbs]) )
            ]
        );

    }

    private function post( Request $request ){

        $bbs = new Bbs();
        $bbs->setByData( $request );
        $bbs->save();

    }

}
