<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;

class Home extends BaseController
{

    public function index()
    {
 
        $data = array(
            "init" => model('Core')->iniCms(),
            "core" => model('Core')->cms(),
            "widget" => model('Widget')->index(),
            "getIPAddress" =>  request()->getIPAddress(),
            "request" =>  $this->request->getVar(),
        );

        if (isset($data['request']['data']) == 'json') {
            return $this->response->setJSON($data);
        } else { 
            return view($data['init']['themes'], $data);
        }
    }


    function thumb($w = 200, $h = 200)
    {

        $image = \Config\Services::image();

        $path = './../document/images01.jpg';
        $pathSave = './../document/images01_thumb.jpg';


        if (file_exists($pathSave)) {
            echo "exists";
        } else {
            echo "Generate";
            $image->withFile($path)
                ->fit($w, $h, 'center')
                ->save($pathSave);
        }


        echo "<img src='$pathSave'>";
    }
}
