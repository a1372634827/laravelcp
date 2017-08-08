<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class CategoryController extends CommonController
{
    //方法.URL
    //get.admin/category    全部分类列表
    public function index()
    {
   $categorys=Category::tree();
        //$categorys=(new Category)->tree();

      return view('admin.category.index')->with('data',$categorys);
    }

    public function changeorder()
    {
             $input=Input::all();
        $cate=(new Category)->find($input['cate_id']);
        $cate->cate_order=$input['cate_order'];
        $res=$cate->update();
        if($res){
            $data=[
               'status'=> 0,
               'msg'=> '排序更新成功！',

            ];


        }else{
            $data=[
              'status'=> 1,
                'msg'=>'排序更新失败！',
            ];

        }
        return $data;
    }

    
    //post.admin/category
    public function store()
    {

    }
    //get. admin/category/create 添加分类
    public function create()
    {
       return view('admin.category.add');
    }
    //get.admin/category/{category}
    public function show()
    {

    }
    //put.admin/category/{category}
    public function update()
    {

    }
    //delete.admin/category/{category}
    public function destroy()
    {

    }
    //get.admin/category/{category}/edit
    public function edit()
    {

    }
}
