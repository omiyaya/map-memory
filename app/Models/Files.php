<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Files extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'files';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $id = 'id';
    protected $user_id = 'user_id';
    protected $map_id = 'map_id';
    protected $file_name_org = 'file_name_org';
    protected $file_name = 'file_name';
    protected $extension = 'extension';
    protected $directory = 'directory';
    protected $regist_user = 'regist_user';
    protected $regist_date = 'regist_date';
    protected $update_user = 'update_user';
    protected $update_date = 'update_date';

    public function getFiles($user_id, $map_id) {
        $result = DB::table($this->table)->where([
            ['user_id', '=', $user_id],
            ['map_id', '=', $map_id]
        ])->get()->toArray();
        return $result;
    }

    public function registFiles($user_id, $map_id, $file_name_org, $file_name, $extension, $directory) {
        DB::table($this->table)->insert([
            $this->user_id => $user_id,
            $this->map_id => $map_id,
            $this->file_name_org => $file_name_org,
            $this->file_name => $file_name,
            $this->extension => $extension,
            $this->directory => $directory,
            $this->regist_user => $user_id,
            $this->regist_date => Carbon::now(),
            $this->update_user => $user_id,
            $this->update_date => Carbon::now(),
        ]);
    }

    public function updateFileName($id, $fileName) {
        DB::table($this->table)->where('id', $id)->update([$this->file_name_org => $fileName]);
    }

}
