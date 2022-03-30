// This should be a public side script.
// 1. Pass an value from devtest.php to this file, if that value is not empty, then the file will be executed.

// 2. Display an alert everytime a product is added to the cart. done

// 3. Prompt the user everytime an item is attempted to be removed from the cart. done
(() => {
    'use strict';

    

    if (devtest_options.devtest_script_enable == true && devtest_options.devtest_script_enable != undefined) {
        console.log("Options enabled");
        jQuery(function ($) {

            $('.remove').click(function (event) {
                if (!confirm('Are you sure you want to remove product?')) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            $('body').on('added_to_cart', function () {
                alert("Product added to cart!")
            });

        });
    }

})();
