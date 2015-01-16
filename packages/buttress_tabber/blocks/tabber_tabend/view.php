<?php
/** @var Page $p */
$p = Page::getCurrentPage();

if ($p->isEditMode()) {
    ?>
    <div class='ccm-edit-mode-disabled-item'><?= t('Tab End') ?></div>
<?php
} else {
    ?>
    <div class="buttress-tabber-element buttress-tabber-tab-end"></div>
<?php
}
