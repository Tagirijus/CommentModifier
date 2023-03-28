<?php

namespace Kanboard\Plugin\CommentModifier;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;


class Plugin extends Base
{
    public function initialize()
    {
        // Helper
        $this->helper->register('commentModifierHelper', '\Kanboard\Plugin\CommentModifier\Helper\CommentModifierHelper');

        // Template Override
        $this->template->setTemplateOverride('comment/show', 'CommentModifier:comment/show');

        // Views - Template Hook
        $this->template->hook->attach(
            'template:config:sidebar', 'CommentModifier:config/commentmodifier_config_sidebar');

        // Extra Page - Routes
        $this->route->addRoute('/commentmodifier/config', 'CommentModifierController', 'show', 'CommentModifier');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'CommentModifier';
    }

    public function getPluginDescription()
    {
        return t('Modify task comments by certain rules');
    }

    public function getPluginAuthor()
    {
        return 'Tagirijus';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        // Examples:
        // >=1.0.37
        // <1.0.37
        // <=1.0.37
        return '>=1.2.27';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/Tagirijus/CommentModifier';
    }
}
