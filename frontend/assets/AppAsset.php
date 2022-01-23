<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        "css/bootstrap.min.css",
        "css/style.css",
        "css/colors.css",
        "css/versions.css",
        "css/responsive.css",
        "css/custom.css"
    ];
    public $js = [
        "js/modernizer.js",
        "js/all.js",
        "js/custom.js",
        "https://maps.googleapis.com/maps/api/js?key=AIzaSyCNUPWkb4Cjd7Wxo-T4uoUldFjoiUA1fJc&callback=myMap",

        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}
