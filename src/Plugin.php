<?php
namespace react;

use Craft;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

use Limenius\ReactRenderer\Renderer\PhpExecJsReactRenderer;
use Limenius\ReactRenderer\Twig\ReactRenderExtension;

use react\context\CraftContextProvider;

class Plugin extends \craft\base\Plugin
{
    public function init()
    {
        parent::init();
        // if(Craft::$app->getRequest()->getIsSiteRequest()){ // TESTS FOR PERMISSIONS
        //     $request = Craft::$app->getRequest();
        //     die(var_dump($request->resolve()[1]['variables']));
        // }
        if (Craft::$app->request->getIsSiteRequest()) {
            
            $env = getenv('REACT_RENDER');
            $serverBundle = CRAFT_BASE_PATH.DIRECTORY_SEPARATOR.getenv('REACT_SERVER_BUNDLE');

            $contextProvider = new CraftContextProvider(Craft::$app->request);
            $renderer = new PhpExecJsReactRenderer($serverBundle, $env != 'client_side', $contextProvider);
            $ext = new ReactRenderExtension($renderer, $contextProvider, $env);
            Craft::$app->view->registerTwigExtension($ext);

        }
    }
}