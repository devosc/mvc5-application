<?php
/**
 *
 */

namespace Dashboard\Add;

final class Save
{
    /**
     * @param ViewModel $model
     * @return ViewModel
     */
    function __invoke(ViewModel $model) : ViewModel
    {
        return $model->with(['args' =>  [__CLASS__, ...$model['args']]]);
    }
}
