<?php

namespace CSUS\Inc\Shortcode;

class Schedule implements Subject
{
    private $observers = array();
    private $shortcodes = array();

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer)
    {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public function addShortcode($shortcode, $interval)
    {
        $this->shortcodes[$shortcode] = $interval;
        $this->notify();
    }

    public function removeShortcode($shortcode)
    {
        if (isset($this->shortcodes[$shortcode])) {
            unset($this->shortcodes[$shortcode]);
            $this->notify();
        }
    }

    public function getShortcodes()
    {
        return $this->shortcodes;
    }
}
