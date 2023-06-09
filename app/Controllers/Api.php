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

    public function getPages()
    {

        $getVar = $this->request->getVar();
        $id = $getVar['id'];
        $parent_id =  $getVar['id'] ? model('Core')->select("parent_id", "pages", " id='$id' and presence = 1 ") : 0;
        $queryPages   = $this->db->query("SELECT id,parent_id,   name, url, status, idefault, href, sorting FROM pages where parent_id = '$parent_id' and presence = 1 order by sorting ASC ");
        $queryPagesChild   = $this->db->query("SELECT id,parent_id,   name, url, status, idefault, href, sorting FROM pages where parent_id = '$id' and presence = 1 order by sorting ASC ");

        $data = [
            "getVar" => $getVar,
            "parent_id" => $parent_id,
            "pages" => $queryPages->getResult(),
            "pagesChild" => $queryPagesChild->getResult(),
            "Token" => $this->request->getHeaderLine("Token")
        ];


        return $this->response->setJSON($data);
    }

    public function pagesUpdateSorting()
    {
        $data = [
            "post" => $this->request->getVar(),
            "Token" => $this->request->getHeaderLine("Token")
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

    public function pagesSetDefault()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
        ];
        if ($post) {
            $data = [
                "post" => $post,
                "getVar" => $this->request->getVar(),
                "Token" => $this->request->getHeaderLine("Token")
            ];
            $this->db->table("pages")->update([
                "idefault" => 0,
                "update_date" => date("Y-m-d H:i:s")
            ]);
            $this->db->table("pages")->update([
                "idefault" => 1,
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $data['post']['id'] . "' ");
        }
        return $this->response->setJSON($data);
    }

    public function pagesInsertChild()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => false,
        ];
        if ($post) {
            $this->db->table("pages")->insert([
                "parent_id" => $post['id'],
                "name" => "new Child",
                "status" => 4,
                "input_date" => date("Y-m-d H:i:s")
            ]);
        }
        return $this->response->setJSON($data);
    }

    public function pagesInsertParent()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => false,
        ];
        if ($post) {
            $this->db->table("pages")->insert([
                "parent_id" => model("Core")->select("parent_id", "pages", "id='" . $post['id'] . "'"),
                "name" => "new Child",
                "status" => 4,
                "input_date" => date("Y-m-d H:i:s")
            ]);
        }
        return $this->response->setJSON($data);
    }

    public function pagesUpdateStatus()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
        ];
        if ($post) {
            $data = [
                "post" => $post,
                "getVar" => $this->request->getVar(),
                "Token" => $this->request->getHeaderLine("Token")
            ];
            $this->db->table("pages")->update([
                "status" =>  $data['post']['status'],
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $data['post']['id'] . "' ");
        }
        return $this->response->setJSON($data);
    }

    public function pagesDetail()
    {
        $path    = './../app/views';
        $files = scandir($path);
        // print_r($files);
        $themes = [];
        foreach ($files as $row) {
            if ($row != "404.php" && $row != "." && $row != ".." && count(explode(".php", $row)) > 1) {
                array_push($themes, $row);
            }
        }
        $parend_id = 0;
        $get = $this->request->getVar();
        $queryPages   = $this->db->query("SELECT  * FROM pages where id = '" . $get['id'] . "' and presence = 1 order by sorting ASC ");
        if (count($queryPages->getResult()) > 0) {
            $parend_id = $queryPages->getResult()[0];
            $parend_id = $parend_id->parent_id;
        }

        $data = [
            "parent" => [
                "id" => $parend_id,
                "name" => $parend_id != "0" ? model("Core")->select("name", "pages", "id= '$parend_id' ") :  "- Root -",
            ],
            "item" => count($queryPages->getResult()) ? $queryPages->getResult()[0] : null,
            "themes" => $themes,
            "getVar" => $this->request->getVar(),
            "Token" => $this->request->getHeaderLine("Token")
        ];
        return $this->response->setJSON($data);
    }

    public function pagesDetailUpdate()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
        ];
        if ($post) {
            $data = [
                "error" => false,
                "post" => $post,
            ];

            $this->db->table("pages")->update([
                "name"      => $post['model']['name'],
                "themes"    => $post['model']['themes'],
                "url"       => $post['model']['url'],
                "href"      => $post['model']['href'],
                "metadata_description"  => $post['model']['metadata_description'],
                "metadata_keywords"     => $post['model']['metadata_keywords'],
                "title"                 => $post['model']['title'],
                "img"                 => $post['model']['img'],

                "update_date" => date("Y-m-d H:i:s"),
            ], "id = '" . $post['id'] . "' ");
        }


        return $this->response->setJSON($data);
    }

    public function pagesDelete()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
            "post" => $post,
        ];
        if ($post) {
            $parentId =  $post['id']; // ID parent yang akan dihapus
            model("Core")->deleteNode($parentId);
            $data  = [
                "error" => false,
            ];
        }
        return $this->response->setJSON($data);
    }



    public function widget()
    {
        $getVar = $this->request->getVar();
        $widget   = $this->db->query("SELECT section ,themes, COUNT(id) AS 'total'
        FROM widget WHERE presence = 1 AND themes != ''
        GROUP By section, themes
        ORDER BY section ASC ");

        $data = [
            "getVar" => $getVar,
            "items" => $widget->getResult(),
        ];


        return $this->response->setJSON($data);
    }

    public function widgetSection($section = "")
    {
        $getVar = $this->request->getVar();
        $widget   = $this->db->query("SELECT id, itype, themes, h1, img, sorting
        FROM widget WHERE presence = 1 AND section = '$section' 
        ORDER BY sorting ASC ");
        $items = [];

        foreach ($widget->getResultArray() as $row) {
            $img = $row['img'] ? explode("/", $row['img']) : [];
            //? base_url()."public/upload/thumbs/".end($img) : "https://dummyimage.com/400x400/dde6ed/526d82&text=123",
            $img = ($img == null) ? "https://dummyimage.com/400x400/dde6ed/526d82&text=W-" . $row['id'] : base_url() . "uploads/thumbs/" . end($img);
 

            $imgLocal = explode("/", $row['img']);
            $imgLocal = end($imgLocal); 
        
            if (!file_exists('./uploads/thumbs/' . $imgLocal)) {
               $img = $row['img'];  
            }

            $temp = [
                "id"        => $row['id'],
                "itype"     => $row['itype'],
                "themes"    => $row['themes'],
                "h1"        => $row['h1'],
                "checkbox"  => "",
                "img"       => $img,
                "sorting"   => $row['sorting'],
            ];
            array_push($items, $temp);
        }

        $data = [
            "section" => $section,
            "getVar" => $getVar,
            "items" => $items,
        ];


        return $this->response->setJSON($data);
    }

    public function widgetUpdateSorting()
    {
        $data = [
            "post" => $this->request->getVar(),
            "Token" => $this->request->getHeaderLine("Token")
        ];
        $i = 1;
        foreach ($this->request->getVar() as $row) {
            $this->db->table("widget")->update([
                "sorting" => $i++,
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $row . "' ");
        }
        return $this->response->setJSON($data);
    }

    public function widgetDetail($id = 0)
    {
        $getVar = $this->request->getVar();
        $widget   = $this->db->query("SELECT * FROM widget WHERE presence = 1 AND id = '$id' ");

        $data = [
            "items" =>   $widget->getResult() ? $widget->getResult()[0] : null,
        ];
        return $this->response->setJSON($data);
    }

    public function widgetUpdateDetail()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
        ];
        if ($post) {
            $data = [
                "error" => false,
                "post" => $post,
            ];
            $this->db->table("widget")->update([
                "h1" => $post['model']['h1'],
                "h2" => $post['model']['h2'],
                "h3" => $post['model']['h3'],
                "h4" => $post['model']['h4'],
                "h5" => $post['model']['h5'],
                "h6" => $post['model']['h6'],
                "img" => $post['model']['img'],
                "href" => $post['model']['href'],
                "update_date" => date("Y-m-d H:i:s")
            ], "id = '" . $post['id'] . "' ");
            return $this->response->setJSON($data);
        }
    }

    public function widgetInsert()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
            "post" => $post,
        ];
        if ($post) {
            $this->db->table("widget")->insert([
                "section" => $post['section'],
                "sorting" => 999,
                "h1" => "H1 " . date("ymdHis"),
                "update_date" => date("Y-m-d H:i:s"),
                "input_date" => date("Y-m-d H:i:s"),
            ]);
        }
        return $this->response->setJSON($data);
    }

    public function widgetDelete()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
            "post" => $post,
        ];
        if ($post) {
            foreach ($post['items'] as $row) {
                if ($row['checkbox'] == "true") {
                    $this->db->table("widget")->update([
                        "presence" => 0,
                        "update_date" => date("Y-m-d H:i:s"),
                    ], "id = '" . $row['id'] . "' ");
                }
            }
        }
        return $this->response->setJSON($data);
    }


    public function setting()
    {
        $data = [
            "value" => base64_encode( model("Core")->select("value", "setting", " id = 1 ") ),  
        ];
        return $this->response->setJSON($data); 
    }
    
    public function settingUpdate()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $data  = [
            "error" => true,
            "post" => $post,
        ];
        if ($post) { 
            $this->db->table("setting")->update([
                "value" => base64_decode( $post['value']),
                "update_date" => date("Y-m-d H:i:s"),
            ], "id = ". $post['id']);
             
        }
        return $this->response->setJSON($data);
    }
}
