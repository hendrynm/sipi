<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AntigenModel extends Model
{
    public function getListAntigen()
    {
        return DB::table("antigen")->select("id_antigen","nama_antigen")->get();
    }
}
