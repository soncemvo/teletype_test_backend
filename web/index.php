<?php

// comment out the following two lines when deployed to production
const YII_DEBUG = true;
const YII_ENV = 'dev';

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';




$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
