<?php

namespace CSUS\Inc\Shortcode;

class Observer implements \CSUS\Inc\Interface\Observer
{
    private $shortcodeSchedule;

    public function __construct(Subject $shortcodeSchedule)
    {
        $this->shortcodeSchedule = $shortcodeSchedule;
        $shortcodeSchedule->attach($this);
    }

    public function update()
    {
        $shortcodes = $this->shortcodeSchedule->getShortcodes();
        // Schedule the shortcodes to be executed using cron jobs.
        foreach ($shortcodes as $shortcode => $interval) {
            $hook_name = 'shortcode_' . $shortcode;
            if (!wp_next_scheduled($hook_name)) {
                wp_schedule_event(time(), $interval, $hook_name);
            }
        }
    }
}

