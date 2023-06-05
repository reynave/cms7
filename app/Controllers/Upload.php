<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Model;
use CodeIgniter\Files\File;

class Upload extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
        );
        return $this->response->setJSON($data);
    }
  
    function uploadImages()
    {
        $data = array(
            "error" => true,
            "post" => $this->request->getVar(),
        );
        if ($data['post']['token']) {
            $validationRule = [
                'userfile' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[userfile]',
                        'is_image[userfile]',
                        'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                        'max_size[userfile,2000]',
                        'max_dims[userfile,2048,1536]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                $data = [
                    'errors' => $this->validator->getErrors(),
                    "post" => $this->request->getVar(),
                ];  
            }

            $file = $this->request->getFile('userfile');

            if (!$file->hasMoved()) {
                $overwrite = false;
                if( file_exists('./uploads/'.$data['post']['table'].'/'.$file->getName() ) ){
                    $overwrite = true;
                    unlink('./uploads/'.$data['post']['table'].'/'.$file->getName());
                }

                $file->move( './uploads/'.$data['post']['table']); 
                $data = [
                    "overwrite" => $overwrite,
                    "name" => $file->getName(),
                    "filepath" => $file, 
                    "post" => $this->request->getVar(),
                ]; 

                $this->db->table("pages")->update([ 
                    "img"    => base_url(). 'uploads/'.$data['post']['table'].'/'.$file->getName(), 
                    "update_date" => date("Y-m-d H:i:s"),
                ], "id = '" . $data['post']['id'] . "' ");

            }else{
                $data = [
                    'errors' =>  'The file has already been moved.',
                    "post" => $this->request->getVar(),
                ];
            }

           
        }

        return $this->response->setJSON($data);
    }

}
