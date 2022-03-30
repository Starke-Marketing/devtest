<?php

namespace DevTest;

class Admin
{
    public function init()
    {
        add_action('admin_menu', [ $this, 'add_menu_item'] );
    }

    function add_menu_item() {
        add_menu_page( 
            'Dev Test', 
            'DevTest', 
            'manage_options', 
            'devtest', 
            [ $this, 'show_menu_news' ]
        );
    }
    
    function show_menu_news () { ?>
        <h1>Hello World!</h1>
    <?php
    }
}
