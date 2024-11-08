<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * 파일 엄로드/다운로드
 *
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController{

    /**
     * 업로드
     *
     * @param Request $request
     * @param string $path
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $path){

        $bbsConfig = config('site.bbs');

        try {
            if ($request->hasFile('file')) {

                $file = $request->file('file');

                $files = new BbsFiles();
                $files->setByData( $file, $path, $request->imsi );
                
                $files->save();

                $stored_path = $file->storeAs('public/uploads/bbs/'.$path, $files->realfile);

                if ($stored_path !== false) {
                    \File::chmod( Storage::path($stored_path), 0777 );

                    return response()->json([
                        'result' => true,
                        'real_name' => $files->realfile,
                        'stored_path' => $stored_path
                    ]);
                } else {
                    return response()->json(['message' => '파일 업로드에 실패했습니다.'], 500);
                }
            }
        } catch (\Exception $e) {
            Logging::logWrite('error', 'File Upload Error : '.$e->getMessage());
        }

    }

    public function file_delete( $bbsFiles ){

        try {
            foreach ( $bbsFiles as $file ){
                if ( Storage::exists('public/uploads/bbs/'.$file->code, $file->realfile) ) {
                     Storage::delete('public/uploads/bbs/'.$file->code.'/'.$file->realfile);
                     $file->delete();
                }
            }
        } catch (Exception $e) {
            Logging::logWrite('error', 'File Delete Error : '.$e->getMessage());
        }

    }


    /**
     * 게시판 - 파일 다운로드
     *
     * @param Attachment $attachment
     * @return mixed
     */
    public function download2($sid)
    {

        $attachment = Attachment::find($sid);

//        var_dump($attachment->path); exit;
//
        if (Storage::exists($attachment->path) === false) {
            abort(404);
        }

        $attachment->downloads += 1;
        $attachment->save();

        return response()->download(Storage::path($attachment->path), $attachment->filename);
    }

    public function download($sid)
    {

        $bbs_files = Bbs_files::find($sid);

//        var_dump($attachment->path); exit;
//
        if (Storage::exists($bbs_files->path) === false) {
            abort(404);
        }

        $bbs_files->downloads += 1;
        $bbs_files->save();

        return response()->download(Storage::path($bbs_files->path), $bbs_files->filename);
    }


    /**
     * 연구 - 파일 다운로드
     *
     * @param Schedule_attachment $attachment
     * @return mixed
     */
    public function file_download(Schedule_attachment $attachment)
    {

        if (\Storage::exists('public/'.$attachment->path) === false) {
            abort(404);
        }

        $attachment->downloads += 1;
        $attachment->save();

        return response()->download(\Storage::path('public/'.$attachment->path), $attachment->filename);
    }

    /**
     * 삭제
     *
     * @param Attachment $attachment
     * @return mixed
     */
    public function delete($path)
    {
        try {
            if (Storage::exists('public/'.$path)) {
                Storage::delete('public/'.$path);
            }
        } catch (\Exception $e) {
            Logging::logWrite('error', 'File Delete Error : '.$e->getMessage());
        }

    }


}
