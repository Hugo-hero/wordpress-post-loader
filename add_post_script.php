<?php /* Template Name: Add posts */ ?>
<?php get_header(); ?>
<?php
$files = glob(get_template_directory() . "/your_patht_to_your_content_here/*.html");
$user = get_user_by('slug', 'Your_user_name_here');
$category = get_terms(['taxonomy' => 'category', 'name__like' => 'your_category'])[0];
foreach ( $files as $filename) {
    $content = file_get_contents($filename);
    $title = str_replace('-', ' ', basename($filename, ".html").PHP_EOL); // by default the title of the post will be taken from each file title.
    $my_post = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'draft',
        'post_author' => $user->ID,
        'post_category' => [$category->term_id]
    );
    $post_id = wp_insert_post($my_post);

    echo "$filename \n";
}
?>


<?php get_footer(); ?>
