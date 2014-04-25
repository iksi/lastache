<?php namespace Iksi\Lastache;
/**
 * Lastache: Mustache templates for Laravel.
 *
 * Original KOstache (c) 2010-2012 by Jeremy Bush <jeremy.bush@kohanaframework.org>
 *
 * Port to Laravel by Iksi <info@iksi.cc>
 *
 * @license MIT
 */

use Mustache_Engine;

class Lastache {

    protected $_engine;

    public static function factory()
    {
        $mustache = new Mustache_Engine(
            array(
                'loader' => new Mustache_Loader_LaravelLoader('templates'),
                'partials_loader' => new Mustache_Loader_LaravelLoader('templates/partials'),
                'escape' => function($value) {
                    return htmlspecialchars( (string) $value, ENT_QUOTES, 'utf-8', TRUE);
                },
                'cache' => storage_path().'/cache/mustache',
            )
        );

        $class = get_called_class();

        return new $class($mustache);
    }

    public function __construct($engine)
    {
        $this->_engine = $engine;
    }

    public function render($class, $template = NULL)
    {
        if ($template === NULL)
        {
            $template = $this->_detect_template_path($class);
        }

        return $this->_engine->loadTemplate($template)->render($class);
    }

    protected function _detect_template_path($class)
    {
        $class = preg_replace('/View$/i', '', get_class($class));

        return str_replace('_', '/', $class);
    }
}