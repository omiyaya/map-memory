<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TPhoto;

class MapDetailController extends CommonController
{
    public function index($area_id) {
        // ログインチェック
        if (!$this->commonAuth->isLogin()) {
            return redirect('login');
        }
        $post = $this->request->input();
        $model_t_photo = new TPhoto;

        // マップ情報取得
        $map = config('map');
        $post['map_info'] = $map['large'][$area_id];
        $user_id = 1;
        $post['photo'] =  $this->commonBegin->changePostNameListData($model_t_photo->getPhoto($user_id, $area_id));

        $jsonPost = json_encode($post);
        return view('map.map_detail', compact('post', 'jsonPost'));
    }

    public function regist($area_id) {
        // ログインチェック
        if (!$this->commonAuth->isLogin()) {
            return redirect('login');
        }

        // マップ情報取得
        $post = $this->request->input();
        $photos = $this->request->file('memory_photo');
        $model_t_photo = new TPhoto;
        $user_id = 1;
        $directory = '/map_photo';

        DB::beginTransaction();
        try {
            if ($photos != null) {
                // 添付ファイル登録
                foreach ($photos as $photo) {
                    $photo_name = $photo->getClientOriginalName();
                    $photo_hash_name = $photo->hashName();
                    $extension = $photo->extension();
                    
                    $model_t_photo->registPhoto($user_id, $area_id, $photo_name, $photo_hash_name, $extension);
    
                    $photo->storeAs('public', $photo_hash_name);
                    DB::commit();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect('map/map_detail/' . $area_id);
    }

    protected function getMapPhoto($area_id) {
        $post = $this->request->input();
        $model_t_photo = new TPhoto;
        $user_id = 1;
        
        
        DB::beginTransaction();
        try {
            $photos =  $this->commonBegin->changePostNameListData($model_t_photo->getphoto($user_id, $area_id));
        } catch (Exception $e) {
            dd($e);
        }
        
        $jsonPost = json_encode($photos);
        return $jsonPost;
    }

    public function commentRegist(){
        $post = $this->request->input();
        $model_t_photo = new TPhoto;

        $area_id = $post[0];
        $photo_id = $post[1];
        $photo_name = $post[2];
        $user_id = 1;

        
        DB::beginTransaction();
        try {
            $model_t_photo->updatePhotoName($photo_id, $photo_name); 
            $photos =  $this->commonBegin->changePostNameListData($model_t_photo->getPhoto($user_id, $area_id));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        
        $jsonPost = json_encode($photos);
        return $jsonPost;
    }
    

}
