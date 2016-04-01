<?php

namespace app\modules\backend;

/**
 * admin module definition class
 */
class Module extends \yii\fluent\modules\admin\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\backend\controllers';

    public $layout = '@fluent/modules/admin/views/layouts/admin';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return parent::t($category, $message, $params, $language);
    }
}
