e.hasClass("advanced_responsiveness") ? $window_width > j[0] ? o = t : $window_width > j[1] ? o = .75 * t : $window_width > j[2] ? o = .6 * t : $window_width > j[3] ? o = .55 * t : $window_width <= j[3] && (o = .45 * t) : $window_width > j[0] ? o = t : $window_width > j[1] ? o = .8 * t : $window_width > j[2] ? o = .7 * t : $window_width <= j[2] && (o = 1 * t),
                e.css({
                    height: o + "px"
                }),