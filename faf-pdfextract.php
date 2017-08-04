<?php

/*
Plugin Name: FAF PdfExtract
Plugin URI: https://github.com/fafiebig/faf-pdfextract
Description: Extract PDF file contents.
Version: 1.0
Author: F.A. Fiebig
Author URI: http://fafworx.com
License: GNU GENERAL PUBLIC LICENSE
*/

defined('ABSPATH') or die('No direct script access allowed!');

/**
 * @param $id
 */
function extractPdfContent($id)
{
    if (!`which pdftotext` || get_post_mime_type($id) !== 'application/pdf') {
        return;
        //throw new Exception('Du benötigst pdftotext (poppler utils) auf deinem Server!');
    }

    $file = get_attached_file($id);
    if (is_file($file)) {
        $txt = $file.'.txt';

        system('pdftotext -layout '.$file.' '.$txt);

        if (is_file($txt)) {
            $content = file_get_contents($txt);
            update_post_meta($id, 'content', $content);
        }
    }
}
add_action('save_post', 'extractPdfContent');