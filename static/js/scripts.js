"use strict";
var cruminaSignForm = {

    init: function () {
        this.addClassesToFormContainer();
        this.passwordEyeInit();
        this.signAjax.init();
    },

    addClassesToFormContainer: function () {
        var $container = jQuery('.' + signFormConfig.selectors.formContainer);

        $container.each(function () {
            var $self = jQuery(this);

            jQuery('.nav-tabs .nav-item .nav-link:first', $self).addClass('active');
            jQuery('.tab-content .tab-pane:first', $self).addClass('active');
        });

        $container.addClass('visible');
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

    },

    signAjax: {
        $forms: null,

        init: function () {
            this.$forms = jQuery('.' + signFormConfig.selectors.formLogin + ', .' + signFormConfig.selectors.formRegister);

            this.addEventListeners();
        },

        addEventListeners: function () {
            var _this = this;

            this.$forms.each(function () {

                jQuery(this).on('submit', function (event) {
                    event.preventDefault();
                    _this.sign(jQuery(this));
                });
            });

        },

        sign: function ($form) {
            var handler = $form.data('handler');

            if (!handler) {
                return;
            }

            var prepared = {
                action: signFormConfig.actions.sign
            };

            var data = $form.serializeArray();

            data.forEach(function (item) {
                prepared[item.name] = item.value;
            });

            jQuery.ajax({
                url: signFormConfig.ajaxUrl,
                dataType: 'json',
                type: 'POST',
                data: prepared,

                beforeSend: function () {
                    jQuery(document.body).removeClass('loading');
                },
                success: function (response) {
                    if (!response.success) {



                        return;
                    }

                    location.reload();
                },
                error: function (jqXHR, textStatus) {
                    alert(textStatus);
                },
                complete: function () {
                    jQuery(document.body).removeClass('loading');
                }
            });
        }

    }


};

jQuery(document).ready(function () {
    cruminaSignForm.init();
});

