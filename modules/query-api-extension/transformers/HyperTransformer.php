<?php

namespace modules\queryapiextension\transformers;

use verbb\hyper\models\LinkCollection;

class HyperTransformer
{
    private LinkCollection $hyper;

    public function __construct(LinkCollection $hyper)
    {
        $this->hyper = $hyper;
    }

    /**
     * @return array
     */
    public function getTransformedData(): array
    {
        return [
            'metadata' => $this->getMetaData(),
            'linkText' => $this->hyper->text,
            'linkUrl' => $this->hyper->url,
            'linkTarget' => $this->hyper->target,
        ];
    }

    /**
     * Retrieves metadata from the Hyper field.
     *
     * @return array
     */
    protected function getMetaData(): array
    {
        return [
            'type' => $this->hyper->type,
        ];
    }
}
