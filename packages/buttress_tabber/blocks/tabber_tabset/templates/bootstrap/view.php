<?php
$p = Page::getCurrentPage();
if ($p->isEditMode()) {
    ?>
    <div class='ccm-edit-mode-disabled-item'><?= t('New Tab Set "%s"', h($name)) ?></div>
<?php
} else {
    ?>
    <div class="buttress-tabber-element buttress-tabber-tabset" data-tabber-tab-name="<?= h($name) ?>"
         id="<?=$tabid = uniqid('buttress-tabber-') ?>">
        <script type="text/html" class="buttress-template">
            <div class="buttress-boostrap-tabs">
                <ul class="nav nav-tabs">
                    <% _(tabset.getChildren()).each(function(tab) { %>
                        <li>
                            <a href="#home" data-id="<%= tab.getId() %>">
                                <%= tab.getName() %>
                            </a>
                        </li>
                    <% }); %>
                </ul>
                <div class="tab-content">
                    <% _(tabset.getChildren()).each(function(tab) { %>
                        <div class="tab-pane" data-id="<%= tab.getId() %>">
                            <%= tab.getPlaceholder() %>
                        </div>
                    <% }); %>
                </div>
            </div>
        </script>
    </div>

    <script>
        (function (global) {
            var tabset = $('#<?= $tabid ?>');
            global.tabber = global.tabber || {tabsets: []};
            global.tabber.tabsets.push([tabset, tabset.children('.buttress-template').text(), function (tabset_object, rendered) {
                rendered.children('.nav-tabs').children().children().click(function (e) {
                    rendered.children('.nav-tabs').find('li').removeClass('active');
                    $(this).parent().addClass('active');
                    rendered.children('.tab-content').children().hide().filter('[data-id="' + $(this).attr('data-id') + '"]').show();
                }).first().click();
            }]);

        }(this));
    </script>
<?php
}
