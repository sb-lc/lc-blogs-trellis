<li<?php if (! has_post_thumbnail() ) { echo ' class="no-img"'; } ?>>

<?php the_post_thumbnail('large-blog-800-425', array( "class" => "img-responsive large-blog-800-425"));  ?>

<div class="wrap">


<div class="categories">

<?php

$terms = get_the_terms( $post, 'blog_category');

$term_html = "";

foreach( $terms as $t ){
	
	$term_link = get_term_link( $t );
	$term_html = "<a href='" . $term_link . "'>";
	$term_html .= "<span class='category'>";
	$term_html .= $t->name;
	$term_html .= "</span></a>";

	echo $term_html;
}


?>
</div>

<h3>
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
<?php the_title(); ?>
</a>
</h3>


<?php 

$user_link = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); 

$user_img = wp_get_attachment_image(

get_the_author_meta('_cmb_user_options_user_profile_image_id'), 'thumbnail', "", array( "class" => "contributor") );


?>

<div>
<span class="user">

<a href="<?php echo $user_link; ?>">
<span class="image"><?php echo $user_img;?></span>
</a>
<a href="<?php echo $user_link; ?>">
<span class="name"> By <?php the_author(); ?></span>
</a>

</span>

<span class="date"> | <?php the_date('d-m-y'); ?></span>

</div>

<?php echo get_custom_excerpt(800);?>

</div>

</li>