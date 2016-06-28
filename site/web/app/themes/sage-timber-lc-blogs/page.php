page.php<?php
$context = Timber::get_context();

$context['sidebar'] = Timber::get_sidebar('sidebar.php');

Timber::render('templates/page.twig', $context);