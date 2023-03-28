<?php

namespace Kanboard\Plugin\CommentModifier\Controller;




class CommentModifierController extends \Kanboard\Controller\PluginController
{
    /**
     * Settins page for the CommentModifier plugin.
     *
     * @return HTML response
     */
    public function show()
    {
        $this->response->html($this->helper->layout->config('CommentModifier:config/commentmodifier_config', [
            'title' => t('CommentModifier') . ' &gt; ' . t('Settings'),
            'audio_url_regex'      => $this->configModel->get(
                'commentmodifier_audio_url_regex',
                '/(domain\.org.*\.(mp3|ogg)+)/'
            ),
            'audio_filename_regex' => $this->configModel->get(
                'commentmodifier_audio_filename_regex',
                '/[^\/]+$/'
            ),
            'video_url_regex'      => $this->configModel->get(
                'commentmodifier_video_url_regex',
                '/(domain\.org.*\.(mp4)+)/'
            ),
            'video_filename_regex' => $this->configModel->get(
                'commentmodifier_video_filename_regex',
                '/[^\/]+$/'
            )
        ]));
    }

    /**
     * Save the setting for CommentModifier.
     */
    public function saveConfig()
    {
        $form = $this->request->getValues();

        $values = [
            'commentmodifier_audio_url_regex'      => $form['audio_url_regex'],
            'commentmodifier_audio_filename_regex' => $form['audio_filename_regex'],
            'commentmodifier_video_url_regex'      => $form['video_url_regex'],
            'commentmodifier_video_filename_regex' => $form['video_filename_regex']
        ];

        $this->languageModel->loadCurrentLanguage();

        if ($this->configModel->save($values)) {
            $this->flash->success(t('Settings saved successfully.'));
        } else {
            $this->flash->failure(t('Unable to save your settings.'));
        }

        return $this->response->redirect($this->helper->url->to('CommentModifierController', 'show', ['plugin' => 'CommentModifier']), true);
    }
}