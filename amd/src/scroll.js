/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Shoelace Scroll AMD.');

(function( $ ) {
    "use strict";
 
    $.fn.shoelaceScroll = function(options) {
        var settings = $.extend({}, $.fn.shoelaceScroll.defaults, options);
        settings.elementHeight = settings.theElement.height() + 1;
        var tally = 0;
        var diff = 0;
        var currentElementTop = 0;
        var elementFullyShown = true;
        var elementFullyHidden = false;
        var down = false;
        var last = $(this).scrollTop();
        var current = last;

        var inspect = function(object) {
            for (var key in object) {
                log.debug('K: ' + key + ' V: ' + object[key]);
            }
        };

        var setElementTop = function() {
            var newElementTop = currentElementTop;
            if (down) {
                newElementTop += diff;
                if (newElementTop > settings.elementHeight) {
                    newElementTop = settings.elementHeight;
                    elementFullyHidden = true;
                    elementFullyShown = false;
                    log.debug('SET: Element fully hidden.');
                } else {
                    elementFullyShown = false;
                    elementFullyHidden = false;
                    log.debug('SET: Element partial (down).');
                }
            } else {
                newElementTop -= diff;
                if (newElementTop < 0) {
                    newElementTop = 0;
                    elementFullyShown = true;
                    elementFullyHidden = false;
                    log.debug('SET: Element fully shown.');
                } else {
                    elementFullyShown = false;
                    elementFullyHidden = false;
                    log.debug('SET: Element partial (up).');
                }
            }
            settings.theElement.css('top', '-' + newElementTop + 'px');
            currentElementTop = newElementTop;
        }

        this.on('mouseup', function (evt) {
            log.debug('MUP - tally reset.');
            tally = 0;
            //log.debug('MUP ' + evt.pageX);
        });

        this.on('touchend', function (evt) {
            log.debug('TEND - tally reset.');
            tally = 0;
            //log.debug('TENDP ' + evt.pageX);
        });

        this.on('keyup', function (evt) {
            //log.debug('KEYP ' + evt.pageX);
            //log.debug('KEYC ' + evt.keyCode);
            log.debug('KEYC ' + evt.which);
            // Key 38 is cursor up and ket 40 is cursor down.
            if ((evt.which == 38) || (evt.which == 40)) {
                if (evt.target == document.body) {
                    log.debug('KEYC \'isBody\' with up/down cursor key - tally reset.');
                    tally = 0;
                }
            }
            //inspect(evt);
        });

        this.on('resize', function (evt) {
            log.debug('RESZ - tally reset.');
            tally = 0;
            //inspect(evt);
        });

        this.scroll(function(evt) {
            //log.debug('SC');
            //log.debug('SC EVT:');
            //inspect(evt.originalEvent);
            current = $(this).scrollTop();
            log.debug('SCTop: ' + current);
            if (current > last) {
                if (!down) {
                    // Change of direction, reset tally.
                    log.debug('SC was up now down - reset tally.');
                    tally = 0;
                }
                down = true;
                diff = current - last;
                tally += diff;
                if (!elementFullyHidden) {
                    setElementTop();
                }
            } else {
                if (down) {
                    // Change of direction, reset tally.
                    log.debug('SC was down now up - reset tally.');
                    tally = 0;
                }
                down = false;
                diff = last - current;
                tally += diff;
                if ((tally >= settings.move) || (current <= settings.elementHeight)) {
                    // Start to show the element if we have moved beyond the tally or getting to the element height at the top.
                    if (!elementFullyShown) {
                        setElementTop();
                    }
                }
            }
            log.debug('SCDiff: ' + diff);
            log.debug('SCTally: ' + tally);
            last = current;
        });

        return this;
    };
    
    $.fn.shoelaceScroll.defaults = {
        move: 250
    };
}($));

    return {
        init: function() {
            log.debug('Shoelace Scroll AMD init.');
            $(document).ready(function($) {
                
                $(window).shoelaceScroll({theElement: $('.navbar')});
            });
        }
    }
});
/* jshint ignore:end */
