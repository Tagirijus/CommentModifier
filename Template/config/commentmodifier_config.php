<div class="page-header">
    <h2><?= t('CommentModifier configuration') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('CommentModifierController', 'saveConfig', ['plugin' => 'CommentModifier']) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>

    <br>

    <p>
        <?= t('The URL regex is the part to be recognized and replaced by a HTML5 player. The filename regex is the part to be recognized as the filename title for the additional link to be placed.') ?>
    </p>

    <div class="task-form-container">

        <div class="task-form-main-column">
            <?= $this->form->label('Audio URL regex ', 'audio_url_regex') ?>
            <?= $this->form->text('audio_url_regex', ['audio_url_regex' => $audio_url_regex], [], [
                'autofocus',
                'tabindex="1"'
            ]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label('Audio filename regex', 'audio_filename_regex') ?>
            <?= $this->form->text('audio_filename_regex', ['audio_filename_regex' => $audio_filename_regex], [], [
                'autofocus',
                'tabindex="2"'
            ]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label('Video URL regex', 'video_url_regex') ?>
            <?= $this->form->text('video_url_regex', ['video_url_regex' => $video_url_regex], [], [
                'autofocus',
                'tabindex="3"'
            ]) ?>
        </div>

        <div class="task-form-main-column">
            <?= $this->form->label('Video filename regex', 'video_filename_regex') ?>
            <?= $this->form->text('video_filename_regex', ['video_filename_regex' => $video_filename_regex], [], [
                'autofocus',
                'tabindex="4"'
            ]) ?>
        </div>

    </div>



    <div class="task-form-bottom">
        <?= $this->modal->submitButtons() ?>
    </div>

</form>
