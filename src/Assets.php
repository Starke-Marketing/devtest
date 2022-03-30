<?php

namespace DevTest;

class Assets {

    private const SCRIPT_ENABLE = true;

    public function init() {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

    }

    function enqueue_scripts() {
        
        wp_enqueue_script( 'devtest-script', DEVTEST_PLUGIN_URL . 'client/js/devtest.js', [] );

        $devtestOptions = [ 'devtest_script_enable' => self::SCRIPT_ENABLE ];

		wp_localize_script('devtest-script', 'devtest_options', $devtestOptions);
    }

}