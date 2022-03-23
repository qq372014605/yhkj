<?php
/**
 * model操作基类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2022/3/23
 * Time: 14:31
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    //导出csv
    public static function exportCsv($data,$fileName='')
    {
        if(empty($fileName)){
            $fileName = date('Y-m-d H:i:s').' '.mt_rand(10000,99999).'.csv';
        }

        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$fileName);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');

        foreach ($data as $row){
            $str = '';
            foreach ($row as $val){
                $str .= ','.iconv('utf-8','gbk',$val);
            }
            echo ltrim($str,',')."\n";
        }

        exit;
    }
}