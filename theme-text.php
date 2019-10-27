<?php
/*
 *
 *  @author  Maximilian Platzner <maxiquester@gmx.de>
 *  This newsletter theme ist based on the DAV-Template (https://template.alpenverein.de/)
 *
 */

global $newsletter; // Newsletter object
global $post; // Current post managed by WordPress

if (!defined('ABSPATH'))
    exit;

/*
 * Some variabled are prepared by Newsletter Plus and are available inside the theme,
 * for example the theme options used to build the email body as configured by blog
 * owner.
 *
 * $theme_options - is an associative array with theme options: every option starts
 * with "theme_" as required. See the theme-options.php file for details.
 * Inside that array there are the autmated email options as well, if needed.
 * A special value can be present in theme_options and is the "last_run" which indicates
 * when th automated email has been composed last time. Is should be used to find if
 * there are now posts or not.
 *
 * $is_test - if true it means we are composing an email for test purpose.
 */


$cards = [];
if (!empty($theme_options['theme_posttitle'])) {
    foreach ($theme_options['theme_posttitle'] as $key => $title) {
        if (!empty($title) && !empty($theme_options['theme_posttext'][$key])) {
            $cards[] = ['title' => $title, 'img' => $theme_options['theme_postimg' . $key]['id'], 'text' => $theme_options['theme_posttext'][$key]];
        }
    }
}
?>
NEWSLETTER <?= esc_attr($theme_options['theme_titel_extension']) ?>
<?php
if (!empty($cards)) {
    foreach ($cards as $card) {
        ?>
        <?= esc_attr($card['title']) ?>
        <?= esc_textarea($card['text']) ?>
        <?php
    }
}
?>
Sieht die Mail komisch aus? Schaue sie dir im Internet an.
Um dich von unserem Newsletter abzumelden klicke bitte hier.
