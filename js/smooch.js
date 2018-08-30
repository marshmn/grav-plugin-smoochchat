/*
 * The smooch_chat_app_id global is provided via inline JS in order to provide the app ID setting from the plugin
 * configuration.
 */

/* global smooch_chat_app_id */

$(function() {

    /*
     * The following code was provided by Smooch in their documentation on how to set up the Web Messenger. The only
     * changes here have been to reformat it and to use the smooch_chat_app_id global variable to pass in the app ID as
     * set in the plugin configuration.
     */

    !function (e, n, t, r) {
        function o() {
            try {
                var e;
                if ((e = "string" == typeof this.response ? JSON.parse(this.response) : this.response).url) {
                    var t = n.getElementsByTagName("script")[0], r = n.createElement("script");
                    r.async = !0, r.src = e.url, t.parentNode.insertBefore(r, t)
                }
            } catch (e) {
            }
        }

        var s, p, a, i = [], c = [];
        e[t] = {
            init: function () {
                s = arguments;
                var e = {
                    then: function (n) {
                        return c.push({type: "t", next: n}), e
                    }, catch: function (n) {
                        return c.push({type: "c", next: n}), e
                    }
                };
                return e
            }, on: function () {
                i.push(arguments)
            }, render: function () {
                p = arguments
            }, destroy: function () {
                a = arguments
            }
        }, e.__onWebMessengerHostReady__ = function (n) {
            if (delete e.__onWebMessengerHostReady__, e[t] = n, s) for (var r = n.init.apply(n, s), o = 0; o < c.length; o++) {
                var u = c[o];
                r = "t" === u.type ? r.then(u.next) : r.catch(u.next)
            }
            p && n.render.apply(n, p), a && n.destroy.apply(n, a);
            for (o = 0; o < i.length; o++) n.on.apply(n, i[o])
        };
        var u = new XMLHttpRequest;
        u.addEventListener("load", o), u.open("GET", "https://" + r + ".webloader.smooch.io/", !0), u.responseType = "json", u.send()
    }(window, document, "Smooch", smooch_chat_app_id);

    Smooch.init({appId: smooch_chat_app_id}).then(function(){});
});
