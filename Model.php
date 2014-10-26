<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\AlternateHreflang;

/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.10.26
 * Time: 21.24
 */

class Model
{
    const TABLE_NAME = 'alternate_hreflang';

    public static function setPageKey($pageId, $key)
    {
        return ipDb()->upsert(self::TABLE_NAME, array('pageId' => $pageId), array('key' => $key));
    }

    public static function getPageKey($pageId)
    {
        return ipDb()->selectValue(self::TABLE_NAME, array('key'), array('pageId' => $pageId));
    }

    public static function getPageIdsByKey($key)
    {
        return ipDb()->selectColumn(self::TABLE_NAME, 'pageId', array('key' => $key));
    }

}
