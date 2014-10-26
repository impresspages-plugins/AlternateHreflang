<?php
/**
 * @package   ImpressPages
 */
namespace Plugin\AlternateHreflang;

/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.10.26
 * Time: 22.11
 */

class Event
{
    public static function ipPageUpdated($data)
    {
        if (ipRoute()->plugin() != 'Pages' || ipRoute()->action() != 'updatePage') {
            return; //we want to handle only page updates that are made from within Pages section.
        }

        if (!isset($data['alternatehreflang'])) {
            return;
        }

        $pageId = $data['id'];
        $key = $data['alternatehreflang'];

        if (empty($key)) {
            Model::removePageKey($pageId);
        } else {
            Model::setPageKey($pageId, $key);
        }
    }


    public static function ipBeforePageRemoved($data)
    {
        $pageId = $data['pageId'];
        Model::removePageKey($pageId);
    }
}
