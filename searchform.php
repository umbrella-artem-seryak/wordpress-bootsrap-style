<?php
/**
 * Template for displaying search form
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group">
    <label>
        <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'bootstrap-theme' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>

    <button type="submit" class="btn btn-default"><?php echo _x( 'Search', 'submit button', 'bootstrap-theme' ); ?></button>
    </div>
</form>
