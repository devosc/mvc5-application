<?php
/**
 *
 */

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Config;
use Mvc5\Container;
use Mvc5\Model;
use Mvc5\Model\ViewModel;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Config as ConfigLink;
use Mvc5\Plugin\Copy;
use Mvc5\Plugin\Dependency;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\FileInclude;
use Mvc5\Plugin\Hydrator;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Manager;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Service;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plug;
use Plugin\Controller;
use Plugin\Route;
use Service\Provider;

return [
    //'blog:create' => new Plugin('Blog\Create\Create'),
    //'blog:create' => new Plugin('blog2->create'),

    //'blog' => blog\controller::class,
    //'blog' => new Service(blog\controller::class, ['template' => new Param('templates.blog')]),
    'blog2' => new Container([
        'add' => ['event\model', 'event' => 'blog:add'],
        'home'   => 'blog3->home2',
    ]),
    'blog3' => new Config([
        'home2'  => new Plugin('Home\Controller')
    ]),
    'blog' => new Plugin(
        App::class,
        [
            'config' => new FileInclude(__DIR__ . '/blog.php')
        ],
        [
            //share existing container
            'container' => new Dependency('container'),
            ['configure', 'container', new Dependency('container')]
        ]
    ),

    /*'home\controller' => new Plugin(
        Home\Controller::class
        //,[new service(Home\Model::class, ['home'])],
        //['setModel' => new Plugin('home\model', ['home3'])]
    ),*/

    //'home\model' => new Plugin(Home\Model::class, ['home']),

    //'Home\Controller' => new Factory(Home\Factory::class),

    'Home\Controller' => new Controller(Home\Controller::class),
    //'Home\Controller' => new Copy(new Controller(Home\Controller::class)),
    //'home\controller' => new Plugin(Home\Controller::class),

    //'Home\Controller' => Home\Controller::class,
    //'Home\Controller' => new Plugin('blog->home'),

    'request' => new Request\HttpRequest($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER),

    'response' => Response\HttpResponse::class,
    //'http\response' => new Plugin(Response\HttpResponse::class),
    //'response'      => new Plug('http\response'),

    'Response\Response' => 'response',

    'route' => new Route(Mvc5\Route\Config::class),

    /**
     * PSR-7 "compatibility" can be achieved using the Mvc\Psr7Mvc event.
     *
     * Customize the Response for Middleware "compliance".
     *
     * The Middleware demo requires the *\Middleware controllers to be uncommented in the route config and the 'web'
     * event config must be changed to use 'middleware' instead of 'mvc'.
     */

    /*
    'request'  => new Call(
        '@Request\Psr7\HttpRequest::createFromEnvironment', [new Plugin('Slim\Http\Environment', [$_SERVER])]
    ),
    'response' => Response\Psr7\HttpResponse::class,
    'route'    => new \Plugin\Psr7Route(Mvc5\Route\Config::class),
    'mvc'      => new Plugin(\Mvc\Psr7Mvc::class, ['mvc', new Link], [new Dependency('route')]),
    */

    /*
    'middleware'            => [Middleware\App::class, new Link, new Param('events.middleware')],
    'middleware\controller' => new Service(Middleware\Controller::class),
    'middleware\layout'     => new Service(Middleware\Layout::class, [new Plugin('layout')]),
    'middleware\renderer'   => new Service(Middleware\Renderer::class),
    'middleware\router'     => [Middleware\Router::class, new Invoke('route\dispatch')],
    'response\send'         => Response\Psr7\Send::class,
    'error\controller'      => new Hydrator(Middleware\Error::class, ['setModel' => new Plugin('error\model')]),
    'Blog\Middleware' => new Plugin(Blog\Middleware::class, ['template' => __DIR__ . '/../view/blog/index.phtml']),
    */

    ViewModel::class => Model::class,

    'service\provider' => new Manager(Provider::class),

    //test false but not null container value

    /*'user\authenticated' => function() {
        var_dump(__FILE__);
        return false;
    },*/

    //'user\authenticated' => false,

    //'authenticated' => new Invokable(new Dependency('user\authenticated'))

] + include __DIR__ . '/../vendor/mvc5/mvc5/config/service.php';
