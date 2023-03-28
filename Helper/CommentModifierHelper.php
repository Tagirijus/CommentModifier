<?php

namespace Kanboard\Plugin\CommentModifier\Helper;

use Kanboard\Core\Base;
// use Kanboard\Model\TaskModel;
// use Kanboard\Model\ProjectModel;
// use Kanboard\Model\SubtaskModel;


class CommentModifierHelper extends Base
{
    /**
     * Replace in the given content string every regex
     * occurence with a HTML5 player - for audio.
     *
     * @param  string $content
     * @return string
     */
    public function replaceAudioURLsWithPlayer($content)
    {
        return $this->replaceURLsWithPlayer(
            $content,
            '<a href="https://www.%1$s" target="_blank">%2$s</a><br><br><audio src="https://www.%1$s" controls></audio>',
            'commentmodifier_audio_url_regex',
            'commentmodifier_audio_filename_regex'
        );
    }

    /**
     * Replace in the given content string every regex
     * occurence with a HTML5 player - for video.
     *
     * @param  string $content
     * @return string
     */
    public function replaceVideoURLsWithPlayer($content)
    {
        return $this->replaceURLsWithPlayer(
            $content,
            '<a href="https://www.%1$s" target="_blank">%2$s</a><br><br><video src="https://www.%1$s" controls></video>',
            'commentmodifier_video_url_regex',
            'commentmodifier_video_filename_regex'
        );
    }

    /**
     * Wrapper function for the HTML5 player replacmenet functions.
     *
     * @param  string $content
     * @param  string $html_replacement
     * @param  string $url_regex_config
     * @param  string $filename_regex_config
     * @return string
     */
    protected function replaceURLsWithPlayer($content, $html_replacement, $url_regex_config, $filename_regex_config)
    {
        $pattern_url = $this->configModel->get(
            $url_regex_config,
            '/(domain\.org.*\.(mp3|ogg)+)/'
        );
        $pattern_filename = $this->configModel->get(
            $filename_regex_config,
            '/[^\/]+$/'
        );

        return preg_replace_callback($pattern_url, function ($matches) use ($pattern_filename, $html_replacement) {
            $url = $matches[0];
            $filename = '';
            preg_match($pattern_filename, $url, $filename_match);
            if (isset($filename_match[0])) {
                $filename = $filename_match[0];
            }
            return sprintf($html_replacement, $url, $filename);
        }, $content);
    }
}
