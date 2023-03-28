<?php

namespace Kanboard\Plugin\CommentModifier;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;


class Plugin extends Base
{
    public function initialize()
    {
        // to be able to load media from another domain, I have to
        // modify the Content-Security-Policy first
        $this->container['cspRules'] = array_merge($this->container['cspRules'], [
            'media-src' => $this->configModel->get('commentmodifier_csp_media_src', '')
        ]);

        // CSS - Asset Hook
        $this->hook->on('template:layout:css', array('template' => 'plugins/CommentModifier/Assets/css/comment-modifier.min.css'));

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
        return '1.1.0';
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
