<?php
namespace react;

use Craft;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;

use react\context\CraftContextProvider;
use react\twig\SerializerExtension;
use react\models\Settings;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSettings = true;

    public function init()
    {
        parent::init();
        
        if (Craft::$app->request->getIsSiteRequest()) {
            $env = $this->getSettings()->env;
            $serverBundle = CRAFT_BASE_PATH.DIRECTORY_SEPARATOR.$this->getSettings()->serverBundle;

            $contextProvider = new CraftContextProvider(Craft::$app->request);
            $renderer = new PhpExecJsReactRenderer($serverBundle, $env != 'client_side', $contextProvider);
            $ext = new ReactRenderExtension($renderer, $contextProvider, $env);
            $ext2 = new SerializerExtension();
            Craft::$app->view->registerTwigExtension($ext2);
            Craft::$app->view->registerTwigExtension($ext);

        }
    }

    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('react/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}