<?php


if (!class_exists("Pushflew_Plugin_Activation")) {

	/**
	* Class runs on Plugin activation
	*/
	class Pushflew_Plugin_Activation
	{
		
		function __construct()
		{
			register_activation_hook( PUSHFLEW_MAIN_PLUGIN_FILE, array( $this , 'plugin_activation'));
		}

		public function plugin_activation()
		{
			if (version_compare($GLOBALS['wp_version'], PUSHFLEW_MINIMUM_WP_VERSION, '<')) {
				load_plugin_textdomain('pushflew');
				$message = '<strong>' . sprintf(esc_html__('Pushflew %s requires WordPress %s or higher.', 'pushflew'), PUSHFLEW_VERSION, PUSHFLEW_MINIMUM_WP_VERSION) . '</strong> ' . sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version.', 'pushflew'), 'https://codex.wordpress.org/Upgrading_WordPress');
				$this->bail_on_activation($message);
			} else {
				global $wpdb;
				$protocol = $_SERVER['REQUEST_SCHEME'];
				if (!empty($protocol) && $protocol == 'https') {
					$datas = "var version = 1.1;
					importScripts('https://cdn.pushflew.com/service_worker.js');";
					$filename = 'pushflew_worker.js';
					$filepath = get_home_path().$filename;
					$fp = fopen($filepath, "w");
					$write = fwrite($fp, $datas);
					fclose($fp);
					chmod($filepath, 0775);
				}
				$pushflewData = Pushflew::getPushflewData();
			}
		}

		private function bail_on_activation($message, $deactivate = true) {
			?>
				<!doctype html>
				<html>
					<head>
						<meta charset="<?php bloginfo('charset'); ?>">
						<style>
							* {
								text-align: center;
								margin: 0;
								padding: 0;
								font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
							}
							p {
								margin-top: 1em;
								font-size: 18px;
							}
						</style>
					</head>
					<body>
						<p><?php echo esc_html($message); ?></p>
					</body>
				</html>
			<?php

			if ($deactivate) {
				$plugins = get_option('active_plugins');
				$pushflew = plugin_basename(AKISMET__PLUGIN_DIR . 'pushflew.php');
				$update = false;
				foreach ($plugins as $i => $plugin) {
					if ($plugin === $pushflew) {
						$plugins[$i] = false;
						$update = true;
					}
				}
				if ($update) {
					update_option('active_plugins', array_filter($plugins));
				}
			}
			exit;
		}
	}
}

return new Pushflew_Plugin_Activation;
?>