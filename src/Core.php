<?php
namespace FastFramework;

/**
 * Class Core
 * @category Framework
 * @package  FastFramework
 * @author   Francesco Cappa <francesco.cappa.91@gmail.com>
 * @link     http://github.com/joshcam/PHP-MySQLi-Database-Class
 * 
 * @version  0.0.1
 */

class Core
{
    static function includeFile($file) {
        include_once __DIR__ ."/".$file;
    }

    static function requireFile($file) {
        require_once __DIR__ . "/".$file;
    }
}