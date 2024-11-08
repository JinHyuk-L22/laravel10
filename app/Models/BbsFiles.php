<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Awobaz\Compoships\Compoships;

class BbsFiles extends Model
{
    use HasFactory, SoftDeletes, Compoships;

    protected $table = 'bbs_files';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $casts = [
    ];
    protected $attributes = [
        'download' => 0
    ];

    # Carbon 객체로 변환
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->updated_at = null;
        });
    }

    public function setByData( $file, $path, $imsi ){

        $filename = $file->getClientOriginalName();
        $save_name = (now()->format('YmdHis').'.'.rand(10, 10000).'.'. rand(1, 10) . '.' . rand(1, 10));

        $this->code        = $path;
        $this->gubun       = $imsi;
        $this->filename    = $filename;
        $this->realfile    = $save_name;
    }

    public function getIconType(){

        $result = '';
        $file = explode('.', $this->filename);
        $ext = end($file);

        switch ( strtolower($ext) ){
            case 'xlsx' : $result = 'ic_xcel'; break;
            case 'word' : $result = 'ic_word'; break;
            case 'hwp' : $result = 'ic_hwp'; break;
            case 'pdf' : $result = 'ic_pdf'; break;
            case 'jpg':
            case 'png' : $result = 'ic_png'; break;
        }

        return $result;

    }

}
