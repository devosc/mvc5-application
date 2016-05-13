<?php
/**
 *
 */

namespace Session\Config;

use Mvc5\Config\ArrayAccess;
use Mvc5\Config\PropertyAccess;
use Mvc5\Cookie\Cookies;

trait Session
{
    /**
     *
     */
    use ArrayAccess;
    use PropertyAccess;

    /**
     * @var Cookies
     */
    protected $cookies;

    /**
     * @param Cookies $cookies
     */
    function __construct(Cookies $cookies)
    {
        $this->cookies = $cookies;
    }

    /**
     * @return int
     */
    function count()
    {
        return count($_SESSION);
    }

    /**
     * @return mixed
     */
    function current()
    {
        return current($_SESSION);
    }

    /**
     * @param bool|true $cookie
     */
    function destroy($cookie = true)
    {
        session_destroy();

        if ($cookie) {
            $params = session_get_cookie_params();
            $this->cookies->remove(session_name(), $params['path'], $params['domain'], $params['secure']);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    function &get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    function has($name)
    {
        return isset($_SESSION[$name]);
    }

    /**
     * @return mixed
     */
    function key()
    {
        return key($_SESSION);
    }

    /**
     *
     */
    function next()
    {
        next($_SESSION);
    }

    /**
     * @param mixed $name
     * @return mixed
     */
    function &offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     * @return void
     */
    function remove($name)
    {
        unset($_SESSION[$name]);
    }

    /**
     *
     */
    function rewind()
    {
        reset($_SESSION);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    /**
     * @return bool
     */
    function valid()
    {
        return null !== $this->key();
    }

    /**
     * @param string $name
     * @param mixed $config
     * @return self|mixed
     */
    function with($name, $config)
    {
        $this->set($name, $config);
        return $this;
    }

    /**
     * @param string $name
     * @return self|mixed
     */
    function without($name)
    {
        $this->remove($name);
        return $this;
    }

    /**
     * @param mixed $name
     * @return mixed
     */
    function &__get($name)
    {
        return $this->get($name);
    }
}
