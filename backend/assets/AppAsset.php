<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/bootstrap.min.css',
        'css/demo.css',
        'css/material-dashboard.css',
        'css/nprogress.css',
        'sass/material-dashboard.scss',
    ];
    public $js = [
        // 'js/jquery-3.2.1.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/chartist.min.js',
        'js/arrive.min.js',
        'js/perfect-scrollbar.jquery.min.js',
        'js/bootstrap-notify.js',
        'js/material-dashboard.js',
        'js/demo.js',
        'js/nprogress.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
