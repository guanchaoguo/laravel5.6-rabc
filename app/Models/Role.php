<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function menus()
    {
        return $this->belongsToMany(Menu::class,'role_menus','role_id','menu_id');
    }
}
