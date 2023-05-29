<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Install extends BaseController
{
    public function index()
    {
        $pages = "CREATE TABLE `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `id_pages` INT(6) NOT NULL DEFAULT '0',
            `ilock` INT(1) NOT NULL DEFAULT '0',
            `status` INT(1) NOT NULL DEFAULT '1',
            `post` INT(6) NOT NULL DEFAULT '0',
            `name` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `url` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `themes` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `title` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `metadata_description` TEXT(32767) NOT NULL COLLATE 'utf16_unicode_ci',
            `metadata_keywords` TEXT(32767) NOT NULL COLLATE 'utf16_unicode_ci',
            `pages_note1` TEXT(32767) NOT NULL COLLATE 'utf16_unicode_ci',
            `pages_note2` TEXT(32767) NOT NULL COLLATE 'utf16_unicode_ci',
            `pages_note3` TEXT(32767) NOT NULL COLLATE 'utf16_unicode_ci',
            `sorting` INT(3) NOT NULL DEFAULT '999',
            `idefault` INT(1) NOT NULL DEFAULT '0',
            `href` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `href_target_blank` INT(1) NOT NULL DEFAULT '0',
            `presence` INT(1) NOT NULL DEFAULT '1',
            `img` VARCHAR(250) NOT NULL DEFAULT '' COLLATE 'utf16_unicode_ci',
            `input_date` DATETIME NOT NULL DEFAULT '2017-01-01 00:00:00',
            `update_date` DATETIME NOT NULL DEFAULT '2017-01-01 00:00:00',
            PRIMARY KEY (`id`) USING BTREE
        )
        COLLATE='utf16_unicode_ci'
        ENGINE=InnoDB
        AUTO_INCREMENT=1
        ; 
        ";

        $this->db->query($pages); 
        $this->db->table('pages')->insert([
            'id'    => '1',
            'name'  => 'Home',
            'url'   => 'home',
            "idefault" => '1',
            'themes' => 'index',
            'ilock'     => '1',
            'status' => '1',
            'presence' => '1',
            'input_date' => date("Y-m-d H:i:s"),
            'update_date' => date("Y-m-d H:i:s"), 
        ]);
        echo  $this->db->affectedRows();
    }

    function haha(){
        echo "test";
    }
}
