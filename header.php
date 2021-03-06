<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootstrap-theme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head();

    wp_enqueue_style('slider', get_template_directory_uri() . '/bootstrap/css/bootstrap.css');
    ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'bootstrap-theme'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="navbar navbar-default" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e('Primary Menu', 'bootstrap-theme'); ?></button>
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name') ?> </a>
                </div>
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav navbar-nav')); ?>
            </div>

        </nav><!-- #site-navigation -->
        <?php get_search_form(true); ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
