<?php
// FOR SEED STAT PRO PLUGIN
if( function_exists( 'run_Seed_Stat' ) ){

	add_action('plant_end_entry_meta', 'plant_add_stat');
	add_action('plant_end_archive_meta', 'plant_add_stat');

	function plant_add_stat() {
		echo do_shortcode('[s_stat]');
	}
}