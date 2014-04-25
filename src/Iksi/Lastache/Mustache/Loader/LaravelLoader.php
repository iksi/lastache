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

use Mustache_Loader;
use Mustache_Loader_MutableLoader;

class Mustache_Loader_LaravelLoader implements Mustache_Loader, Mustache_Loader_MutableLoader
{
    private $_base_dir  = 'templates';
    private $_extension = 'mustache';
    private $_templates = array();

    public function __construct($base_dir = NULL, $options = array())
    {
        if ($base_dir !== NULL)
        {
            $this->_base_dir = $base_dir;
        }

        if (isset($options['extension']))
        {
            $this->_extension = ltrim($options['extension'], '.');
        }
    }

    public function load($name)
    {
        if ( ! isset($this->_templates[$name]))
        {
            $this->_templates[$name] = $this->_load_file($name);
        }

        return $this->_templates[$name];
    }

    protected function _load_file($name)
    {
        $filepath = $this->_base_dir.'/'.strtolower($name).'.'.$this->_extension;

        $fullpath = app_path().'/'.$filepath;

        if ( ! is_file($fullpath))
        {
            throw new \ErrorException('Mustache template "'.$filepath.'" not found');
        }

        return file_get_contents($fullpath);
    }

    /**
     * Set an associative array of Template sources for this loader.
     *
     * @param array $templates
     */
    public function setTemplates(array $templates)
    {
        $this->_templates = array_merge($this->_templates, $templates);
    }

    /**
     * Set a Template source by name.
     *
     * @param string $name
     * @param string $template Mustache Template source
     */
    public function setTemplate($name, $template)
    {
        $this->_templates[$name] = $template;
    }
}