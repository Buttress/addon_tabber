<?php
namespace Concrete\Package\ButtressTabber\Block\TabberTab;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{

    protected $btName = "Tabber Tab";
    protected $btDescription = "Begin a new tab";
    protected $btTable = 'btTabberTab';
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "500";
    protected $btIgnorePageThemeGridFrameworkContainer = true;

    public function view()
    {
        $this->set('name', uniqid());
    }

}
