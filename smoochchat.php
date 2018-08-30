<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

/**
 * Class SmoochChatPlugin
 * @package Grav\Plugin
 */
class SmoochChatPlugin extends Plugin
{
    /**
     * Indicate that we want to act on the onPluginsInitialized event
     *
     * @return array
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
