<?php
/**
 *
 */

use Mvc5\Response\Redirect;
use Mvc5\Route\Config as Route;
use Mvc5\Service\Service;
use Mvc5\Url\Plugin as Url;

function dashboard_remove(Service $sm, Request $request, Url $url, callable $next = null)
{
    $sm->plugin('session\messages')->success('Action completed!');
    return !$next ? new Redirect($url('dashboard')) : $next($request, new Redirect($url('dashboard')));
}

return [
    'home' => new Route([
        'route' => '/{$}',
        'controller' => 'Home\Controller',
        //var_export to create a cache (Definition/Build.php)
        'regex' => '/$',
        'tokens' => [['literal','/'], ['param','','$']]
    ]),
    'dashboard' => [
        'route'      => '/dashboard',
        'controller' => 'dashboard->controller.test', //specific method
        //'scheme' => 'https',
        //'hostname' => 'localhost', // "//localhost/dashboard" (when no scheme specified, inc parent)
        //'port' => '8080', // "http://localhost:8080/dashboard"
        'children' => [
            'remove' => [
                'route' => '/remove',
                'method' => ['GET', 'POST'],
                'action' => [
                    'GET' => 'dashboard:remove',
                    'POST' => '@dashboard_remove'
                ]
            ],
            'add' => [
                'route'      => '[/{author::s}][/{category::s}[/{wildcard::*$}]]',
                'defaults'   => [
                    //'author'   => 'owner',
                    //'category' => 'web',
                    'limit' => 10
                ],
                'wildcard'   => true,
                'controller' => 'dashboard->action->add', //call event
                'constraints' => [
                    //'author'   => '[a-zA-Z_-]+',
                    //'category' => '[a-zA-Z_-]+',
                    //'wildcard' => '[a-zA-Z0-9/]+[a-zA-Z0-9]$'
                ]
            ]
        ],
    ],
    'app' => [
        'options'     => ['separators' => ['_' => '_', '-' => '\\']],
        //'regex' => '/(?P<controller>[a-zA-Z][a-zA-Z0-9]+)(?:/(?P<action>[a-zA-Z0-9_-]+)(?:/(?P<wildcard>[a-zA-Z0-9/]+[a-zA-Z0-9]$))?)?',

        'route'       => '/{controller::n}[/{action::s}[/{wildcard::*$}]]',

        //'route'       => '/{controller}[/{action}[/{wildcard:*}]]',
        //'constraints' => ['controller' => '[a-zA-Z][a-zA-Z0-9]+', 'action' => '[a-zA-Z0-9_-]+', 'wildcard' => '[a-zA-Z0-9/]+[a-zA-Z0-9]$'],

        'wildcard'    => true
    ],
];