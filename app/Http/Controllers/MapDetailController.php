<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Files;

class MapDetailController extends CommonController
{
    public function index($map_id) {
        // ログインチェック
        if (!$this->commonAuth->isLogin()) {
            return redirect('login');
        }
        $post = $this->request->input();
        $modelFiles = new Files;

        // マップ情報取得
        $map = config('map');
        $post['map_info'] = $map['large'][$map_id];
        $user_id = 1;
        $post['files'] =  $this->commonBegin->changePostNameListData($modelFiles->getFiles($user_id, $map_id));

        $jsonPost = json_encode($post);
        return view('map.map_detail', compact('post', 'jsonPost'));
    }

    public function regist($map_id) {
        // ログインチェック
        if (!$this->commonAuth->isLogin()) {
            return redirect('login');
        }

        // マップ情報取得
        $post = $this->request->input();
        $files = $this->request->file('memory_files');
        $modelFiles = new Files;
        $user_id = 1;
        $directory = '/map_files';

        DB::beginTransaction();
        try {
            if ($files != null) {
                // 添付ファイル登録
                foreach ($files as $file) {
                    $file_name_org = $file->getClientOriginalName();
                    $file_name = $file->hashName();
                    $extension = $file->extension();
    
                    $modelFiles->registFiles($user_id, $map_id, $file_name_org, $file_name, $extension, $directory);
    
                    $file->storeAs('public', $file_name);
                    DB::commit();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect('map/map_detail/' . $map_id);
    }

    protected function getMapFiles($map_id) {
        $post = $this->request->input();
        $modelFiles = new Files;
        $user_id = 1;
        
        
        DB::beginTransaction();
        try {
            $files =  $this->commonBegin->changePostNameListData($modelFiles->getFiles($user_id, $map_id));
        } catch (Exception $e) {
            dd($e);
        }
        
        $jsonPost = json_encode($files);
        return $jsonPost;
    }

    public function commentRegist(){
        $post = $this->request->input();
        $modelFiles = new Files;

        $map_id = $post[0];
        $file_id = $post[1];
        $fileName = $post[2];
        $user_id = 1;

        
        DB::beginTransaction();
        try {
            $modelFiles->updateFileName($file_id, $fileName); 
            $files =  $this->commonBegin->changePostNameListData($modelFiles->getFiles($user_id, $map_id));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        
        $jsonPost = json_encode($files);
        return $jsonPost;
    }
    

}
