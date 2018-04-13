<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        /* $page_num = $request->input('page_num',10);
         $is_page = $request->input('is_page', 1);

         return $this->response->array([
             'code' => 0,
             'text' =>trans('room.success'),
             'result' => $is_page? ['data' => Permission::paginate($page_num)]:Permission::all(),
         ]);*/
        $role = Role::all()->toArray();
        return $this->response->array([
            'code' => 0,
            'text' =>trans('success'),
            'result' => ['data' =>$role],
        ]);
    }


    public function create()
    {

    }

    public function show($id)
    {
        $ret = Role::find($id);

        if(!$ret){
            return $this->response->array([
                'code'=>400,
                'msg'=>'data_not_exist',
                'result'=> '',
            ]);
        }
        return $this->response->array([
            'code'=>0,
            'msg'=>'success',
            'result'=> $ret,
        ]);
    }



    public function update(Request $request)
    {
        //
    }


    public function destroy($id)
    {
        $info = Role   ::find($id);
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
