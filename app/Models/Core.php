<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\CodeIgniter;

class Core extends Model
{
    protected   $id    =  null;
    protected   $content_id    =  null;
    protected   $db    =  null;
    protected   $request    =  null;
    protected   $path = null;
    protected   $login = false;
    protected   $themes = "index";

    function __construct()
    {
        $this->request = \Config\Services::request();
        $this->db = \Config\Database::connect();
        $this->path = explode('/', $this->request->getPath());

        if (!isset($this->path[1])) {
            $this->path[1] = "";
        }

        $this->id =  $this->path[0] ? self::select("id", "pages", "url = '" .  $this->path[0] . "' and presence = 1 and status = 1") :
            self::select("id", "pages", " idefault = 1 and presence = 1 and status = 1");

        $this->content_id =  $this->path[1] ? self::select("id", "content", "url = '" . $this->path[1] . "' and pages_id = '" . $this->id . "' and presence = 1 and status != 0") :
            self::select("id", "content", "pages_id = '" . $this->id . "' and presence = 1 and status != 0 order by sorting ASC");
    }

    function set_login($val = false)
    {
        $this->login = $val;
        return  $this->login;
    }

    function iniCms()
    {
        $this->themes = self::table()  == '404' ? '404' : self::select("themes", "pages", "id='" . $this->id . "'");
        $data = array(
            "login" => $this->login,
            "CI_VERSION" => CodeIgniter::CI_VERSION,
            "CMS_VERSION" => $_ENV['CMS7_VERSION'],
            'enviroment' => $_ENV['CI_ENVIRONMENT'],
            "themes" => $this->themes,
        );
        return $data;
    }


    function cms()
    {

        $default = array(
            "id" => null,
            "pages_id" =>  null,
            "name" =>  null,
            "h1" =>  null,
            "h2" => null,
            "h3" =>  null,
            "h4" => null,
            "h5" =>  null,
            "h6" => null,
            "status" =>  null,
            "sorting" =>  null,
            "publish_date" =>  null,
            "url" =>  null,
            "content" =>  null,
            "data" => [
                "name" =>  null,
                "h1" =>  null,
                "h2" =>  null,
                "h3" =>  null,
                "h4" =>  null,
                "h5" =>  null,
                "h6" =>  null,
                "publish_date" => null,
                "metadata_description" => null,
                "metadata_keywords" => null,
                "content" => null,
            ],
            "list" => [],
            "galleries" => [],
            "widget" => [],
        );

        $select_content = "id, pages_id, name, h1, h2, h3, h4,h5, h6, status, sorting, publish_date, url ";
        $content = !$this->content_id ? [] : $this->db->query("SELECT   $select_content, content  FROM content WHERE status != 0 and presence = 1 and id = " . $this->content_id)->getResultArray()[0];

        $contentData = array(
            "name" => $this->login == true ? "!! please use Modal Detail !!" : "",
            "h1" =>  $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h1'  " : "",
            "h2" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h2'  " : "",
            "h3" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h3'  " : "",
            "h4" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h4'  " : "",
            "h5" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h5'  " : "",
            "h6" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='h6'  " : "",
            "publish_date" => $this->login == true ?  " data-id='" . $this->content_id . "' data-table='content' data-column='publish_date'  " : "",
            "metadata_description" => $this->login == true ?  " data-id='" . $this->content_id . "' data-table='content' data-column='metadata_description'  " : "",
            "metadata_keywords" => $this->login == true ?  " data-id='" . $this->content_id . "' data-table='content' data-column='metadata_keywords'  " : "",
            "content" => $this->login == true ? " data-id='" . $this->content_id . "' data-table='content' data-column='content'  " : "",
        );

        if ($this->content_id) {


            $galleries = [];
            $query   = $this->db->query("SELECT * FROM widget WHERE itype = 'galleries' and  status != 0 and presence = 1 and section = '" . $this->content_id . "' order by sorting ASC");
            $results = $query->getResultArray();
            $i = 1;
            foreach ($results as $row) {
                $temp = [
                    "id" => $row['id'],
                    "section" => $row['section'],
                    "h1" =>  $row['h1'],
                    "h2" =>  $row['h2'],
                    "h3" =>  $row['h3'],
                    "h4" =>  $row['h4'],
                    "h5" =>  $row['h5'],
                    "h6" =>  $row['h6'],
                    "thumb" => "",
                    "img" =>  $row['img'],
                    "content" =>  $row['content'],
                    "i" => $i++,
                    "data" => [
                        "h1" => " data-id='" . $this->content_id . "' data-table='content' data-column='h1'  ",
                        "h2" => " data-id='" . $this->content_id . "' data-table='content' data-column='h2'  ",
                        "h3" => " data-id='" . $this->content_id . "' data-table='content' data-column='h3'  ",
                        "h4" => " data-id='" . $this->content_id . "' data-table='content' data-column='h4'  ",
                        "h5" => " data-id='" . $this->content_id . "' data-table='content' data-column='h5'  ",
                        "h6" => " data-id='" . $this->content_id . "' data-table='content' data-column='h6'  ",
                    ],
                    "action" =>  $this->login == true ? "
                        <span class='handle' data-id='" . $row['id'] . "' data-table='widget'><i class='bi bi-arrows-move'></i></span>
                        <button type='button' class='cms7btn  parentModal' data-id='" . $row['id'] . "' data-table='widget'>Detail</button>
                        <button type='button' class='cms7btn  delete' data-id='" . $row['id'] . "' data-table='widget'>Delete</button>
                    " : "" 
                ];
                array_push($galleries, $temp);
            }


            $list_query = $this->db->query("SELECT $select_content  FROM content WHERE status != 0 and presence = 1 and id != '" . $this->content_id . "' and  pages_id = " . $this->id . " order by sorting ASC LIMIT 50");
            $results =  $list_query->getResultArray();
            $list = [];
            foreach ($results as $row) {
                array_push($list,  array_merge($row, [
                    "url" => base_url() . self::select("url", "pages", "id=" . $row['pages_id']) . '/' . $row['url'],
                    "action" =>  $this->login == true ? "
                        <span class='handle' data-id='" . $row['id'] . "' data-table='content'><i class='bi bi-arrows-move'></i></span>
                        <button type='button' class='cms7btn  parentModal' data-id='" . $row['id'] . "' data-table='content'>Detail</button>
                        <button type='button' class='cms7btn  delete' data-id='" . $row['id'] . "' data-table='content'>Delete</button>
                    " : "",
                ]));
            }

            $widget_query = $this->db->query("SELECT * FROM widget WHERE itype = 'widget' and  status != 0 and presence = 1 and section = '" . $this->content_id . "' order by sorting ASC ")->getResultArray();
            $widget = [];
            foreach ($widget_query as $row) {
                array_push($widget,  array_merge($row, [
                    "data" => $this->login == true ? array(
                        "h1" =>  " data-id='" . $this->content_id . "' data-table='widget' data-column='h1'  ",
                        "h2" => " data-id='" . $this->content_id . "' data-table='widget' data-column='h2'  ",
                        "h3" => " data-id='" . $this->content_id . "' data-table='widget' data-column='h3'  ",
                        "h4" => " data-id='" . $this->content_id . "' data-table='widget' data-column='h4'  ",
                        "h5" => " data-id='" . $this->content_id . "' data-table='widget' data-column='h5'  ",
                        "h6" => " data-id='" . $this->content_id . "' data-table='widget' data-column='h6'  ",
                        "href" => " data-id='" . $this->content_id . "' data-table='widget' data-column='href'  ",
                        "content" => " data-id='" . $this->content_id . "' data-table='widget' data-column='content'  ",
                    ) : [],
                    "action" => $this->login == true ? "
                        <span class='handle' data-id='" . $row['id'] . "' data-table='widget'><i class='bi bi-arrows-move'></i></span>
                        <button type='button' class='cms7btn parentModal' data-id='" . $row['id'] . "' data-table='widget'>Detail</button>
                        <button type='button' class='cms7btn  delete' data-id='" . $row['id'] . "' data-table='widget'>Delete</button>
                    " : "",
                ]));
            }
        }
        $query =  $this->db->query("SELECT id, parent_id, name FROM pages WHERE presence = 1");
        $pages = $query->getResultArray();

        $data = array(
            "login" => $this->login,
            "path"      => $this->path,
            "id"        =>  $this->id,
            "content_id" =>  $this->content_id,
            "table"     => self::table(),
            "pages"     => self::buildTree($pages),
            "content" => $this->content_id ? array_merge($content, [
                "data" => $contentData,
                "list" => $list,
                "widget"    => $widget,
                "addWidget"    => $this->login == true ? "<button type='button' class='cms7btn widget_insert' data-table='widget' data-themes='' data-itype='widget' data-section='" . $this->content_id . "'
                data-img='https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images'>add Widget</button>" : "",

                "galleries" => $galleries,
                "addGalleries" =>  $this->login == true ? "<button type='button' class='cms7btn insert' data-table='widget' data-itype='galleries' data-section='" . $this->content_id . "'
                    data-img='https://dummyimage.com/600x400/30a2ff/ffffff.jpg&text=dummy+images'>add galleries</button>" : "",

            ]) : $default,
            "insertContent" => $this->login == true ? '<button type="button" class="cms7btn insert" data-table="content" data-pages_id="' . $this->id . '">Add Content</button>' : "",
            "metadata" => self::metadata(),
        );
        return $data;
    }

    function metadata()
    {
        // DEFAULT
        $description    = "";
        $keywords       = "";
        $title          = self::select("title", "pages", "id='" . $this->id . "'");
        $image          = "";

        if (self::table() == "pages") {
            // PAGES  
            if ($this->content_id) {
                $description    = "";
                $keywords       = "";
                $title          = self::select("name", "content", "id='" . $this->content_id . "'");
                $image          = "";
            }
        } else if (self::table() == "content") {
            // CONTENT 
            $description    = "";
            $keywords       = "";
            $title          = self::select("name", "content", "id='" . $this->content_id . "'");
            $image          = "";
        }

        $locale  = "id_ID";
        $data = '
        <title>' . $title . '</title> 
        <link rel="canonical" href="' . base_url() . '">

        <meta name="description" content="' . $description . '">
        <meta name="keywords" content="' . $keywords . '">
        <meta name="elapsed_time" content="{elapsed_time}"> 
        <meta name="themes" content="' . self::select("themes", "pages", "id='" . $this->id . "'") . '"> 

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="' . $title . '">
        <meta name="twitter:description" content="' . $description . '">
        <meta name="twitter:image"  content="' . $image . '">

        <meta property="og:type" content="Article" />
        <meta property="og:url" content="' . base_url() . '" />
        <meta property="og:title" content="' . $title . '" />
        <meta property="og:description" content="' . $description . '">
        <meta property="og:site_name" content="' . self::domain() . '" />
        <meta property="og:image" content="' . $image . '" /> 
        <meta property="og:image:width"  content="600" /> 
        <meta property="og:image:height" content="315" />
        <meta property="og:locale" content="' . $locale . '" /> 
        ';
        return $data;
    }

    function select($field = "", $table = "", $where = " 1 ")
    {
        $data = null;
        if ($field != "") {
            $query = $this->db->query("SELECT $field  FROM $table WHERE $where LIMIT 1");
            if ($query->getRowArray()) {
                $row   = $query->getRowArray();
                $data  = $row[$field];
            }
        } else {
            $data  =  null;
        }
        return   $data;
    }
    function table()
    {
        if ($this->id  && !$this->path[1]) {
            $data =  "pages";
        } else if ($this->id && $this->content_id) {
            $data = "content";
        } else {
            $data = "404";
        }

        return $data;
    }

    function domain()
    {
        $array = array("http://", "https://");
        $base  = str_replace($array, '', base_url());
        $base_r = explode('/', $base);
        return $base_r[0];
    }

    function buildTree($arr, $parentId = 0)
    {
        $tree = [];

        foreach ($arr as $item) {
            if ($item['parent_id'] == $parentId) {
                $item['children'] = self::buildTree($arr, $item['id']);
                $tree[] = $item;
            }
        }

        return $tree;
    }
}
