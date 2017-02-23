# ![Image](assets/instagram.png) Instagram PHP Hashtag Feed v1

An easy-to-use PHP Class for generating a Hashtag Feed

[![Total Downloads](http://img.shields.io/packagist/dm/sebastianerb/instagramfeed.svg?style=flat)](https://packagist.org/packages/sebastianerb/instagramfeed)
[![Latest Stable Version](http://img.shields.io/packagist/v/sebastianerb/instagramfeed.svg?style=flat)](https://packagist.org/packages/sebastianerb/instagramfeed)
[![License](https://img.shields.io/packagist/l/sebastianerb/instagramfeed.svg?style=flat)](https://packagist.org/packages/sebastianerb/instagramfeed)


> [Composer](#installation) package available.  

## Requirements
- PHP 5.3 or higher

## Get started
To use the Instagram Feed Class, just follow this 2 steps:

### 1. Create CRON-Job

@see also: [File](cron/InstaCron.php) InstaCron.php

```php
require_once($_SERVER['DOCUMENT_ROOT'] . "/instagram/Instagram.php");
$insta = new AjaxInstagram();
$insta->jsonFile = $_SERVER['DOCUMENT_ROOT'] . "/cron/hashtaglist.json";
$insta->addHashtag(new Hashtag("sbstnerb", 10));
$insta->addHashtag(new Hashtag("sbstn", 10));
$insta->getData();
$insta->saveFile();
```

### 2. Show Feed

@see also: [File](InstaFeed.php) InstaFeed.php

```php
require_once($_SERVER['DOCUMENT_ROOT'] . "/instagram/Instagram.php");
$insta = new AjaxInstagram();
$insta->jsonFile = $_SERVER['DOCUMENT_ROOT'] . "/cron/hashtaglist.json";
$insta->showImages(5);
```
