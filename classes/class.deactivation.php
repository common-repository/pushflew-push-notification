<?php


if (!class_exists("Pushflew_Plugin_Deactivation")) {

	/**
	* Class runs on Plugin Deactivation
	*/
	class Pushflew_Plugin_Deactivation
	{
		
		function __construct()
		{
			register_deactivation_hook( PUSHFLEW_MAIN_PLUGIN_FILE , array( $this , 'plugin_deactivation'));
		}

		public function plugin_deactivation()
		{
			// Nothing, keep db data in case reinstalled.
		}
	}
}
return new Pushflew_Plugin_Deactivation;

?>