<?php

namespace Akshay\PriceScheduler\Helper;

use Akshay\PriceScheduler\Model\ProductUploader;

class Data 
{
    protected $productupload;

    public function __construct(ProductUploader $productupload)
    {
        $this->productupload = $productupload;
    }
    
    public function Uploader()
    {
        $this->productupload->ProductLoader();
    }

    public function csvToJson($fname) {
        // open csv file
        if (!($fp = fopen($fname, 'r'))) {
            die("Can't open file...");
        }
        
        //read csv headers
        $key = fgetcsv($fp,"1024",",");
        
        // parse csv rows into array
        $json = array();
            while ($row = fgetcsv($fp,"1024",",")) {
            $json[] = array_combine($key, $row);
        }
        
        // release file handle
        fclose($fp);
        
        // encode array to json
        return json_encode($json);
    }
}
?>