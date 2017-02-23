<?php

/**
 * Created by PhpStorm.
 * User: Sebastian Erb
 * Date: 21.02.17
 * Time: 19:08
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/instagram/Instagram.php");

$insta = new AjaxInstagram();
$insta->jsonFile = $_SERVER['DOCUMENT_ROOT'] . "/cron/hashtaglist.json";
$insta->showImages(5);



