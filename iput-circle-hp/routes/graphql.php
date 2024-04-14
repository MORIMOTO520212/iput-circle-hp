<?php
// HTTPリクエストを実際にここで受け取る
require_once( ABSPATH . PLUGINDIR . '/wp-graphql/access-functions.php' );


add_action( 'graphql_register_types', function() {

	register_graphql_object_type(
		'StuntPerformer',
		[
			'description' => __( 'Stunt Performer', 'bsr' ),
			'fields'      => [
				'firstName' => [
					'type'        => 'String',
					'description' => 'first name'
				],
				'lastName'  => [
					'type'        => 'String',
					'description' => 'last name'
				],
				'uid'       => [
					'type'        => 'String',
					'description' => 'user id'
				]
			],
		]
	);

	register_graphql_field(
		'RootQuery',
		'stuntPerformers',
		[
			'description' => __( 'Return stunt performers', 'bsr' ),
			'type'        => [ 'list_of' => 'stuntPerformer' ],
			'resolve'     => function() {
				$stunt_performers = [];
				$performers       = get_users( array(
					'role__in' => 'administrator'
				) );

				foreach ( $performers as $p ) {
					$performer = [
						'firstName' => $p->first_name,
						'lastName'  => $p->last_name,
						'uid'       => $p->ID
					];

					$stunt_performers[] = $performer;
				}

				return $stunt_performers;
			}
		]
	);

} );
?>