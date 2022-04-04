/**
 * main.js
 *
 * For all custom js codes.
 */


/* VANILLA JS */

const players = Array.from(document.querySelectorAll('.video-player')).map((p) => new Plyr(p));

Plyr.setup('.video-player', {
    hideControls: false
});

/* JQUERY */

jQuery(document).ready(function($) {

});

