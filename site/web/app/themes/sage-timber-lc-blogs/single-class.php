<?php

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;
use MedusaContentSuite\TimberMods\TimberPostMod as TimberPostMod;




Common::write_log( "TimberPostMod::test( )" );
Common::write_log( TimberPostMod::test( ) );

$context = Timber::get_context();
//$context['simon'] = get_post_meta( $context['post']->ID );
#$post = $post . array('simon'=>"beezlee");


$context['post'] = new TimberPost($post->ID);
$context['class_type'] = Timber::get_terms('class_type');
$context['meta'] = $context['post']->custom;
$context['class_type'] = get_terms("class_type");


/*foreach($context as $c):
echo "<pre>";
print_r($c);
echo "</pre>";
endforeach;*/


echo "<br>";
echo "<br>";
echo "<br>";

echo "<pre>";
#print_r($context);
echo "</pre>";

Timber::render('templates/single-class.twig', $context);