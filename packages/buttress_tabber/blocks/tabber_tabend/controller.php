<?php
namespace Concrete\Package\ButtressTabber\Block\TabberTabend;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{

    protected $btName = "Tabber Tab End";
    protected $btDescription = "End a tab set";
    protected $btTable = 'btTabberTab';
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "500";
    protected $btIgnorePageThemeGridFrameworkContainer = true;

}
