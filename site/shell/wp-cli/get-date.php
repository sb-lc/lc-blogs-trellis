<?php
$hello_command = function( $args, $assoc_args ) {
	list( $name ) = $args;
	$type = $assoc_args['type'];
	WP_CLI::$type( "Hello, $name!" );
}
WP_CLI::add_command( 'example hello', $hello_command, array(
	'shortdesc' => 'Prints a greeting.',
	'synopsis' => array(
		array(
			'type'     => 'positional',
			'name'     => 'name',
			'optional' => false,
			'multiple' => false,
		),
		array(
			'type'     => 'assoc',
			'name'     => 'type',
			'optional' => true,
			'default'  => 'success',
			'options'  => array( 'success', 'error' ),
		),
	),
	'when' => 'before_wp_load',
) );