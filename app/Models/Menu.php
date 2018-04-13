<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [ 'name','slug', 'pid','title_cn', 'title_en', 'class', 'desc', 'link_url', 'icon', 'sort',];
    protected $hidden =['updated_at','created_at'];
}
