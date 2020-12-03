<?php


namespace Bootstrap\Model;

/**
 * Interface ModelInterface
 */
interface ModelInterface
{
    /**
     * This function return Model name
     * @return string
     */
    public function getName(): string;

    /**
     * This function will add a model
     * @param array $data
     */
    public function add(array $data);
}