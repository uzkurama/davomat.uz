<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome/web-fonts-with-css';
    public $css = [
        'css/fontawesome-all.css',
    ];
}
