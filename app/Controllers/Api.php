<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Model;

class Api extends BaseController
{

    public function index()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
        );
        return $this->response->setJSON($data);
    }

    public function login()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
        );
        return $this->response->setJSON($data);
    }

    public function widget_insert()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
            "token" => $this->request->getHeaderLine("token"),
        );

        $this->db->table('widget')->insert([
            'itype'  => $data['request']['itype'],
            "themes" => $data['request']['themes'],
            "img" =>  $data['request']['img'],
            "section" =>  $data['request']['section'],
            "presence" => 1,
            'input_by' => "dev",
            'input_date' => date("Y-m-d H:i:s"),
            'update_date' => date("Y-m-d H:i:s"),
        ]);

        return $this->response->setJSON($data);
    }

    public function insert()
    {
        $obj = [];
        foreach ($this->request->getVar() as $key => $value) {
            array_push($obj, [
                "key" => $key,
                "value" => $value,
            ]);
        }
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
            "object"  => $obj,
            "token" => $this->request->getHeaderLine("token"),
        );
        if ($data['request']['table'] == 'content') {
            $this->db->table($data['request']['table'])->insert([
                "name" => "Content " . date("Y-m-d H:i"),
                "url" => "content_" . hrtime()[0] . hrtime()[1],
                "pages_id" => $data['request']['pages_id'],
                "presence" => 1,
                'input_by' => "dev",
                'input_date' => date("Y-m-d H:i:s"),
                'update_date' => date("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->table($data['request']['table'])->insert([
                "presence" => 1,
                'input_by' => "dev",
                'input_date' => date("Y-m-d H:i:s"),
                'update_date' => date("Y-m-d H:i:s"),
            ]);
            $id = model("core")->select("id", $data['request']['table'], "1 order by input_date DESC");
            foreach ($data['object'] as $row) {
                if ($row['key'] != "table") {
                    $this->db->table($data['request']['table'])->update([
                        $row['key'] => $row['value'],
                    ], "id= $id ");
                }
            }
        }

        return $this->response->setJSON($data);
    }

    public function sorting()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
            "token" => $this->request->getHeaderLine("token"),
        );
        $i = 1;
        foreach ($data['request']['data'] as $row) {

            $this->db->table($row['table'])->update([
                "sorting" => $i++,
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $row['id'] . "' ");
        }

        return $this->response->setJSON($data);
    }

    public function delete()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
            "token" => $this->request->getHeaderLine("token"),
        );
        $this->db->table($data['request']['table'])->update([
            "presence" => 0,
            "update_date" => date("Y-m-d H:i:s")
        ], "id = '" . $data['request']['id'] . "' ");


        return $this->response->setJSON($data);
    }

    public function update()
    {
        $data = array(
            "error" => false,
            "request" =>  $this->request->getVar(),
            "token" => $this->request->getHeaderLine("token"),
        );
        $encode = false;
        if (isset($data['request']['encode'])) {
            if ((bool)$data['request']['encode'] == true) {
                $encode = true;
            }
        }

        $this->db->table($data['request']['table'])->update([
            $data['request']['column'] => $encode == true ? base64_decode($data['request']['value']) : $data['request']['value'],
            "update_date" => date("Y-m-d H:i:s")
        ], "id = '" . $data['request']['id'] . "' ");


        return $this->response->setJSON($data);
    }

    public function getData()
    {
        $obj = [];
        foreach ($this->request->getVar() as $key => $value) {
            array_push($obj, [
                "key" => $key,
                "value" => $value,
            ]);
        }
        $data = array(
            "request" => $this->request->getVar(),
            "object"  => $obj,
            "token"   => $this->request->getHeaderLine("token"),
        );
 
        return $this->response->setJSON($data);
    }

    public function getPages($parent_id = 0)
    {
        
      
        $query   = $this->db->query("SELECT id,parent_id, ilock, name, url, status, idefault, href, sorting FROM pages where parent_id = '$parent_id' and presence = 1 order by sorting ASC ");
        $results = $query->getResult();

        // $data = [
        //     "results" => $query->getResult(),
        //     "Token"=> $this->request->getHeaderLine("Token")
        // ];
       

        return $this->response->setJSON($results);
    } 
    public function pagesUpdateSorting()
    { 
        $data = [ 
            "post" => $this->request->getVar(),
            "Token"=> $this->request->getHeaderLine("Token")
        ]; 
    
        $i = 1;
        foreach ($this->request->getVar() as $row) {
            $this->db->table("pages")->update([
                "sorting" => $i++,
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $row . "' "); 
        }
        return $this->response->setJSON($data);
    }

    public function pagesUpdateStatus()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => false,
        ];
        if($post){
            $data = [ 
                "post" => $post,
                "getVar" => $this->request->getVar(),
                "Token"=> $this->request->getHeaderLine("Token")
            ]; 
            $this->db->table("pages")->update([
                "status" =>  $data['post']['status'],
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '".$data['post']['id']."' "); 
            
           
        }
        return $this->response->setJSON($data);
    }
}
