/* global wp, jQuery */

/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers for the Customizer controls.
 */

(function($) {
	wp.customize.bind('ready', function () {
		function checkDevice() {
			var device = wp.customize.previewedDevice.get();
			
			// Header
			wp.customize.control('hamburger_color').container.toggle(device !== 'desktop');
		}

		checkDevice(); // Check the device on page load

		wp.customize.previewedDevice.bind(function () {
			checkDevice(); // Check the device when it changes
		});
	});
}(jQuery));
