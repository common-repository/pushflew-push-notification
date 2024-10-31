(function ($) {
    $(document).ready(function () {
        $("#pushflew_email_edit").click(function () {
            $("#pushflew_email_p").toggle();
            $("#pushflew_email_input").toggle();
            if ($(this).html() == "Edit") {
                $(this).html("Cancel");
            } else {
                $(this).html("Edit");
            }
        });
        $("#pushflew_email_confirm").click(function () {
            var email = "";
            if ($("#pushflew_email_edit").html() == "Edit") {
                email = $("#pushflew_email_p").html();
            } else if ($("#pushflew_email_edit").html() == "Cancel") {
                email = $("#pushflew_email_input").val();
            }
            var data = "action=pushflew_email_confirm&confirm_email=" + email;
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: data,
                success: function (response) {
                    html_arr = response.split('"');
                    $("#pushflew_info_alert").html(html_arr[1]);
                    $("#pushflew_info_alert").show();
                    $(".pushflew_info_text").html("");
                }
            });
        });

        /*======= Push confirmation schedule Date Picker =======*/
        var dateToday = new Date();
        $('#pf_send_noti_dtpick').datepicker({
            inline: true,
            showOtherMonths: true,
            dateFormat: 'yy-mm-dd',
            firstDay: 0,
            minDate: dateToday,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            onClose: function (selectedDate) {
                //jQuery("#date_to").datepicker("option", "minDate", selectedDate);
                //jQuery("#apenddate").datepicker("option", "minDate", selectedDate);
            }
        });
        /*======= Broadcast Image =======*/
        $('#pf_image_button').click(function () {
            var logo_imag = wp.media({
                title: 'Select Image',
                library: {type: 'image'},
                multiple: false,
                button: {text: 'Insert'}
            });

            logo_imag.on('select', function () {
                var logo_selection = logo_imag.state().get('selection').first().toJSON();

                $('#pf_image_url').val(logo_selection.url);
                $('#preview_image').attr('src', logo_selection.url);
                $('#pf_conf_pu_chro_img').attr('src', logo_selection.url);
                $('#pf_conf_pu_firefox_img').attr('src', logo_selection.url);
            });

            logo_imag.open();
        });

        /*======= Optinlist Welcome Notification Setting Image =======*/
        $('#pf_image_button_wel_set').click(function () {
            var logo_imag = wp.media({
                title: 'Select Image',
                library: {type: 'image'},
                multiple: false,
                button: {text: 'Insert'}
            });

            logo_imag.on('select', function () {
                var logo_selection = logo_imag.state().get('selection').first().toJSON();

                $('#pf_image_url1').val(logo_selection.url);
                $('#pf_preview_image_wel').attr('src', logo_selection.url);
            });

            logo_imag.open();
        });
        /*======= Optinlist General Setting Image =======*/
        $('#pf_image_button_gen_set').click(function () {
            var logo_imag = wp.media({
                title: 'Select Image',
                library: {type: 'image'},
                multiple: false,
                button: {text: 'Insert'}
            });

            logo_imag.on('select', function () {
                var logo_selection = logo_imag.state().get('selection').first().toJSON();

                $('#pf_image_url2').val(logo_selection.url);
                $('#pf_preview_image_gen').attr('src', logo_selection.url);
            });

            logo_imag.open();
        });
        /*======= Account Setting Image =======*/
        $('#pf_image_button_gen_set_ac').change(function () {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#pf_broadcast_form').validate({
            errorClass: "pf-errormassage",
            ignore: [],
            rules: {
                pf_title: {required: true, maxlength: 48},
                pf_message: {required: true, maxlength: 100},
                pf_landingURL: {required: true, url: true},
                pf_image_url: {required: true},
            },
            messages: {
                pf_title: {required: "Please Enter Title", maxlength: "Please enter no more than 48 characters"},
                pf_message: {required: "Please Enter Message", maxlength: "Please enter no more than 100 characters"},
                pf_landingURL: {required: "Please Enter Url", url: "Enter URL with http:// or https://"},
                pf_image_url: {required: "Please Select Image"},
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-group').find('div.pf-errormassage'));
            },
            submitHandler: function (form) {

                $('#pf_schedule_noti_model').css('display', 'block');

                /*======= Broadcast Notification Scheduleing screen =======*/
                $('.pf-send-noti-time').on('change', function (e) {
                    var optionSelected = $("option:selected", this);
                    var valueSelected = this.value;

                    if (valueSelected == "specificTime") {
                        $('.pf-schedule-broad').css('display', 'block');
                        $('.pf-send-immediate').css('display', 'none');
                    }
                    else if (valueSelected == "immediately") {
                        $('.pf-schedule-broad').css('display', 'none');
                        $('.pf-send-immediate').css('display', 'block');
                    }

                });

                $('#pf_send_brad_noti_immediate').click(function () {
                    $('#pf_schedule_noti_confirm_model').css('display', 'block');
                    $('#pf_schedule_noti_model').css('display', 'none');
                    $('#pf_notification_type_id').val($('#pf_send_noti_types').val());
                    /*======= Confirmation popup data =======*/
                    $(".pf-chrome-heading").text($('#pf_title').val());
                    $(".pf-fire-heading").text($('#pf_title').val());
                    $(".pf_conf_pu_on_click_url").text($('#pf_landingURL').val());
                    $(".pf_conf_pu_on_click_url").attr('href', $('#pf_landingURL').val());
                    $(".pf-chrome-message").text($('#pf_message').val());
                    $(".pf-fire-message").text($('#pf_message').val());

                });

                $('#pf_send_brad_noti_shedule').click(function () {
                    $('#pf_schedule_noti_model').css('display', 'none');
                    $('#pf_schedule_noti_confirm_model').css('display', 'block');
                    $('#pf_notification_type_id').val($('#pf_send_noti_types').val());
                    $('#pf_delivery_date_id').val($('#pf_send_noti_dtpick').val());
                    $('#pf_delivery_houre_id').val($('#pf_send_noti_dthoure').val());
                    $('#pf_delivery_minite_id').val($('#pf_send_noti_dttime').val());
                    $('#pf_delivery_ampm_id').val($('#pf_send_noti_dtampm').val());
                    /*======= Confirmation popup data =======*/
                    $(".pf-chrome-heading").text($('#pf_title').val());
                    $(".pf-fire-heading").text($('#pf_title').val());
                    $(".pf_conf_pu_on_click_url").text($('#pf_landingURL').val());
                    $(".pf_conf_pu_on_click_url").attr('href', $('#pf_landingURL').val());
                    $(".pf-chrome-message").text($('#pf_message').val());
                    $(".pf-fire-message").text($('#pf_message').val());
                });

                $('.pf-confi-edit-btn').click(function () {
                    $('#pf_schedule_noti_model').css('display', 'block');
                    $('#pf_schedule_noti_confirm_model').css('display', 'none');
                });


                $('#pf_send__confrm_brad_noti_immediate,.pf_send__confrm_brad_notification').click(function () {
                    $("#processingIndicator").show();
                    var currBtn = this;
                    $(currBtn).prop( "disabled", true );
                    var formData = new FormData(form);

                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: formData,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $("#processingIndicator").hide();
                            // $(currBtn).prop( "disabled", false );
                            $('#pf_schedule_noti_confirm_model').css('display', 'none');

                            if (data.success) {
                                $('#send_push_notification_alert').addClass("alert-success");

                            } else {
                                $('#send_push_notification_alert').addClass("alert-danger");
                            }
                            form.reset();
                            $('#send_push_notification_alert').show();
                            $('#send_push_notification_alert span').text(data.message);
                        },
                        error: function (data) {
                            $("#processingIndicator").hide();
                            // $(currBtn).prop( "disabled", false );
                        }
                    });
                });

            }
        });
        $('#optin_form').validate({
            errorClass: "pf-errormassage",
            ignore: [],
            rules: {
                optTitle: {required: true},
                reappearTime: {required: true},
                pfdelay: {required: true},
                pfscroll: {required: true},
                promptmessage_heading: {required: true},
                promptmessage_details: {required: true},
            },
            messages: {
                optTitle: {required: "Please Enter Title"},
                reappearTime: {required: "Please Enter Time"},
                pfdelay: {required: "Please Enter Delay"},
                pfscroll: {required: "Please Select Scroll"},
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-group').find('div.pf-errormassage'));
            },
            submitHandler: function (form) {
                $("#processingIndicator").show();
                var formData = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        $("#processingIndicator").hide();
                        if (data.success) {
                            // window.location.replace(data.redirect_url);
                        }
                        else
                            alert('Something Wrong. Try again.');
                    },
                    error: function (data) {
                        console.log(data);
                        $("#processingIndicator").hide();
                    }
                });

            }
        });

        /*======= Option Active/Deactive =======*/
        $(document).on("change", '.pf-optin-onoff', function (event) {
            var $this = $(this);
            if ($(this).is(':checked'))
                var pfoptin_enable = 1;
            else
                var pfoptin_enable = 0;

            $("#processingIndicator").show();
            var optinid = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'pf_optin_onoff',
                    type: pfoptin_enable,
                    optinid: optinid,
                },
                dataType: 'json',
                success: function (data) {
                    $("#processingIndicator").hide();
                    if (data.success) {
                        if (pfoptin_enable == 1) {
                            $this.prop("checked", true);
                            $this.parents('.pf-opt_status').find('.pf-status-text').text('Active');
                        } else {
                            $this.prop("checked", false);
                            $this.parents('.pf-opt_status').find('.pf-status-text').text('Deactivated');
                        }
                    } else {
                        if (pfoptin_enable == 1) {
                            $this.prop("checked", false);
                        } else {
                            $this.prop("checked", true);
                        }
                    }

                },
                error: function (data) {
                    $("#processingIndicator").hide();

                    if (pfoptin_enable == 1) {
                        $this.prop("checked", false);
                    } else {
                        $this.prop("checked", true);
                    }

                }
            });

        });

        $(document).on("click", '.pf_optin_active_dea', function (event) {
            var $this = $(this);
            var pfoptin_enable = $this.attr('data-type');
            var optinid = $(this).attr('data-id');
            $("#processingIndicator").show();

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'pf_optin_onoff',
                    type: pfoptin_enable,
                    optinid: optinid,
                },
                dataType: 'json',
                success: function (data) {
                    $("#processingIndicator").hide();
                    if (data.success) {
                        if (pfoptin_enable == 1) {
                            $this.parents('tr').find('.pf-optin-onoff').prop("checked", true);
                            $this.parents('tr').find('.pf-status-text').text('Active');
                        } else {
                            $this.parents('tr').find('.pf-optin-onoff').prop("checked", false);
                            $this.parents('tr').find('.pf-status-text').text('Deactivated');
                        }
                    } else {
                        if (pfoptin_enable == 1) {
                            $this.parents('tr').find('.pf-optin-onoff').prop("checked", false);
                        } else {
                            $this.parents('tr').find('.pf-optin-onoff').prop("checked", true);
                        }
                    }

                },
                error: function (data) {
                    $("#processingIndicator").hide();
                    if (pfoptin_enable == 1) {
                        $this.parents('tr').find('.pf-optin-onoff').prop("checked", false);
                    } else {
                        $this.parents('tr').find('.pf-optin-onoff').prop("checked", true);
                    }
                }
            });

        });

        /*======= Option Duplicate =======*/
        $(document).on("click", '.pf_optin_duplicate', function (event) {
            var $this = $(this);
            $("#processingIndicator").show();
            var optinid = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'pf_optin_duplicate',
                    optinid: optinid,
                },
                dataType: 'json',
                success: function (data) {
                    $("#processingIndicator").hide();
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Something Wrong. Please try again');
                    }
                },
                error: function (data) {
                    $("#processingIndicator").hide();
                    alert('Something Wrong. Please try again');
                }
            });

        });

        /*======= Option Delete =======*/
        $(document).on("click", '.pf_optin_delete', function (event) {
            var $this = $(this);
            $("#processingIndicator").show();
            var optinid = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    action: 'pf_optin_delete',
                    optinid: optinid,
                },
                dataType: 'json',
                success: function (data) {
                    $("#processingIndicator").hide();
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Something Wrong. Please try again');
                    }

                },
                error: function (data) {
                    $("#processingIndicator").hide();
                    alert('Something Wrong. Please try again');
                }
            });

        });

        $('#pf_broadcast_search').keyup(function () {
            broadcastsearchTable($(this).val());
        });

        /*======= Custom Modal Close =======*/
        $(".pf-modal-close").click(function () {
            $(".pf-cust-modal").css('display', 'none');
        });
        $(".pf-bck-btn").click(function () {
            $(".pf-cust-modal").css('display', 'none');
        });

        /*======= Customize Push Desktop View =======*/
        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".desktop-preview .pf-allow-btn").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_desk_btn_allow_bckgound').wpColorPicker(myOptions);

        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".desktop-preview .pf-not-now-btn").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_desk_btn_disallow_bckgound').wpColorPicker(myOptions);

        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".pf-customizable .desktop-preview #pf-push-dialog").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_desk_btn_optin_background').wpColorPicker(myOptions);


        $('#pf_noti_desk_btn_allow_bckgound, #pf_noti_desk_btn_disallow_bckgound,#pf_noti_desk_btn_optin_background').wpColorPicker();

        $("#pf_noti_desk_title").keyup(function () {
            $(".desktop-preview .pf-dialog-title").text($(this).val());
        });
        $("#pf_noti_desk_sub_title").keyup(function () {
            $(".desktop-preview .pf-dialog-subtitle").text($(this).val());
        });
        $("#pf_noti_desk_btn_allow_txt").keyup(function () {
            $(".desktop-preview .pf-allow-btn").text($(this).val());
        });
        $("#pf_noti_desk_btn_disallow_txt").keyup(function () {
            $(".desktop-preview .pf-not-now-btn").text($(this).val());
        });

        /*=======  Customize OPtin Preview Desktop Position =======*/
        $("select.pf-optin-postition").change(function () {
            var $selectedPosition = $(".pf-optin-postition option:selected").val();
            $(".pf-customizable .desktop-preview #pf-push-dialog").removeAttr('class');
            $(".pf-customizable .desktop-preview #pf-push-dialog").addClass('window');
            $(".pf-customizable .desktop-preview #pf-push-dialog").addClass($selectedPosition);
        });

        /*======= Customize Push Mobile View =======*/
        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".mobile-preview  .pf-allow-btn").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_mob_btn_allow_bckgound').wpColorPicker(myOptions);

        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".mobile-preview .pf-not-now-btn").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_mob_btn_disallow_bckgound').wpColorPicker(myOptions);

        var myOptions = {
            change: function (event, ui) {
                var color = ui.color.toString();

                $(".pf-customizable .mobile-preview #pf-push-dialog").css({'background': color, 'border': '1px solid', 'border-color': color});
            },
        };
        $('#pf_noti_mob_btn_optin_background').wpColorPicker(myOptions);


        $("#pf_noti_mob_title").keyup(function () {
            $(".mobile-preview .pf-dialog-title").text($(this).val());
        });
        $("#pf_noti_mob_sub_title").keyup(function () {
            $(".mobile-preview .pf-dialog-subtitle").text($(this).val());
        });
        $("#pf_noti_mob_btn_allow_txt").keyup(function () {
            $(".mobile-preview .pf-allow-btn").text($(this).val());
        });
        $("#pf_noti_mob_btn_disallow_txt").keyup(function () {
            $(".mobile-preview .pf-not-now-btn").text($(this).val());
        });
        /*======= Customize OPtin Preview Desktop Position =======*/
        $("select.pf-optin-postition-mobile").change(function () {
            var $selectedPosition = $(".pf-optin-postition-mobile option:selected").val();
            $(".mobile-preview #pf-push-dialog").removeAttr('class');
            $(".mobile-preview #pf-push-dialog").addClass('window');
            $(".mobile-preview #pf-push-dialog").addClass($selectedPosition);
        });

        /*======= Push Builder Display Event =======*/
        $('input[name="displayEvent"]').on("click", function () {
            if ($(this).hasClass("pf-displayEvent-delay")) {
                $('.pf-appear-scroll').removeClass('active');
                $('.pf-appear-delay').addClass('active');
            }
            else if ($(this).hasClass("pf-displayEvent-scroll")) {
                $('.pf-appear-delay').removeClass('active');
                $('.pf-appear-scroll').addClass('active');
            }
            else {
                $('.pf-appear-delay').removeClass('active');
                $('.pf-appear-scroll').removeClass('active');
            }
        });

        /*======= Optin List Action DropDown =======*/
        $(document).on("click", '.pf-action-btn', function (event) {
            event.stopPropagation();
            $(this).parent('.pf-opt-actions').find('.pf-dropdown-menu').slideToggle(200);
        });
        $(".pf-dropdown-menu").on("click", function (event) {
            event.stopPropagation();
        });

        /*======= Push Builder Tabs Call =======*/
        $(".fourth_tab").champ(); /*--- BLueLagoon ---*/
        $(".third_tab").champ(); /*--- ElectroLite ---*/
        $(".second_tab").champ(); /*--- Customizing ---*/

        $(".push_list_builder_tab").champ(); /*--- optinlist Page tab ---*/


        /*======= Push Builder Prompt Message =======*/
        $(".pf-prompt-example").click(function () {
            $("#pf-thankyou").css('display', 'block');
        });
        $(".pf-thank-You-PreviewClose").click(function () {
            $("#pf-thankyou").css('display', 'none');
        });
        $("#pf-prompt-title").keyup(function () {
            $(".pf-prompt-prevw-title").text($(this).val());
        });
        $("#pf-prompt-details").keyup(function () {
            $(".pf-prompt-prevw-details").text($(this).val());
        });

        /*======= OPtin Preview Full Window  =======*/
        $("#pf-full-window-prive").click(function () {
            $("#is_preview").val(1);
            $(".pf-push-dialog-bx").each(function () {
                $(this).hide();
            });
            var layout = $(this).attr('data-layout');

            if (layout == 'blueLagoon')
                $(".full-window.pf-bluelagoon #pf-push-dialog").slideDown();
            else if (layout == 'electrolite')
                $(".full-window.pf-electrolite #pf-push-dialog").slideDown();
            else
                $(".full-window.pf-customizable #pf-push-dialog").slideDown();
        });

        $(".full-window .pf-electro-allow-btn, .full-window .pf-bluelagoon-not-now-btn, .full-window .pf-allow-btn").click(function () {
            $("#is_preview").val(0);
            var layout = $("#pf-full-window-prive").attr('data-layout');
            if (layout == 'blueLagoon')
                $(".full-window.pf-bluelagoon #pf-push-dialog").slideUp();
            else if (layout == 'electrolite')
                $(".full-window.pf-electrolite #pf-push-dialog").slideUp();
            else
                $(".full-window.pf-customizable #pf-push-dialog").slideUp();
        });
        $(".first_tab ul li").click(function () {
            var layout = $(this).attr('data-layout');
            $("#pf-full-window-prive").attr('data-layout', layout);
            if ($("#is_preview").val() == 1) {
                $(".pf-push-dialog-bx").each(function () {
                    $(this).hide();
                });
                if (layout == 'blueLagoon')
                    $(".full-window.pf-bluelagoon #pf-push-dialog").slideDown();
                else if (layout == 'electrolite')
                    $(".full-window.pf-electrolite #pf-push-dialog").slideDown();
                else
                    $(".full-window.pf-customizable #pf-push-dialog").slideDown();
            }
        });
        $(".full-window .pf-electro-not-now-btn, .full-window .pf-bluelagoon-allow-btn, .full-window .pf-not-now-btn").click(function () {
            $("#is_preview").val(0);
            var layout = $("#pf-full-window-prive").attr('data-layout');
            if (layout == 'blueLagoon')
                $(".full-window.pf-bluelagoon #pf-push-dialog").slideUp();
            else if (layout == 'electrolite')
                $(".full-window.pf-electrolite #pf-push-dialog").slideUp();
            else
                $(".full-window.pf-customizable #pf-push-dialog").slideUp();
        });
        $("ul.pf-layout-types-tabs li").click(function () {
            var layout = $(this).attr('data-layout');
            $("#pf-full-window-prive").attr('data-layout', layout);
            $("#pf_requestlayout").val(layout);
            var currenttab = $(this).attr('rel');
            var settings_tab = $(this).parents('.req_layout_wrapper').find('div.' + currenttab + ' .pf-desktop-mobile-tab ul li.active').attr('data-setting');
            $("#pf-full-window-prive").attr('data-setting', settings_tab);
        });
        $(".pf-desktop-mobile-tab ul li").click(function () {
            var layout = $(this).attr('data-setting');
            $("#pf-full-window-prive").attr('data-setting', layout);
        });

        $("select.pf-optin-postition").change(function () {
            var $selectedPosition = $(".pf-optin-postition option:selected").val();
            $(".pf-customizable.full-window #pf-push-dialog").removeAttr('class');
            $(".pf-customizable.full-window #pf-push-dialog").addClass('window');
            $(".pf-customizable.full-window #pf-push-dialog").addClass($selectedPosition);
        });

        /*======= Electro - Desktop - OPtin Preview Full Window =======*/
        $("#pf_noti_electro_desk_title").keyup(function () {
            $(".desktop-preview .pf-dialog-electro-title").text($(this).val());
        });
        $("#pf_noti_electro_desk_sub_title").keyup(function () {
            $(".desktop-preview .pf-dialog-electro-subtitle").text($(this).val());
        });
        $("#pf_noti_electro_desk_btn_allow_txt").keyup(function () {
            $(".desktop-preview .pf-electro-allow-btn").text($(this).val());
        });
        $("#pf_noti_elctro_desk_btn_disallow_txt").keyup(function () {
            $(".desktop-preview .pf-electro-not-now-btn").text($(this).val());
        });

        /*======= Electro - Mobile - OPtin Preview Full Window =======*/
        $("#pf_noti_electro_mob_title").keyup(function () {
            $(".mobile-preview .pf-dialog-electro-title").text($(this).val());
        });
        $("#pf_noti_electro_mob_sub_title").keyup(function () {
            $(".mobile-preview .pf-dialog-electro-subtitle").text($(this).val());
        });
        $("#pf_noti_electro_mob_btn_allow_txt").keyup(function () {
            $(".mobile-preview .pf-electro-allow-btn").text($(this).val());
        });
        $("#pf_noti_electro_mob_btn_disallow_txt").keyup(function () {
            $(".mobile-preview .pf-electro-not-now-btn").text($(this).val());
        });

        /*======= bluelagoon - Desktop - OPtin Preview Full Window =======*/
        $("#pf_noti_bluelagoon_desk_title").keyup(function () {
            $(".desktop-preview .pf-dialog-bluelagoon-title").text($(this).val());
        });
        $("#pf_noti_bluelagoon_desk_sub_title").keyup(function () {
            $(".desktop-preview .pf-dialog-bluelagoon-subtitle").text($(this).val());
        });
        $("#pf_noti_bluelagoon_desk_btn_allow_txt").keyup(function () {
            $(".desktop-preview .pf-bluelagoon-allow-btn").text($(this).val());
        });
        $("#pf_noti_bluelagoon_desk_btn_disallow_txt").keyup(function () {
            $(".desktop-preview .pf-bluelagoon-not-now-btn").text($(this).val());
        });

        /*======= bluelagoon - Mobile - OPtin Preview Full Window =======*/
        $("#pf_noti_bluelagoon_mob_title").keyup(function () {
            $(".mobile-preview .pf-dialog-bluelagoon-title").text($(this).val());
        });
        $("#pf_noti_bluelagoon_mob_sub_title").keyup(function () {
            $(".mobile-preview .pf-dialog-bluelagoon-subtitle").text($(this).val());
        });
        $("#pf_noti_bluelagoon_mob_btn_allow_txt").keyup(function () {
            $(".mobile-preview .pf-bluelagoon-allow-btn").text($(this).val());
        });
        $("#pf_noti_bluelagoon_mob_btn_disallow_txt").keyup(function () {
            $(".mobile-preview .pf-bluelagoon-not-now-btn").text($(this).val());
        });
    });
}(jQuery));

function broadcastsearchTable(inputVal)
{
    var table = jQuery('.pf-campaigns-listing table');
    table.find('tr').each(function (index, row)
    {
        var allCells = jQuery(row).find('td .float-my-children');
        if (allCells.length > 0)
        {
            var found = false;
            allCells.each(function (index, td)
            {
                var regExp = new RegExp(inputVal, 'i');
                if (regExp.test(jQuery(td).text()))
                {
                    found = true;
                    return false;
                }
            });

            if (found == true)
                jQuery(row).show();
            else
                jQuery(row).hide();
        }
    });
}
function imageIsLoaded(e) {
	$('#pf_preview_image_gen').attr('src', e.target.result);
}


/*----------- Subscribers List ----------*/
function push_Susbcriptions(size) {
	var size = '10';
	var page = '1';
	jQuery("#processingIndicator").show();
	jQuery.ajax({
		type: 'POST',
		url: ajaxurl,
		data: {
			action: 'push_Susbcriptions', 
			size: size, 
			page: page, 
		},
		dataType: 'json',
		success: function (data) {
			jQuery("#processingIndicator").hide();
            if (data.success) {
				jQuery('.pf-subscribe-list-content table tbody').html(data.data);
				jQuery('#pf_pagination').html(data.pagination);
				jQuery("#total_records").val(data.total_record);
				jQuery("#head_total_records").html(data.total_record);
				jQuery(".pf-totatl-subscriber span").html(data.total_record);
				
			} else {
				jQuery('.pf-subscribe-list-content table tbody').html(data.data);
				jQuery('#pf_pagination').html('');
}
		},
		error: function (data) {
			jQuery("#processingIndicator").hide();
			jQuery('#pf_pagination').html('');
		}
});

}
push_Susbcriptions();