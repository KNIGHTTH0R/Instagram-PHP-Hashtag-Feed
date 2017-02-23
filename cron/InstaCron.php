<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Erb
 * Date: 22.02.17
 * Time: 19:09
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/instagram/Instagram.php");

$insta = new AjaxInstagram();
$insta->jsonFile = $_SERVER['DOCUMENT_ROOT'] . "/cron/hashtaglist.json";
$insta->addHashtag(new Hashtag("sbstnerb", 10));
$insta->addHashtag(new Hashtag("sbstn", 10));
$insta->getData();
$insta->saveFile();