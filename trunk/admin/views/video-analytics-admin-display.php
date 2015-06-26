<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/jpw123/
 * @since      1.0.0
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/admin/views
 */
?>

<div class="wrap">
    <h2>Video Analytics Options</h2>
    <form action="options.php" method="POST">
    <?php
        settings_fields( 'vimeo-options' );
        do_settings_sections( 'video-analytics-options-page' );
        submit_button();
    ?>
    </form>
    <?php
    
    ?>
</div>
