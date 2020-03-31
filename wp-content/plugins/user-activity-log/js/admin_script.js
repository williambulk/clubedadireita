jQuery(document).ready(function () {
    // deactivation popup code
    var ual_plugin_admin = jQuery('.documentation_ual_plugin').closest('div').find('.deactivate').find('a');
    ual_plugin_admin.click(function (event) {
        event.preventDefault();
        jQuery('#deactivation_thickbox_ual').trigger('click');
        jQuery('#TB_window').removeClass('thickbox-loading');
        change_thickbox_size_ual();
    });
    checkOtherDeactivate();
    jQuery('.sol_deactivation_reasons').click(function () {
        checkOtherDeactivate();
    });
    jQuery('#sbtDeactivationFormCloseual').click(function (event) {
        event.preventDefault();
        jQuery("#TB_closeWindowButton").trigger('click');
    });

    jQuery('.ual-deactivation').on('click', function() {
        window.location.href = ual_plugin_admin.attr('href');
    });

    jQuery('script').each(function () {
        var src = jQuery(this).attr('src');
        if (typeof src !== typeof undefined && src !== false) {
            if (src.search('bootstrap.js') !== -1 || src.search('bootstrap.min.js') !== -1) {
                if (jQuery.fn.button.noConflict) {
                    var bootstrapButton = jQuery.fn.button.noConflict();
                    jQuery.fn.bootstrapBtn = bootstrapButton;
                }
            }
        }
    });
    jQuery('#ualUserSettings .ual-check-user input').click(function () {
        jQuery('.ual-overlay').show();
        var type = 'role';
        var value = '';
        var selected = 'false';
        type = jQuery('.user_role').val();
        value = jQuery(this).val();
        if (jQuery(this).is(':checked')) {
            selected = 'true';
        } else {
            selected = 'false';
        }
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'ualEnableUserForNotification',
                type: type,
                value: value,
                selected: selected
            },
            success: function (data) {
                console.log(data);
                jQuery('.ual-overlay').hide();
            },
        });
    });

    if (jQuery('form.sol-form input[name="emailEnable"]:checked').val() == 0) {
        jQuery('form.sol-form .ui-button.ui-corner-right').addClass('active');
        jQuery('form.sol-form .ui-button.ui-corner-left').removeClass('active');
    } else {
        jQuery('form.sol-form .ui-button.ui-corner-left').addClass('active');
        jQuery('form.sol-form .ui-button.ui-corner-right').removeClass('active');
    }

    jQuery('form.sol-form input[name="emailEnable"]').click(function () {
        if (jQuery('form.sol-form input[name="emailEnable"]:checked').val() == 0) {
            jQuery('form.sol-form .ui-button.ui-corner-right').addClass('active');
            jQuery('form.sol-form .ui-button.ui-corner-left').removeClass('active');
        } else {
            jQuery('form.sol-form .ui-button.ui-corner-left').addClass('active');
            jQuery('form.sol-form .ui-button.ui-corner-right').removeClass('active');
        }
    });

    //settings tab script
    if (window.localStorage.getItem("lasttab") == null ||
        (window.localStorage.getItem("lasttab") != 'ualGeneralSettings' &&
            window.localStorage.getItem("lasttab") != 'ualUserSettings' &&
            window.localStorage.getItem("lasttab") != 'ualEmailSettings')) {
        jQuery('.ualParentTabs .nav-tab-wrapper a.nav-tab').removeClass('nav-tab-active');
        jQuery('.ualParentTabs .nav-tab-wrapper a.nav-tab.ualUserSettings').addClass('nav-tab-active');
        jQuery('.ualpContentDiv').hide();
        jQuery('#ualUserSettings.ualpContentDiv').show();
        jQuery('#ualUserSettings.ualpContentDiv').css('display', 'block');
    } else {
        jQuery('.ualParentTabs .nav-tab-wrapper a').removeClass('nav-tab-active');
        jQuery('.' + window.localStorage.getItem("lasttab")).addClass('nav-tab-active');
        jQuery('.ualpContentDiv').hide();
        jQuery('#' + window.localStorage.getItem("lasttab")).css('display', 'block');
        jQuery('.ualpContentDiv#' + window.localStorage.getItem("lasttab")).show();
    }
    jQuery('.ualParentTabs .nav-tab-wrapper a').not(".ual-pro-feature").click(function (e) {
        e.preventDefault();
        jQuery('.ualpAdminNotice.is-dismissible').hide();
        var this_tab = jQuery(this);
        var data_href = jQuery(this).attr('data-href');
        jQuery('.ualpContentDiv').hide();
        jQuery('#' + data_href).show();
        jQuery('.nav-tab-wrapper a.nav-tab').removeClass('nav-tab-active');
        this_tab.addClass('nav-tab-active');
        if (window.localStorage) {
            window.localStorage.setItem("lasttab", data_href);
        }
    });

    // Enable email notification start
    if (jQuery('.sol-email-table input[name="emailEnable"]:checked').val() == 0) {
        jQuery('.sol-email-table .fromEmailTr,.sol-email-table .toEmailTr,.sol-email-table .messageTr').hide();
    } else {
        jQuery('.sol-email-table .fromEmailTr,.sol-email-table .toEmailTr,.sol-email-table .messageTr').show();
    }
    jQuery('.sol-email-table input[name="emailEnable"]').click(function () {
        if (jQuery('.sol-email-table input[name="emailEnable"]:checked').val() == 0) {
            jQuery('.sol-email-table .fromEmailTr,.sol-email-table .toEmailTr,.sol-email-table .messageTr').hide();
        } else {
            jQuery('.sol-email-table .fromEmailTr,.sol-email-table .toEmailTr,.sol-email-table .messageTr').show();
        }
    });
    // Enable email notification end

    jQuery('.ual-pro-feature').on('click', function (e) {
        e.preventDefault();
        jQuery("#ual-advertisement-popup").dialog({
            resizable: false,
            draggable: false,
            modal: true,
            height: "auto",
            width: 'auto',
            maxWidth: '100%',
            dialogClass: 'ual-advertisement-ui-dialog',
            buttons: [
                {
                    text: 'x',
                    "class": 'ual-btn ual-btn-gray',
                    click: function () {
                        jQuery(this).dialog("close");
                    }
                }
            ],
            open: function (event, ui) {
                jQuery(this).parent().children('.ui-dialog-titlebar').hide();
                jQuery('.ui-widget-overlay').bind('click', function () {
                    jQuery("#ual-advertisement-popup").dialog('close');
                });
            },
            hide: {
                effect: "fadeOut",
                duration: 500
            },
            close: function (event, ui) {
                jQuery("#ual-advertisement-popup").dialog('close');
            },
        });
    });
});

function ual_show_hide_permission() {
    jQuery('.ual_permission_cover').slideToggle();
}

function ual_submit_optin(options) {
    result = {};
    result.action = 'ual_submit_optin';
    result.email = jQuery('#ual_admin_email').val();
    result.type = options;

    if (options == 'submit') {
        if (jQuery('input#ual_agree_gdpr').is(':checked')) {
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: result,
                error: function () { },
                success: function () {
                    window.location.href = "admin.php?page=user_action_log";
                },
                complete: function () {
                    window.location.href = "admin.php?page=user_action_log";
                }
            });
        }
        else {
            jQuery('.ual_agree_gdpr_lbl').css('color', '#ff0000');
        }
    }
    else if (options == 'deactivate') {
        if (jQuery('input#ual_agree_gdpr_deactivate').is(':checked')) {
            var ual_plugin_admin = jQuery('.documentation_ual_plugin').closest('div').find('.deactivate').find('a');
            result.selected_option_de = jQuery('input[name=sol_deactivation_reasons_ual]:checked', '#frmDeactivationual').val();
            result.selected_option_de_id = jQuery('input[name=sol_deactivation_reasons_ual]:checked', '#frmDeactivationual').attr("id");
            result.selected_option_de_text = jQuery("label[for='" + result.selected_option_de_id + "']").text();
            result.selected_option_de_other = jQuery('.sol_deactivation_reason_other_ual').val();
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: result,
                error: function () { },
                success: function () {
                    window.location.href = ual_plugin_admin.attr('href');
                },
                complete: function () {
                    window.location.href = ual_plugin_admin.attr('href');
                }
            });
        }
        else {
            jQuery('.ual_agree_gdpr_lbl').css('color', '#ff0000');
        }
    }
    else {
        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: result,
            error: function () { },
            success: function () {
                window.location.href = "admin.php?page=user_action_log";
            },
            complete: function () {
                window.location.href = "admin.php?page=user_action_log";
            }
        });
    }
}

function change_thickbox_size_ual() {
    jQuery(document).find('#TB_window').width('700').height('auto').css('margin-left', -700 / 2);
    jQuery(document).find('#TB_ajaxContent').width('640').height('auto');
    var doc_height = jQuery(window).height();
    var doc_space = doc_height - 500;
    if (doc_space > 0) {
        jQuery(document).find('#TB_window').css('margin-top', doc_space / 2);
    }
}

function checkOtherDeactivate() {
    var selected_option_de = jQuery('input[name=sol_deactivation_reasons_ual]:checked', '#frmDeactivationual').val();
    if (selected_option_de == '7') {
        jQuery('.sol_deactivation_reason_other_ual').val('');
        jQuery('.sol_deactivation_reason_other_ual').show();
    }
    else {
        jQuery('.sol_deactivation_reason_other_ual').val('');
        jQuery('.sol_deactivation_reason_other_ual').hide();
    }
}

jQuery(window).resize(function (){
    change_thickbox_size_ual();
    jQuery(document).find('#TB_ajaxContent').width('640').height('calc(100% - 50px)');
});