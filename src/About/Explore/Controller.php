<?php
/**
 *
 */

namespace About\Explore;

use Mvc5\Model\ViewModel;
use Mvc5\View\Model;

class Controller
{
    /**
     *
     */
    use Model;

    /**
     * @return ViewModel
     */
    function __invoke()
    {
        return $this->view('about/explore');
    }
}