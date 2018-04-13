<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
       $permissions = Menu::all()->toArray();
       $permission_list =  list_to_tree($permissions);
        return repJson([
            'data' =>$permission_list
        ]);
    }


    public function create()
    {

    }

    public function show($id)
    {
        $ret = Permission::find($id);

        if(!$ret){
            return repJson('', 'data_not_exist', 400);
        }

        return repJson([
            'data'=> $ret,
        ]);
    }



    public function update(Request $request)
    {
        //
    }


    public function destroy($id)
    {
        $info = Permission::find($id);
        if(  ! $info ) {
            return repJson('', 'data_not_exist', 400);
        }

        $res = $info->delete();
        if( ! $res ){
            return repJson('','fail',400);
        }

        return repJson();
    }
}
