<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Crawls extends Model
{
    // use HasFactory;

    protected $table = 'crawl';
    public $timestamps = false;

    public function insert(array $data) {
        return Db::table($this->table)->insert($data);
    }

    public function getCrawlsList($size) {
        return Db::table($this->table)->paginate($size);
    }
}
