<?php
/*
 *
 *  @author  Maximilian Platzner <maxiquester@gmx.de>
 *  This newsletter theme ist based on the DAV-Template (https://template.alpenverein.de/)
 *
 */

global $newsletter; // Newsletter object
global $post; // Current post managed by WordPress

/**
 **********************************
 * Customization Variables
 **/
$footerImage = [
    'imgsrc' => esc_url('https://dav-giessen.de/wp-content/uploads/2019/03/1806_KLZG_Logo.png'),
    'imglink' => esc_url('https://kletterzentrum-giessen.de')
];
/**
 **********************************
 **/

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
            $cards[] = ['title' => $title, 'img' => $theme_options['theme_postimg' . $key]['id'], 'imglink' => $theme_options['theme_imglink'][$key], 'text' => $theme_options['theme_posttext'][$key]];
        }
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <style type="text/css">
        @font-face {
            font-family: 'Fira Sans';
            font-style: normal;
            font-weight: 200;
            src: url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.eot');?>);
            src: local('Fira Sans ExtraLight'), local('FiraSans-ExtraLight'),
            url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.eot?#iefix');?>) format('embedded-opentype'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.woff2');?>) format('woff2'), url('https://dav-giessen.de/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.woff') format('woff'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.ttf');?>) format('truetype'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-200.svg#FiraSans');?>) format('svg');
        }

        @font-face {
            font-family: 'Fira Sans';
            font-style: normal;
            font-weight: 400;
            src: url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.eot');?>);
            src: local('Fira Sans Regular'), local('FiraSans-Regular'),
            url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.eot?#iefix');?>) format('embedded-opentype'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.woff2');?>) format('woff2'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.woff');?>) format('woff'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.ttf');?>) format('truetype'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-regular.svg#FiraSans');?>) format('svg');
        }


        @font-face {
            font-family: 'Fira Sans';
            font-style: normal;
            font-weight: 500;
            src: url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.eot');?>);
            src: local('Fira Sans SemiBold'), local('FiraSans-SemiBold'),
            url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.eot?#iefix');?>) format('embedded-opentype'), ! *IE6-IE8 *! url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.woff2');?>) format('woff2'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.woff');?>) format('woff'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.ttf');?>) format('truetype'), url(<?=home_url('/wp-content/themes/dav/assets/fonts/fira/fira-sans-v8-latin-500.svg#FiraSans');?>) format('svg');
        }

        .newsletter-table {
            /*box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);*/
            background-color: transparent;
        }

        .head-table {
            background-color: #61B732;
            color: white;
            vertical-align: center;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
            margin-bottom: 1rem;
        }

        body {
            color: #3F3F3F;
            font-family: 'Fira Sans', Arial, sans-serif;
        <?php
        if(get_theme_mod('dav_background_color')) {

            $style = 'background-color: '.get_theme_mod('dav_background_color').';';
        }

        if(get_theme_mod('dav_backgroundimage')) {

            $style .= 'background: url('.get_theme_mod('dav_backgroundimage').'); background-position: top center; background-repeat: repeat;';
        }
        echo $style;
        ?> font-size: 1rem;
            line-height: 1.5;
        }

        .brand-img {
            margin: 10px 10px 10px;
            max-height: 80px;
            max-width: 100%;
        }

        .content-table {
            background-color: transparent;
        }

        .card-img {
            width: 100%;
        }

        table {
            border: 0;
        }

        tr {
            border: 0;
        }

        td {
            border: 0;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            box-shadow: 2px 5px 5px rgba(0, 0, 0, 0.25);
            margin-bottom: 1rem;
        }

        .praefooter-table {
            background-color: #d8d8d8;
            padding: 1.25rem;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
        }

        .footer-table {
            background-color: #3F3F3F;
            color: white;
            padding: 0.5rem;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
        }

        .footer-table a {
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .newsletter-title {
            font-weight: bold;
            text-transform: uppercase;
        }

        .news-head {
            border-bottom: 2px solid #61B732;
            font-size: 1.4em;
            padding-bottom: 5px;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0 1.25rem 1.25rem;
        }

        .klettz-image {
            max-height: 200px;
        }

    </style>
</head>
<body>
<table class="newsletter-table" align="center" width="550px" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center">
            <table class="head-table" width="550px" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="33.33%">
                        <a href="<?= get_home_url() ?>" title="Zur Homepage">

                            <img width="140px" class="brand-img" src="<?= $theme_options['main_header_logo']['url'] ?>">

                        </a>

                    </td>
                    <td class="newsletter-title" width="66.66%" align="center">
                        NEWSLETTER <?= esc_attr($theme_options['theme_titel_extension']) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <br>
            <br>
            <table class="content-table" width="550px" border="0" cellspacing="0" cellpadding="0">
                <?php
                // Do not use &post, it leads to problems...
                if (!empty($cards)) {
                    foreach ($cards as $card) {
                        ?>
                        <tr>
                            <td width="80%">
                                <div class="card">
                                    <?php
                                    if (!empty($card['img'])) {
                                        if (!empty($card['imglink'])) {
                                            ?>
                                            <a href="<?= $card['imglink'] ?>">
                                            <?php
                                        }
                                        ?>
                                        <img width="550px" class="card-img"
                                             src="<?php echo wp_get_attachment_image_src((int)$card['img'], 'thumbnail')[0]; ?>"/>
                                        <?php
                                        if (!empty($card['imglink'])) {
                                            ?>
                                            </a>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="card-body">
                                        <h2 class="news-head">
                                            <?= esc_attr($card['title']) ?>
                                        </h2>

                                        <?= esc_textarea($card['text']) ?>
                                    </div>

                                </div>
                                <br>
                                <br>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="praefooter-table" width="550px" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <a href="<?= $footerImage['imglink'] ?>"> <img width="230px" class="klettz-image"
                                                                       src="<?= $footerImage['imgsrc'] ?>"></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="footer-table" width="550px" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">Sieht die Mail komisch aus? <a href="{email_url}">Schaue sie dir im Internet
                            an</a>.
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        Um dich von unserem Newsletter abzumelden klicke bitte <a href="{unsubscription_url}">hier</a>.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>