<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TPhoto extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 't_photo';
    protected $primaryKey = 'photo_id';
    public $timestamps = true;

    protected $photo_id			=	'photo_id';
    protected $photo_name		=	'photo_name';
    protected $photo_hash_name	=	'photo_hash_name';
    protected $photo_extension	=	'photo_extension';
    protected $photo_date		=	'photo_date';
    protected $share_on			=	'share_on';
    protected $user_id			=	'user_id';
    protected $area_id			=	'area_id';
    protected $created_at		=	'created_at';
    protected $updated_at		=	'updated_at';
    

    public function getPhoto($user_id, $area_id) {
        $result = DB::table($this->table)->where([
            [$this->user_id, '=', $user_id],
            [$this->area_id, '=', $area_id]
        ])->get();
        return $result;
    }

    public function registPhoto($user_id, $area_id, $photo_name, $photo_hash_name, $photo_extension) {
        DB::table($this->table)->insert([
            $this->user_id => $user_id,
            $this->area_id => $area_id,
            $this->photo_name => $photo_name,
            $this->photo_hash_name => $photo_hash_name,
            $this->photo_extension => $photo_extension,
            $this->updated_at => Carbon::now(),
        ]);
    }

    public function updatePhotoName($photo_id, $photo_name) {
        DB::table($this->table)->where($this->photo_id, $photo_id)->update([$this->photo_name => $photo_name]);
    }

}
