<?php
$context = Timber::get_context();
echo "<pre>";
print_r($context);
echo "</pre>";

Timber::render('templates/single.twig', $context);