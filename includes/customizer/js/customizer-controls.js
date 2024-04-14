/* global wp, jQuery */

/**
 * Contains handlers for displaying the Customizer controls based
 * on the device selected.
 */

(function($) {
	wp.customize.bind('ready', function () {
		function checkDevice() {
			var device = wp.customize.previewedDevice.get();
			
			// Header controls
			wp.customize.control('mobile_menu_color').container.toggle(device !== 'desktop');
			wp.customize.control('mobile_menu_text_color').container.toggle(device !== 'desktop');
			wp.customize.control('hamburger_color').container.toggle(device !== 'desktop');
			wp.customize.control('submenu_color').container.toggle(device === 'desktop');
			wp.customize.control('submenu_text_color').container.toggle(device === 'desktop');
		}

		checkDevice(); // Check the device on page load

		wp.customize.previewedDevice.bind(function () {
			checkDevice(); // Check the device when it changes
		});
	});
}(jQuery));
