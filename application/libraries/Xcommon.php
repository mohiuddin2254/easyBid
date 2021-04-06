<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/5/18
 * Time: 6:16 AM
 */

class Xcommon
{
    protected $CI;

    public function __construct()
    {
        //Instanciate CI Object
        $this->CI = & get_instance();
    }

    public static  function getProducts()
    {
        $products = [];
        for($i =1; $i<30; $i++)
        {
            $products["product".$i]= ['id'=>$i,'name'=>"pro-".$i,"price"=>4*$i];
        }

        return $products;
    }

}