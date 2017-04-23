<?php
/**
 *
 */

namespace About\Explore;

use Mvc5\Http\Request;
use Mvc5\Http\Response;
use Mvc5\Plugins\Render;
use Mvc5\Plugins\Service;
use Mvc5\Plugins\ViewModel;

class Controller
{
    /**
     *
     */
    use Render;
    use Service;
    use ViewModel;

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    function __invoke(Request $request, Response $response, callable $next)
    {
        $layout = $this->layout();

        $layout->model($this->view('about/explore'));

        return $next($request, $response->with('body', $this->render($layout)));
    }
}
