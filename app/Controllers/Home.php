<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;

class Home extends BaseController
{

    public function index()
    {

        $login = true;
        // helper('cookie');

        // if(get_cookie("ecms7tokn") != null){
        //     $login = true;
        // }

        if( isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] != 'iframe' ) {
       //     $login = false;
        } 

        model('Core')->set_login($login);

        $data = array( 
            "init" => model('Core')->iniCms($login),
            "core" => model('Core')->cms($login),
            "widget" => model('Widget')->index(), 
            "request" =>  $this->request->getVar(),
        );
        
        if (isset($data['request']['data']) ) {
            if( $data['request']['data']   === 'json'){
                $return =  $this->response->setJSON($data);
            }else{
                $return =  view($data['init']['themes'], $data);
            }
           
        } else { 
            $return =  view($data['init']['themes'], $data);
        }
        return  $return;
    }


    function thumb()
    {
        
        // call : http://localhost/website/cms7/public/thumb.app
        $image = \Config\Services::image();

        $path = './../document/images01.jpg';
        $pathSave = './uploads/images01_thumb.jpg';
        $w = $this->request->getVar('w');
        $h = $this->request->getVar('h');
      //  header("Content-Type: image/jpeg");
     //   $this->response->setHeader('Content-Type', 'image/jpeg');
        if (file_exists($pathSave)) {
            echo "exists $w $h";
        } else {
            echo "Generate $w $h";
            $image->withFile($path)
                ->fit($w, $h, 'center')
                ->save($pathSave);
        }
      //  return  $this->response->download( $pathSave, null);
       //return  $this->response->download( $pathSave, null);
     // echo file_get_contents( $pathSave);
       // echo $pathSave;
        echo "<img src='$pathSave'>";
    }

    function config(){
        $this->response->setHeader('Content-Type', 'application/javascript');
        echo "let base_url = '".base_url()."';";
        echo "\n";
        echo "let upload_url = '".base_url()."uploads/';";
        echo "\n";
        echo "let api = '".base_url()."api/';";
        
    }
}
