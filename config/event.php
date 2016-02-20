<?php
/**
 *
 */

return [
    'blog:add' => (object) [
        Blog\Add\Validate::class,
        Blog\Add\Save::class,
        Blog\Add\Respond::class
    ],
    'blog:remove' => [
        function() {
            return $model = '<h1>Validate</h1>';
        },
        function($model) {
            return $model . '<h1>Remove</h1>';
        },
        function($layout, $model = null) {
            $model .= '<h1>Respond</h1>';

            $layout->model($model);

            return $layout;
        }
    ],

    'service\resolver' => [
        function() {
            return null;
        },
        'service\provider',
        'resolver\exception'
    ],

] + include __DIR__ . '/../vendor/mvc5/mvc5/config/event.php';
