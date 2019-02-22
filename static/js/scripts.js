"use strict";
var cruminaSignForm = {

    init: function () {
        this.addClassesToFormContainer();
    },

    addClassesToFormContainer: function () {
        var $container = jQuery('#' + signFormConfig.selectors.formContainer);

        jQuery('.nav-tabs .nav-item .nav-link:first', $container).addClass('active');
        jQuery('.tab-content .tab-pane:first', $container).addClass('active');
    }

};

jQuery(document).ready(function () {
    cruminaSignForm.init();
});

