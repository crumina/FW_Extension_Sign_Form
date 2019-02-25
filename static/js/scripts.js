"use strict";
var cruminaSignForm = {

    init: function () {
        this.addClassesToFormContainer();
        this.passwordEyeInit();
    },

    addClassesToFormContainer: function () {
        var $container = jQuery('#' + signFormConfig.selectors.formContainer);

        jQuery('.nav-tabs .nav-item .nav-link:first', $container).addClass('active');
        jQuery('.tab-content .tab-pane:first', $container).addClass('active');
    },

    passwordEyeInit: function () {
        var $eye = jQuery('.password-eye');

        $eye.on('click', function (event) {
            event.preventDefault();
            var $self = jQuery(this);

            var $input = $self.next('input');

            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');

                $self.addClass('fa-eye-slash');
                $self.removeClass('fa-eye');
            } else {
                $input.attr('type', 'password');
                $self.removeClass('fa-eye-slash');
                $self.addClass('fa-eye');
            }

        });

    }
};

jQuery(document).ready(function () {
    cruminaSignForm.init();
});

