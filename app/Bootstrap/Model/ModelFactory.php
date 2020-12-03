<?php


namespace Bootstrap\Model;

use Behat\MinkExtension\Context\RawMinkContext;

class ModelFactory
{
    /**
     * This is a factory function which will return Model
     * @param RawMinkContext $rawMinkContext
     * @param string $modelName
     * @return Model
     * @throws \Exception
     */
    public static function createModel(RawMinkContext $rawMinkContext, string $modelName): Model
    {
        switch (strtolower($modelName)) {
            case "tenant":
                return new Tenant($rawMinkContext);
                break;
            default:
                throw new \Exception(sprintf('Unknown model:%s', $modelName));
        }
    }
}