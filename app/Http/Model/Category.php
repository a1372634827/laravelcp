<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;


//    public function tree()
//    {
//        $categorys=$this->all();
//         return $this->getTree($categorys,'cate_id','cate_name','cate_pid',0);
//    }

    public static  function tree()
    {
        $categorys=Category::orderBy('cate_order','dsc')->get();
        return  self::getTree($categorys,'cate_id','cate_name','cate_pid',0);
    }


    public static function getTree($data,$field_id='id',$field_name,$field_pid='pid',$pid=0)
    {
        $arr=array();
        foreach($data as $k=>$v){
            if($v->$field_pid==$pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[]=$data[$k];
                foreach($data as $m=>$n){
                    if($n->$field_pid==$v->$field_id){
                        $data[$m]["_".$field_name] = '┣━'.$data[$m][$field_name];
                        $arr[]=$data[$m];
                    }
                }
            }
        }
        return $arr;
    }


}
