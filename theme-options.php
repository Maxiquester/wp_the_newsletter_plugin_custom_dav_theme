<?php
/*
 * This is a pre packaged theme options page. Every option name
 * must start with "theme_" so Newsletter can distinguish them from other
 * options that are specific to the object using the theme.
 *
 * An array of theme default options should always be present and that default options
 * should be merged with the current complete set of options as shown below.
 *
 * Every theme can define its own set of options, the will be used in the theme.php
 * file while composing the email body. Newsletter knows nothing about theme options
 * (other than saving them) and does not use or relies on any of them.
 *
 * For multilanguage purpose you can actually check the constants "WP_LANG", until
 * a decent system will be implemented.
 */
/* @var $controls NewsletterControls */

if (!defined('ABSPATH'))
    exit;

$theme_defaults = array(
    'theme_titel_extension' => '',
    'theme_posttitle' => [],
    'theme_posttext' => [],
    'theme_postimg0' => null,
    'theme_postimg1' => null, 'theme_postimg2' => null, 'theme_postimg3' => null, 'theme_postimg4' => null, 'theme_postimg5' => null, 'theme_postimg6' => null, 'theme_postimg7' => null
);

// Mandatory!
$controls->merge_defaults($theme_defaults);

?>

<table class="form-table">
    <tr>
        <td>Titel-Datum</td>
        <td>
            <?php
            $controls->text("theme_titel_extension");
            ?></td>
    </tr>
    <tr>
        <th colspan="2"> Bitte Einträge hier einfügen</th>
    </tr>
    <?php
    for ($i = 0; $i < 8; $i++) {
        $posttitle = $controls->get_value_array('theme_posttitle')[$i];
        $text = $controls->get_value_array('theme_posttext')[$i];
        ?>
        <tr>
            <td> Titel</td>
            <td>
                <input name="options[theme_posttitle][<?= $i ?>]" value="<?= $posttitle ?>">
            </td>
        </tr>
        <tr>
            <td>
                Bild (optional)
            </td>
            <td>
                <?php
                $controls->media('theme_postimg' . $i);
                ?>
            </td>
        </tr>
        <tr>
            <td style="border-bottom: black dotted">
                Text
            </td>
            <td style="border-bottom: black dotted">
                <textarea name="options[theme_posttext][<?= $i ?>]"><?= $text ?></textarea>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
