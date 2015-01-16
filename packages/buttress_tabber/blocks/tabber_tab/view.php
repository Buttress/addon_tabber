<?php
/** @var Page $p */
$p = Page::getCurrentPage();

if ($p->isEditMode()) {
    ?>
    <div class='ccm-edit-mode-disabled-item'><?= t('New Tab "%s"', h($name)) ?></div>
<?php
} else {
    ?>
    <div class="buttress-tabber-element buttress-tabber-tab" data-tabber-tab-name="<?= h($name) ?>"></div>
<?php
}
