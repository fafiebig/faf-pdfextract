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
    if (wp_is_post_revision($id)){
        return;
    }

    if (get_post_mime_type($id) !== 'application/pdf') {
        return;
    }

    if (!`which pdftotext`) {
        //return;
        $content = 'Du benötigst pdftotext (poppler utils) auf deinem Server!';
    } else {
        $file = get_attached_file($id);
        if (is_file($file)) {
            $txt = $file . '.txt';

            system('pdftotext -layout ' . $file . ' ' . $txt);

            if (is_file($txt)) {
                $content = file_get_contents($txt);
            }
        }
    }

    $data                   = [];
    $data['ID']             = $id;
    $data['post_content']   = $content;

    remove_action('edit_attachment', 'extractPdfContent');
    wp_update_post($data);
    add_action('edit_attachment', 'extractPdfContent');
}
add_action('edit_attachment', 'extractPdfContent', 10, 2);
add_action('add_attachment', 'extractPdfContent', 10, 2);
