<?php /* Template Name: Add post auto */ ?>
<?php get_header(); ?>
<?php
$files = glob(get_template_directory() . "/auto-posts/*.html");
$user = get_user_by('slug', 'Hugo');
$category = get_terms(['taxonomy' => 'category', 'name__like' => 'bourse'])[0];
foreach ( $files as $filename) {
    $content = file_get_contents($filename);
    $title = str_replace('-', ' ', basename($filename, ".html").PHP_EOL);
    $my_post = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'draft',
        'post_author' => $user->ID,
        'post_category' => [$category->term_id]
    );
    $post_id = wp_insert_post($my_post);

    // add category type
    // SHOULD BE CHANGED TO "LEXIQUE"
    wp_set_object_terms($post_id, 'glossaire', "category_type");
    echo "$filename \n";
}
?>


<?php get_footer(); ?>