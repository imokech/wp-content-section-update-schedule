<?php

namespace CSUS\Inc\Shortcode;

class Shortcode
{
    private string $shortcodeName;

    private function __construct(string $shortcodeName)
    {
        $this->shortcodeName = $shortcodeName;
        add_shortcode($shortcodeName, array(&$this, 'render'));
    }

    public function getInstance()
    {

    }

    public function render($atts, $content = null)
    {
        $atts = shortcode_atts(array(
            'day' => true,
        ), $atts, $this->shortcode_name);

    }
}
