<?php


namespace Plugin\AlternateHreflang\Setup;

class Worker
{

    public function activate()
    {
        $table = ipTable(\Plugin\AlternateHreflang\Model::TABLE_NAME);
        $sql = "
        CREATE TABLE IF NOT EXISTS
           $table
        (
        `pageId` int(11),
        `key` varchar(255),
         PRIMARY KEY(`pageId`),
         INDEX `key` (`key`)
        )";

        ipDb()->execute($sql);

    }

    public function deactivate()
    {

    }

    public function remove()
    {

    }

}
