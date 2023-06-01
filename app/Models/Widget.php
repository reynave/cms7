<?php

namespace App\Models;

class Widget extends Core
{
    //protected $DBGroup          = 'default';


    public function index()
    {

        $query   = $this->db->query("SELECT section,itype, COUNT(id) AS 'total' FROM widget 
        WHERE presence = 1 AND itype != 'galleries' AND pages_id = '' AND content_id = '' AND themes = '" . self::iniCms()['themes'] . "'
        GROUP BY section
        order by section ASC");
        $results = $query->getResultArray();
        $data = [];
        foreach ($results as $row) {
            array_push($data,  array_merge($row, [
                "array" => "model('widget')->select('" . $row['section'] . "')"
            ]));
        }

        return $data;
    }

    public function section($val = "")
    {
        if (self::select("count(id)", "widget", "section = '$val' and presence = 1 ") < 1) {
            $data = [
                'section' => $val,
                'itype' => 'widget',
                'h1' => 'headline 1',
                'h2' => 'headline 2',
                'h3' => 'headline 3',
                'h4' => 'headline 4',
                'h5' => 'headline 5',
                'h6' => 'headline 6',
                'themes' => self::iniCms()['themes']
            ];
            $this->db->table('widget')->insert($data);
        }

        $query   = $this->db->query("SELECT * FROM widget 
        WHERE presence = 1   AND section = '$val' 
        order by sorting ASC");
        $results = $query->getResultArray();
        $data = [];
        foreach ($results as $row) {
            array_push($data,  array_merge($row, [
                "data" =>  [
                    "h1" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h1'",
                    "h2" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h2'",
                    "h3" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h3'",
                    "h4" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h4'",
                    "h5" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h5'",
                    "h6" => " data-id='" .$row['id'] . "' data-table='widget' data-column='h6'",
                    "href" => " data-id='" .$row['id'] . "' data-table='widget' data-column='href'",
                    "content" => " data-id='" .$row['id'] . "' data-table='widget' data-column='content'", 
                ], 
                "action" => $this->login == true ? "
                    <span class='handle' data-id='" . $row['id'] . "' data-table='widget'><i class='bi bi-arrows-move'></i></span>
                    <button type='button' class='cms7btn  parentModal' data-id='" . $row['id'] . "' data-table='widget' >Detail</button>
                    <button type='button' class='cms7btn  delete' data-id='" . $row['id'] . "' data-table='widget'>Delete</button>
                " : "",
            ]));
        }

        return $data;
    }

    public function add($section = "")
    {
        if($section == ""){
            return "<span class='cms7Warning'>Require section name!!</span>";
        }else{ 
            return $this->login == true ? "<button type='button' class='cms7btn widget_insert' data-themes='".self::iniCms()['themes']."' 
            data-table='widget' data-section='$section' data-itype='widget'>Add $section</button>" :""; 
        }

    }
}
