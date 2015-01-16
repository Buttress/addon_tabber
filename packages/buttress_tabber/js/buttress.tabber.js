(function (global, $) {
    "use strict";

    global.tabber = global.tabber || { tabsets: [] };
    global.tabber.registerTabset = function(element, template, renderCallback) {
        global.tabber.tabsets.push([elements, template, renderCallback]);
    };

    function Tab(name) {
        this._config = {
            name: name,
            contents: $(),
            id: _.uniqueId('tab_')
        };
    }

    Tab.prototype = {

        setContents: function ($contents) {
            this._config.contents = $contents;
        },

        getName: function () {
            return this._config.name;
        },

        getId: function () {
            return this._config.id;
        },

        getPlaceholder: function () {
            return "<div id='buttress-tabset-tab-placeholder-" + this.getId() + "'></div>";
        }

    };


    function TabSet(placeholder, template) {
        this._config = {
            tabs: [],
            id: _.uniqueId('tabset_'),
            placeholder: placeholder,
            template: template
        };
    }

    TabSet.prototype = {

        getChildren: function () {
            return this._config.tabs;
        },

        getPlaceholder: function () {
            return this._config.placeholder;
        },

        addChild: function (/* Tab */ tab) {
            this._config.tabs.push(tab);
        },

        getId: function () {
            return this._config.id;
        },

        render: function (callback) {
            var rendered = $(_.template(this._config.template, {tabset: this}));

            _(this.getChildren()).each(function (child) {
                rendered.find('#buttress-tabset-tab-placeholder-' + child.getId()).replaceWith(child._config.contents);
            });

            callback(this, rendered);
            this._config.placeholder.replaceWith(rendered);
        }

    };

    global.tabber.render = function () {

        var render_handler = function () {
            var registered = $();
            _(global.tabber.tabsets).each(function (set_array) {
                var element = set_array[0], template = set_array[1], renderCallback = set_array[2],
                    callback = renderCallback || $.noop;

                if (template) {
                    element.data('tabber-template', template);
                }
                element.data('tabber-callback', callback);
                registered = registered.add(element);
            });

            var sets = registered,
                parents = sets.parent(),
                tabsets = [],
                current_tabset = null,
                current_tab = null,
                handleTabElement = function (element) {
                    if (element.hasClass('buttress-tabber-tabset')) {
                        current_tab = new Tab(element.data('tabber-tab-name'));
                        current_tabset = new TabSet(element, element.data('tabber-template'));
                        current_tabset.addChild(current_tab);

                        tabsets.push(current_tabset);
                    } else if (element.hasClass('buttress-tabber-tab')) {
                        current_tab = new Tab(element.data('tabber-tab-name'));
                        current_tabset.addChild(current_tab);
                    } else if (element.hasClass('buttress-tabber-tab-end')) {
                        current_tabset = null;
                        current_tab = null;
                    }
                };

            sets.parent().each(function() {
                if ($(this).hasClass('ccm-custom-style-container')) {
                    $(this).replaceWith($(this).children());
                }
            });

            sets.parent().each(function () {
                var parent = $(this);
                if ($(this).hasClass('ccm-custom-style-container')) {
                    parent = $(this).parent();
                    $(this).replaceWith($(this).children());
                }

                var children = parent.children();
                children.each(function () {
                    var me = $(this);
                    if (me.hasClass('buttress-tabber-element')) {
                        handleTabElement(me);
                    } else if (current_tab) {
                        current_tab.setContents(current_tab._config.contents.add(me));
                    }
                });
            });

            _(tabsets).each(function (tabset) {
                tabset.render(tabset.getPlaceholder().data('tabber-callback'));
            });
        };

        return function () {
            render_handler.call(this);
            render_handler = $.noop;
        };

    }();

    $(function() {
        global.tabber.render();
    });

}(window, jQuery));
