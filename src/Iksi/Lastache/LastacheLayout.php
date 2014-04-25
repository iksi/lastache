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
class LastacheLayout extends Lastache {

    /**
     * @var  string  layout path
     */
    protected $_layout = 'layout';

    /**
     * @var  string  partial name for content
     */
    protected $_content_partial = 'content';

    public static function factory($layout = NULL)
    {
        $lastache = parent::factory();

        $lastache->set_layout($layout);

        return $lastache;
    }

    public function set_layout($layout)
    {
        if ($layout !== NULL)
        {
            $this->_layout = (string) $layout;
        }
    }

    public function render($class, $template = NULL)
    {
        $content = $this->_engine->getLoader()->load($this->_detect_template_path($class));
  
        $this->_engine->setPartials(
            array($this->_content_partial => $content)
        );

        return $this->_engine->loadTemplate($this->_layout)->render($class);
    }

}