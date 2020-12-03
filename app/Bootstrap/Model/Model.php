<?php


namespace Bootstrap\Model;

use Behat\MinkExtension\Context\MinkContext;

/**
 * This is parent model abstract class
 */
abstract class Model implements ModelInterface
{
    /** @var MinkContext */
    protected $minkContext;

    /**
     * Model constructor.
     * @param MinkContext $minkContext
     */
    abstract function __construct(MinkContext $minkContext);
}