<?php

namespace modules\queryapiextension\services;

use samuelreichoer\queryapi\services\TypescriptService;
use verbb\hyper\fields\HyperField;

class HyperTypeService extends TypescriptService
{
    public function setTypeByField(HyperField $field): string
    {
        return 'DynamicHardType';
    }

    public function setCustomHardTypes(): string
    {
        return 'export type DynamicHardType = object[]';
    }
}
