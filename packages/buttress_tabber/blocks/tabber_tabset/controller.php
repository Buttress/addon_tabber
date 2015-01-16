<?php
namespace Concrete\Package\ButtressTabber\Block\TabberTabset;

use Concrete\Core\Block\BlockController;

class Controller extends BlockController
{

    protected $btName = "Tabber Tab Set";
    protected $btDescription = "Begin a new set of tabs";
    protected $btTable = 'btTabberTabset';
    protected $btInterfaceWidth = "400";
    protected $btInterfaceHeight = "500";

    public function view()
    {
        $view = \View::getInstance();
        $view->requireAsset('javascript', 'underscore');
        $view->requireAsset('javascript', 'buttress/tabber');
        $view->requireAsset('css', 'buttress/tabber');

        $this->set(
            'template', <<<TEMPLATE
            <div class='buttress-test'>
                <ul class='top-tabs'>
                    <% _(tabset.getChildren()).each(function(tab) { %>
                        <li class='top-tab' data-id='<%= tab.getId() %>'>
                            <%- tab.getName() %>
                        </li>
                    <% }); %>
                </ul>
                <div class='bottom-tabs'>
                    <% _(tabset.getChildren()).each(function(tab) { %>
                        <div class='bottom-tab' data-id='<%= tab.getId() %>'>
                            <h3><%= tab.getName() %></h3>
                            <div class="tab-contents">
                                <%= tab.getPlaceholder() %>
                            </div>
                        </div>
                    <% }); %>
                </div>
            </div>
TEMPLATE
    );

        $this->set('name', 'derp');
    }

}
