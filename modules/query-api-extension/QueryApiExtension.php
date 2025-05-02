<?php

namespace modules\queryapiextension;

use Craft;
use modules\queryapiextension\services\HyperTypeService;
use modules\queryapiextension\transformers\HyperTransformer;
use modules\queryapiextension\transformers\NavigationTransformer;
use samuelreichoer\queryapi\events\RegisterElementTypesEvent;
use samuelreichoer\queryapi\events\RegisterTypeDefinitionEvent;
use samuelreichoer\queryapi\models\RegisterElementType;
use samuelreichoer\queryapi\models\RegisterTypeDefinition;
use samuelreichoer\queryapi\services\ElementQueryService;
use samuelreichoer\queryapi\services\TypescriptService;
use samuelreichoer\queryapi\transformers\BaseTransformer;
use samuelreichoer\queryapi\events\RegisterFieldTransformersEvent;
use yii\base\Event;
use yii\base\Module as BaseModule;

/**
 * QueryApiExtension module
 *
 * @method static QueryApiExtension getInstance()
 */
class QueryApiExtension extends BaseModule
{
    public function init(): void
    {
        Craft::setAlias('@modules/queryapiextension', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\queryapiextension\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\queryapiextension\\controllers';
        }

        parent::init();

        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
        });
    }

    private function attachEventHandlers(): void
    {
        Event::on(
            BaseTransformer::class,
            BaseTransformer::EVENT_REGISTER_FIELD_TRANSFORMERS,
            function (RegisterFieldTransformersEvent $event) {
                $event->transformers[] = [
                    'fieldClass' => 'verbb\hyper\fields\HyperField',
                    'transformer' => HyperTransformer::class,
                ];
            }
        );

        Event::on(
            TypescriptService::class,
            TypescriptService::EVENT_REGISTER_TYPE_DEFINITIONS,
            function (RegisterTypeDefinitionEvent $event) {
                $event->typeDefinitions[] = new RegisterTypeDefinition([
                    'fieldTypeClass' => 'verbb\hyper\fields\HyperField',
                    'staticHardType' => 'export type hello = string',
                    'dynamicHardType' => HyperTypeService::class,
                    'staticTypeDefinition' => 'hello[]',
                    'dynamicDefinitionClass' => HyperTypeService::class,
                ]);
            }
        );

        Event::on(
            ElementQueryService::class,
            ElementQueryService::EVENT_REGISTER_ELEMENT_TYPES,
            function (RegisterElementTypesEvent $event) {
                $event->elementTypes[] = new RegisterElementType([
                    'elementTypeClass' => 'verbb\navigation\elements\Node',
                    'elementTypeHandle' => 'navigation',
                    'allowedMethods' => ['limit', 'handle', 'id'],
                    'transformer' => NavigationTransformer::class,
                ]);
            }
        );
    }
}
