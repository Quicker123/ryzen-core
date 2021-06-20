<?php

namespace app\core\form;

use app\core\Model;

/**
 * @author razoo.choudhary@gmail.com
 * Class BaseField
 * @package app\core\form
 */

abstract class BaseField
{
    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */

    public function __construct(\app\core\Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString()
    {
        return sprintf('%s %s<span>%s</span>',

            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}