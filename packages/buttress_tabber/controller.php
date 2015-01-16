<?php
namespace Concrete\Package\ButtressTabber;

use AssetList;
use Package;

class Controller extends Package
{

    protected $pkgHandle = 'buttress_tabber';
    protected $appVersionRequired = '5.7.2';
    protected $pkgVersion = '1.0';

    public function getPackageName()
    {
        return t('Buttress Tabber');
    }

    public function getPackageDescription()
    {
        return t('Automatic tabs built from blocks');
    }

    public function on_start()
    {
        $asset_list = AssetList::getInstance();
        $asset_list->registerMultiple(
            array(
                'buttress/tabber' => array(
                    array('javascript', "js/buttress.tabber.min.js", array('position' => 'H'), $this),
                    array('css', "css/buttress.tabber.css", array(), $this)
                ),
            ));
    }

    public function install()
    {
        parent::install();

        $package = Package::getByHandle($this->getPackageHandle());
        $set = \BlockTypeSet::add('tabber', 'Tabber Tabs', $package);

        $bt = \BlockType::installBlockType('tabber_tab', $package);
        $set->addBlockType($bt);

        $bt = \BlockType::installBlockType('tabber_tabset', $package);
        $set->addBlockType($bt);

        $bt = \BlockType::installBlockType('tabber_tabend', $package);
        $set->addBlockType($bt);
    }

}
