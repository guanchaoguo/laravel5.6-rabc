<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function index()
    {
       return repJson([
            'data' => list_to_tree(Menu::where('class',1)->get()->toArray(),'id','pid')
       ]);
    }


    public function create()
    {

    }

    public function show($id)
    {
        $ret = Menu::find($id);

        if(!$ret){
            return repJson('', 'data_not_exist', 400);
        }
        return repJson([
            'data'=> $ret,
        ]);
    }



    public function update(Request $request, Menu $menu)
    {
        //
    }


    public function destroy($id)
    {
        $info = Menu::find($id);
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
