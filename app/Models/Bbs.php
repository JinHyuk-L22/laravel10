<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Awobaz\Compoships\Compoships;

class Bbs extends Model{
    use HasFactory, SoftDeletes, Compoships;

    protected $table = 'bbs_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $casts = [
    ];

    protected $attributes = [
        'push'              => 'N',
        'notice'            => 'N',
        'popup'             => 'N',
        'popup_template'    => '99',
        'popup_select'      => 'N',
        'popup_width'       => '500',
        'popup_height'      => '400',
        'popup_position_y'  => '100',
        'popup_position_x'  => '100',
        'popup_detail'      => 'N',
        'open'              => 'Y',
    ];

    # Carbon 객체로 변환
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected static function booted(){
        static::creating(function($model){
            $model->updated_at = null;
        });
    }

    public static function list( $bbs_name, $notice, $request ){

        $result = self::where([
            ['code', '=', $bbs_name],
            ['notice', '=', $notice]
        ]);

        return $result;
    }

    

    public function setByData( $request ){

        if( empty($this->sid) ){
            $this->code             = $request->route()->parameter('bbs_name');
            $this->id               = $request->id;
            $this->name             = $request->name;
            $this->email            = $request->email;
            $this->ip               = $request->ip();
        }

        $this->subject          = $request->subject;
        $this->content          = $request->content;
        $this->linkurl          = $request->linkurl;

        $this->popup            = $request->popup ?? 'N';
        $this->popup_template   = $request->popup_template;
        $this->popup_select     = $request->popup_select;
        $this->popup_width      = $request->popup_width;
        $this->popup_height     = $request->popup_height;
        $this->popup_position_y = $request->popup_position_y;
        $this->popup_position_x = $request->popup_position_x;
        $this->popup_detail     = $request->popup_detail;
        $this->popup_startdate  = $request->popup_startdate;
        $this->popup_enddate    = $request->popup_enddate;
        $this->notice           = $request->notice ?? 'N';
        $this->open             = $request->open;
        $this->push             = $reuqest->push ?? 'N';

        $this->gubun            = $request->gubun ?? '';
        $this->reviewer         = $request->reviewer ?? '';
        $this->date            = $request->date ?? '';

        if( !empty($request->file_del) ){
            $path = 'public/uploads/bbs/'.$request->route()->parameter('bbs_name').'/'.$this->file;

            if ( Storage::exists( $path ) === false ) {
                abort(404);
            }

            Storage::delete($path);

            $this->file = null;
            $this->filename = null;

        } elseif( !empty($request->b_file_del) ){

            $file = BbsFiles::find($request->b_file_del);

            $path = 'public/uploads/bbs/'.$request->route()->parameter('bbs_name').'/'.$file->realname;

            if ( Storage::exists( $path ) === false ) {
                abort(404);
            }

            Storage::delete($path);

            $file->delete();

        }

        if( $request->hasFile('filename') ){

            $directory = config('site.bbs.save_dir');

            $file = $request->file('filename');

            $ext = $file->getClientOriginalExtension();
            if( !preg_match('/jpg|JPG|png|PNG/', $ext) ) {
                return redirect()->back()->withInput()->with('alert', '이미지파일만 업로드 가능합니다.');
            }
            $save_name = (now()->format('YmdHis').'.'.rand(10, 10000).'.'. rand(1, 10) . '.' . rand(1, 10)).'.'.$ext;

            $file->storeAs('public/'.$directory.'/'.$request->route()->parameter('bbs_name'), $save_name);
            $this->filename = preg_replace("/[ #\&\+\-%@=\/\\\:;,\'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", ' ', $file->getClientOriginalName());
            $this->file = $save_name;
        }

        # 월례집담회
        $this->etc1 = $request->etc1 ?? '';
        $this->etc2 = $request->etc2 ?? '';
        $this->etc3 = $request->etc3 ?? '';
        $this->etc4 = $request->etc4 ?? '';
        $this->etc5 = $request->etc5 ?? '';
        $this->etc6 = $request->etc6 ?? '';
        $this->etc7 = $request->etc7 ?? '';

        $this->category = $request->category ?? '';

    }

    public function setByFiles( $request ){

        $delete_files = $request->delete_files ?? null;
        if (is_array($delete_files) && !empty($delete_files)) {
            $bbsFiles = BbsFiles::find($delete_files);

            FileController::file_delete($bbsFiles);
        }

        $files = BbsFiles::where( 'gubun', '=', $request->imsi )
            ->update([
                'code'  => $this->code,
                'bsid'  => $this->sid,
                'gubun' => ''
            ]);
    }



    // public function comments(){
    //     return $this->hasMany(BbsComment::class, ['bsid', 'code'], ['sid', 'code']);
    // }

    public function files(){
        return $this->hasMany(BbsFiles::class, ['bsid', 'code'], ['sid', 'code']);
    }

    // public function orderByComments(){
    //     return $this->comments()->orderBy('re_ref', 'desc')->orderBy('re_step', 'asc');
    // }

}
