<?php
/**
 *
 */

namespace Dashboard\Add;

class Save
{
    /**
     * @param Model $model
     * @return mixed|void
     */
    function __invoke(Model $model)
    {
        $model->vars(['args' =>  array_merge([__CLASS__], $model['args'])]);

        return $model;
    }
}
