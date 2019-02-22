<?php
$user_ID = get_current_user_id();

if ( !$user_ID ) {
    return;
}

$use_buddypress = class_exists( 'BuddyPress' );

if ( $use_buddypress ) {
    $author_url         = bp_core_get_user_domain( $user_ID );
    $author_name        = bp_activity_get_user_mentionname( $user_ID );
    $author_cover_image = bp_attachments_get_attachment( 'url', array(
        'object_dir' => 'members',
        'item_id'    => $user_ID,
    ) );
} else {
    $author_url         = get_author_posts_url( $user_ID );
    $author_name        = wp_get_current_user()->display_name;
    $author_cover_image = '';
}

$author_cover_image = $author_cover_image ? "background-image: url({$author_cover_image})" : '';
?>

<div class="ui-block user-welcomeback">
    <div class="featured-background" style="<?php echo esc_attr( $author_cover_image ); ?>"></div>
    <div class="user-active">
        <a href="<?php echo esc_url( $author_url ); ?>" class="author-thumb">
            <?php echo get_avatar( $user_ID, 90 ); ?>
        </a>
        <div class="author-content">
            Welcome Back <a href="<?php echo esc_url( $author_url ); ?>" class="author-name"><?php olympus_render( $author_name ); ?></a>!
        </div>
    </div>
    <?php if ( $use_buddypress ) { ?>
        <div class="you-can-do"><?php esc_html_e( 'here\'s what you can do!', 'crumina' ); ?></div>
        <div class="links">
            <?php if ( bp_is_active( 'activity' ) ) { ?>
                <a href="<?php echo esc_url( bp_loggedin_user_domain() . bp_get_activity_slug() ); ?>" class="link-item">
                    <svg class="olymp-newsfeed-icon"><use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-newsfeed-icon"></use></svg>
                    <div class="title"><?php esc_html_e( 'Activity', 'crumina' ); ?></div>
                    <div class="sup-title"><?php esc_html_e( 'Review your activity!', 'crumina' ); ?></div>
                </a>
            <?php } ?>
            <?php if ( bp_is_active( 'notifications' ) ) { ?>
                <a href="<?php echo bp_get_notifications_unread_permalink(); ?>" class="link-item">
                    <svg class="olymp-thunder-icon"><use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-thunder-icon"></use></svg>
                    <div class="title"><?php esc_html_e( 'Notifications', 'crumina' ); ?></div>
                    <div class="sup-title"><?php esc_html_e( 'Check out what\'s new!', 'crumina' ); ?></div>
                </a>
            <?php } ?>
            <?php if ( class_exists( 'bbPress' ) && defined( 'BP_FORUMS_SLUG' ) ) { ?>
                <a href="<?php echo esc_url( bp_loggedin_user_domain() . BP_FORUMS_SLUG ); ?>" class="link-item">
                    <svg class="olymp-chat---messages-icon"><use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-chat-messages-icon"></use></svg>
                    <div class="title"><?php esc_html_e( 'Forums', 'crumina' ); ?></div>
                    <div class="sup-title"><?php esc_html_e( 'Start a new discussion!', 'crumina' ); ?></div>
                </a>
            <?php } ?>
            <?php if ( bp_is_active( 'settings' ) ) { ?>
                <a href="<?php echo esc_url( bp_loggedin_user_domain() . bp_get_settings_slug() ); ?>" class="link-item">
                    <svg class="olymp-settings-icon"><use xlink:href="<?php echo get_template_directory_uri(); ?>/images/icons.svg#olymp-settings-icon"></use></svg>
                    <div class="title"><?php esc_html_e( 'Settings', 'crumina' ); ?></div>
                    <div class="sup-title"><?php esc_html_e( 'Manage your preferences!', 'crumina' ); ?></div>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="ui-block-content">
        <a href="<?php echo esc_url( $author_url ); ?>" class="btn btn-lg btn-primary mb-0 full-width">Go to your Profile Page</a>
    </div>
</div>