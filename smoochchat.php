<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class SmoochchatPlugin
 * @package Grav\Plugin
 */
class SmoochchatPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onAssetsInitialized' => ['onAssetsInitialized', 0]
        ]);
    }

    /**
     * Add Smooch JavaScript code during asset processing stage
     */
    public function onAssetsInitialized()
    {
        $this->grav['assets']->addInlineJs(
            "var smooch_chat_app_id = '" . $this->config->get('plugins.smoochchat.app_id') . "';"
        );

        $this->grav['assets']->addJs("plugin://smoochchat/js/smooch.js");
    }
}
