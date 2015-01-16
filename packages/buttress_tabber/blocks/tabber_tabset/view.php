<?php
/** @var Page $p */
$p = Page::getCurrentPage();

if ($p->isEditMode()) {
    ?>
    <div class='ccm-edit-mode-disabled-item'><?= t('New Tab Set "%s"', h($name)) ?></div>
    <?php
} else {
    ?>
    <div class="buttress-tabber-element buttress-tabber-tabset" data-tabber-tab-name="<?= h($name) ?>" id="<?= $tabid = uniqid('buttress-tabber-') ?>">
        <script class="tabset-template" type='text/html'>
            <div class="buttress-tabset">
                <div class="buttress-tabset-labels">
                    <ul>
                        <% _(tabset.getChildren()).each(function(tab) { %>
                            <li class="buttress-tabset-label" data-tab-id="<%= tab.getId() %>"><%- tab.getName() %></li>
                        <% }); %>
                    </ul>
                </div>
                <div class="buttress-tabset-tabs">
                    <% _(tabset.getChildren()).each(function(tab) { %>
                        <div class="buttress-tabset-tab" style="display:none" data-tab-id="<%= tab.getId() %>">
                            <%= tab.getPlaceholder() %>
                        </div>
                    <% }); %>
                </div>
            </div>
        </script>
    </div>

    <script>
        (function(global) {
            var tabset = $('#<?= $tabid ?>');
            global.tabber = global.tabber || { tabsets: [] };
            global.tabber.tabsets.push([tabset, tabset.children('.tabset-template').text(), function(tabset_object, rendered) {
                var tabs_container = rendered.find('.buttress-tabset-tabs'),
                    label_container = rendered.find('.buttress-tabset-labels'),
                    tabs = tabs_container.children(),
                    labels = label_container.children().children();

                labels.each(function() {
                    var me = $(this),
                        tab = tabs.filter('[data-tab-id="' + me.data('tab-id') + '"]');

                    me.click(function() {
                        if (me.hasClass('active')) return;

                        labels.removeClass('active');
                        me.addClass('active');
                        tabs.hide()
                        tab.show()
                    });
                }).first().click();
            }]);

        }(this));
    </script>
<?php
}
