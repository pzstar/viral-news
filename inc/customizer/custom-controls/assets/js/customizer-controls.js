jQuery(document).ready(function ($) {
    'use strict';

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    // Select Preloader
    $('.ht--preloader-selector').on('change', function () {
        var activePreloader = $(this).val();
        $(this).next('.ht--preloader-container').find('.ht--preloader').hide();
        $(this).next('.ht--preloader-container').find('.ht--' + activePreloader).show();
    });

    // Icon Control JS
    $('body').on('click', '.ht--icon-box-wrap .ht--icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.ht--icon-box').find('.ht--icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.ht--icon-box').prev('.ht--selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.ht--icon-box').slideUp()
        $(this).closest('.ht--icon-box').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.ht--icon-box-wrap .ht--selected-icon', function () {
        if (!$(this).next().is('.ht--icon-box')) {
            var iconbox = $('#ht--icon-box').clone();
            iconbox.removeAttr('id');
            iconbox.insertAfter($(this));
        }
        $(this).next().slideToggle();
    });

    $('body').on('change', '.ht--icon-box-wrap .ht--icon-search select', function () {
        var $ele = $(this);
        var selected = $ele.val();
        $ele.parent('.ht--icon-search').siblings('.ht--icon-list').hide().removeClass('active');
        $ele.parent('.ht--icon-search').siblings('.' + selected).show().addClass('active');
        $ele.closest('.ht--icon-box').find('.ht--icon-search-input').val('');
        $ele.parent('.ht--icon-search').siblings('.' + selected).find('li').show();
    });

    $('body').on('keyup', '.ht--icon-box-wrap .ht--icon-search input', function (e) {
        var $input = $(this);
        var keyword = $input.val().toLowerCase();
        var search_criteria = $input.closest('.ht--icon-box').find('.ht--icon-list.active i');
        delay(function () {
            $(search_criteria).each(function () {
                if ($(this).attr('class').indexOf(keyword) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }, 500);
    });

    // Switch Control
    $('body').on('click', '.ht--switch', function () {
        var $this = $(this);
        if ($this.hasClass('ht--switch-on')) {
            $(this).removeClass('ht--switch-on');
            $this.next('input').val('off').trigger('change');
        } else {
            $(this).addClass('ht--switch-on');
            $this.next('input').val('on').trigger('change');
        }
    });

    // MultiCheck box Control JS
    $('.customize-control-ht--checkbox-multiple input[type="checkbox"]').on('change', function () {
        var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get().join(',');
        $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');
    });

    // Chosen JS
    $('.ht--chosen-select').chosen({
        width: '100%'
    });

    // Selectize JS
    $(".ht--selectize").selectize({
        plugins: ['remove_button', 'drag_drop'],
        delimiter: ',',
        persist: false
    });

    // Image Selector JS
    $('body').on('click', '.ht--selector-labels label', function () {
        var $this = $(this);
        var value = $this.attr('data-val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.ht--selector-labels').next('input').val(value).trigger('change');
    });

    // Range JS
    $('.ht--range-slider-control-wrap').each(function () {
        var input = $(this).find('input');
        var sliderValue = input.val();
        var newSlider = $(this).find('.ht--range-slider');
        var sliderMinValue = parseFloat(input.attr('min'));
        var sliderMaxValue = parseFloat(input.attr('max'));
        var sliderStepValue = parseFloat(input.attr('step'));
        newSlider.slider({
            value: sliderValue,
            min: sliderMinValue,
            max: sliderMaxValue,
            step: sliderStepValue,
            range: 'min',
            slide: function (e, ui) {
                input.val(ui.value).trigger('change');
            },
            change: function (e, ui) {
                input.trigger('change');
            }
        });
    })

    // Update slider if the input field loses focus as it's most likely changed
    $('.ht--range-slider-control-wrap input').blur(function () {
        var resetValue = isNaN($(this).val()) ? '' : $(this).val();

        if (resetValue) {
            var sliderMinValue = parseFloat($(this).attr('min'));
            var sliderMaxValue = parseFloat($(this).attr('max'));
            // Make sure our manual input value doesn't exceed the minimum & maxmium values
            if (resetValue < sliderMinValue) {
                resetValue = sliderMinValue;
            }
            if (resetValue > sliderMaxValue) {
                resetValue = sliderMaxValue;
            }
        }
        $(this).val(resetValue);
        $(this).closest('.ht--range-slider-control-wrap').find('.ht--range-slider').slider('value', resetValue);
    });

    // Reset slider and input field back to the default value
    $('.ht--slider-reset').on('click', function () {
        var resetValue = $(this).attr('slider-reset-value');
        $(this).parents('.customize-control-ht--range-slider').find('input').val(resetValue);
        $(this).parents('.customize-control-ht--range-slider').find('.ht--range-slider').slider('value', resetValue);
    });

    // TinyMCE Editor
    $(document).on('tinymce-editor-init', function () {
        $('.customize-control').find('.wp-editor-area').each(function () {
            var tArea = $(this),
                id = tArea.attr('id'),
                input = $('input[data-customize-setting-link="' + id + '"]'),
                editor = tinyMCE.get(id),
                content;
            if (editor) {
                editor.onChange.add(function () {
                    this.save();
                    content = editor.getContent();
                    input.val(content).trigger('change');
                });
            }
            tArea.css({
                visibility: 'visible'
            }).on('keyup', function () {
                content = tArea.val();
                input.val(content).trigger('change');
            });
        });
    });

    // Select Image
    $('.ht--image-selector').on('change', function () {
        var activeImage = $(this).find(':selected').attr('data-image');
        $(this).next('.ht--image-container').find('img').attr('src', activeImage);
    });

    // Date Picker
    $('.ht--datepicker').datepicker({
        dateFormat: 'yy/mm/dd'
    });

    // Color Tab
    $('.ht--color-tab-toggle').on('click', function () {
        $(this).closest('.customize-control').find('.ht--color-tab-wrap').slideToggle();
    });

    $('.ht--color-tab-switchers li').on('click', function () {
        if ($(this).hasClass('active')) {
            return false;
        }
        var clicked = $(this).attr('data-tab');
        $(this).parent('.ht--color-tab-switchers').find('li').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.ht--color-tab-wrap').find('.ht--color-tab-contents > div').hide();
        $(this).closest('.ht--color-tab-wrap').find('.' + clicked).fadeIn();
    });

    $('.ht--border-color .ht--color-picker-hex').wpColorPicker({
        change: function (event, ui) {
            var setting = $(this).attr('data-customize-setting-link');
            var hexcolor = $(this).wpColorPicker('color');
            // Set the new value.
            wp.customize(setting, function (obj) {
                obj.set(hexcolor);
            });
        },
        clear: function (event) {
            var element = $(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
            if (element) {
                var setting = $(element).attr('data-customize-setting-link');
                wp.customize(setting, function (obj) {
                    obj.set('');
                });
            }
        }
    });

    $('.ht--box-shadow-color .ht--color-picker-hex').wpColorPicker({
        change: function (event, ui) {
            var setting = $(this).attr('data-customize-setting-link');
            var hexcolor = $(this).wpColorPicker('color');
            // Set the new value.
            wp.customize(setting, function (obj) {
                obj.set(hexcolor);
            });
        },
        clear: function (event) {
            var element = $(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
            if (element) {
                var setting = $(element).attr('data-customize-setting-link');
                wp.customize(setting, function (obj) {
                    obj.set('');
                });
            }
        }
    });

    //Gallery Control
    $('.ht--gallery-button').click(function (e) {
        e.preventDefault();

        var button = $(this);
        var galleryContainer = button.siblings('ul.ht--gallery-container');
        var hiddenfield = button.prev();
        if (hiddenfield.val()) {
            var hiddenfieldvalue = hiddenfield.val().split(",");
        } else {
            var hiddenfieldvalue = new Array();
        }

        var frame = wp.media({
            title: 'Insert Images',
            library: {
                type: 'image',
                post__not_in: hiddenfieldvalue
            },
            button: {text: 'Use Images'},
            multiple: 'add'
        });

        frame.on('select', function () {
            var attachments = frame.state().get('selection').map(function (a) {
                a.toJSON();
                return a;
            });
            var i;
            /* loop through all the images */
            for (i = 0; i < attachments.length; ++i) {
                /* add HTML element with an image */
                galleryContainer.append('<li data-id="' + attachments[i].id + '"><span style="background-image:url(' + attachments[i].attributes.url + ')"></span><a href="#" class="ht--gallery-remove">×</a></li>');
                /* add an image ID to the array of all images */
                hiddenfieldvalue.push(attachments[i].id);
            }
            /* refresh sortable */
            galleryContainer.sortable("refresh");
            /* add the IDs to the hidden field value */
            hiddenfield.val(hiddenfieldvalue.join()).trigger('change');
        }).open();
    });

    $('ul.ht--gallery-container').sortable({
        items: 'li',
        cursor: '-webkit-grabbing', /* mouse cursor */
        stop: function (event, ui) {
            ui.item.removeAttr('style');

            var sort = new Array(), /* array of image IDs */
                gallery = $(this); /* ul.ht--gallery-container */

            /* each time after dragging we resort our array */
            gallery.find('li').each(function (index) {
                sort.push($(this).attr('data-id'));
            });
            /* add the array value to the hidden input field */
            gallery.next().val(sort.join()).trigger('change');
        }
    });

    //Remove certain images
    $('body').on('click', '.ht--gallery-remove', function () {
        var id = $(this).parent().attr('data-id'),
            gallery = $(this).parent().parent(),
            hiddenfield = gallery.next(),
            hiddenfieldvalue = hiddenfield.val().split(","),
            i = hiddenfieldvalue.indexOf(id);

        $(this).parent().remove();

        /* remove certain array element */
        if (i != -1) {
            hiddenfieldvalue.splice(i, 1);
        }

        /* add the IDs to the hidden field value */
        hiddenfield.val(hiddenfieldvalue.join()).trigger('change');

        /* refresh sortable */
        gallery.sortable("refresh");

        return false;
    });

    // Scroll to Footer - add scroll to header as well
    $('.customize-control-ht--repeater').on('click', '#accordion-section-footer_section .accordion-section-title', function (event) {
        var preview_section_id = 'ht--colophon';
        var $contents = jQuery('#customize-preview iframe').contents();
        if ($contents.find('#' + preview_section_id).length > 0) {
            $contents.find('html, body').animate({
                scrollTop: $contents.find('#' + preview_section_id).offset().top
            }, 1000);
        }
    });

    // Repeater Fields
    $('.customize-control-ht--repeater').on('click', '.ht--repeater-field-title', function () {
        $(this).next().slideToggle();
        $(this).closest('.ht--repeater-field-control').toggleClass('expanded');
    });

    $('.customize-control-ht--repeater').on('click', '.ht--repeater-field-close', function () {
        $(this).closest('.ht--repeater-fields').slideUp();
        $(this).closest('.ht--repeater-field-control').toggleClass('expanded');
    });

    $('.customize-control-ht--repeater').on('click', '.ht--add-control-field', function () {
        var $this = $(this).parent();
        if (typeof $this != 'undefined') {
            var field = $this.find('.ht--repeater-field-control:first').clone();
            if (typeof field != 'undefined') {
                field.find('input[type="text"][data-name]').each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                field.find('textarea[data-name]').each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                field.find('select[data-name]').each(function () {
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                field.find('.radio-labels input[type="radio"]').each(function () {
                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                    $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);
                    if ($(this).val() == defaultValue) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
                field.find('.ht--type-checkbox input[type="checkbox"]').each(function () {
                    var defaultValue = $(this).attr('data-default');
                    if ($(this).val() == defaultValue) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
                field.find('.ht--selector-labels label').each(function () {
                    var defaultValue = $(this).closest('.ht--selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.ht--selector-labels').next('input[data-name]').val(defaultValue);
                    if (defaultValue == dataVal) {
                        $(this).addClass('selector-selected');
                    } else {
                        $(this).removeClass('selector-selected');
                    }
                });
                field.find('.ht--range-slider-control-wrap').each(function () {
                    var input = $(this).find('input');
                    var newSlider = $(this).find('.ht--range-slider');
                    newSlider.removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all').empty();
                    var sliderValue = parseFloat(newSlider.attr('data-default'));
                    input.val(sliderValue);
                    var sliderMinValue = parseFloat(input.attr('min'));
                    var sliderMaxValue = parseFloat(input.attr('max'));
                    var sliderStepValue = parseFloat(input.attr('step'));
                    newSlider.slider({
                        value: sliderValue,
                        min: sliderMinValue,
                        max: sliderMaxValue,
                        step: sliderStepValue,
                        range: 'min',
                        slide: function (e, ui) {
                            input.val(ui.value);
                            refresh_repeater_values();
                        }
                    });
                });
                field.find('.ht--onoffswitch').each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    if (defaultValue == 'on') {
                        $(this).addClass('ht--switch-on');
                    } else {
                        $(this).removeClass('ht--switch-on');
                    }
                });
                field.find('.ht--toggle').each(function () {
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if (defaultValue == 'yes') {
                        $(this).find('.ht--onoff-switch-label').addClass('ht--toggle-on');
                    } else {
                        $(this).find('.ht--onoff-switch-label').removeClass('ht--toggle-on');
                    }
                });
                field.find('.ht--color-picker').each(function () {
                    $colorPicker = $(this);
                    $colorPicker.closest('.wp-picker-container').after($(this));
                    $colorPicker.prev('.wp-picker-container').remove();
                    $(this).wpColorPicker({
                        change: function (event, ui) {
                            setTimeout(function () {
                                refresh_repeater_values();
                            }, 100);
                        },
                        clear: function (event, ui) {
                            setTimeout(function () {
                                refresh_repeater_values();
                            }, 100);
                        }
                    });
                });
                field.find('.attachment-media-view').each(function () {
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if (defaultValue) {
                        $(this).find('.thumbnail-image').html('<img src="' + defaultValue + '"/>').prev('.placeholder').addClass('hidden');
                    } else {
                        $(this).find('.thumbnail-image').html('').prev('.placeholder').removeClass('hidden');
                    }
                });
                field.find('.ht--icon-box').each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.ht--selected-icon').children('i').attr('class', '').addClass(defaultValue);
                    $(this).find('li').each(function () {
                        var icon_class = $(this).find('i').attr('class');
                        if (defaultValue == icon_class) {
                            $(this).addClass('icon-active');
                        } else {
                            $(this).removeClass('icon-active');
                        }
                    });
                });
                field.find('.ht--multi-category-list').each(function () {
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).find('input[type="checkbox"]').each(function () {
                        if ($(this).val() == defaultValue) {
                            $(this).prop('checked', true);
                        } else {
                            $(this).prop('checked', false);
                        }
                    });
                });
                //field.find('.ht--fields').show();
                $this.find('.ht--repeater-field-control-wrap').append(field);
                field.addClass('expanded').find('.ht--repeater-fields').show();
                $('.accordion-section-content').animate({
                    scrollTop: $this.height()
                }, 1000);
                refresh_repeater_values();
            }
        }
        return false;
    });

    $('.customize-control-ht--repeater').on('click', '.ht--repeater-field-remove', function () {
        if (typeof $(this).parent() != 'undefined') {
            $(this).closest('.ht--repeater-field-control').slideUp('normal', function () {
                $(this).remove();
                refresh_repeater_values();
            });
        }
        return false;
    });

    $('.customize-control-ht--repeater').on('keyup change', '[data-name]', function () {
        delay(function () {
            refresh_repeater_values();
            return false;
        }, 500);
    });

    $('.customize-control-ht--repeater').on('change', 'input[type="checkbox"][data-name]', function () {
        if ($(this).is(':checked')) {
            $(this).val('yes');
            $(this).parent('label').addClass('ht--toggle-on');
        } else {
            $(this).val('no');
            $(this).parent('label').removeClass('ht--toggle-on');
        }
        return false;
    });

    // Drag and drop to change order
    $('.ht--repeater-field-control-wrap').sortable({
        orientation: 'vertical',
        handle: '.ht--repeater-field-title',
        update: function (event, ui) {
            refresh_repeater_values();
        }
    });

    // Set all variables to be used in scope
    var frame;
    // ADD IMAGE LINK
    $('.customize-control-ht--repeater').on('click', '.ht--upload-button', function (event) {
        event.preventDefault();
        var imgContainer = $(this).closest('.ht--fields-wrap').find('.thumbnail-image'),
            placeholder = $(this).closest('.ht--fields-wrap').find('.placeholder'),
            imgIdInput = $(this).siblings('.upload-id');
        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use Image'
            },
            multiple: false // Set to true to allow multiple files to be selected
        });
        // When an image is selected in the media frame...
        frame.on('select', function () {
            // Get media attachment details from the frame state
            var attachment = frame.state().get('selection').first().toJSON();
            // Send the attachment URL to our custom image input field.
            imgContainer.html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            placeholder.addClass('hidden');
            // Send the attachment id to our hidden input
            imgIdInput.val(attachment.url).trigger('change');
        });
        // Finally, open the modal on click
        frame.open();
    });

    // DELETE IMAGE LINK
    $('.customize-control-ht--repeater').on('click', '.ht--delete-button', function (event) {
        event.preventDefault();
        var imgContainer = $(this).closest('.ht--fields-wrap').find('.thumbnail-image'),
            placeholder = $(this).closest('.ht--fields-wrap').find('.placeholder'),
            imgIdInput = $(this).siblings('.upload-id');
        // Clear out the preview image
        imgContainer.find('img').remove();
        placeholder.removeClass('hidden');
        // Delete the image id from the hidden input
        imgIdInput.val('').trigger('change');
    });

    var ColorChange = false;
    $('.customize-control-ht--repeater .ht--color-picker').wpColorPicker({
        change: function (event, ui) {
            refresh_repeater_values();
        },
        clear: function (event, ui) {
            refresh_repeater_values();
        }
    });
    ColorChange = true;

    //MultiCheck box Control JS
    $('.customize-control-ht--repeater').on('change', '.ht--type-multicategory input[type="checkbox"]', function () {
        var checkbox_values = $(this).parents('.ht--type-multicategory').find('input[type="checkbox"]:checked').map(function () {
            return $(this).val();
        }).get().join(',');
        $(this).parents('.ht--type-multicategory').find('input[type="hidden"]').val(checkbox_values).trigger('change');
        refresh_repeater_values();
    });

    function refresh_repeater_values() {
        $('.control-section.open .ht--repeater-field-control-wrap').each(function () {
            var values = [];
            var $this = $(this);

            $this.find('.ht--repeater-field-control').each(function () {
                var valueToPush = {};

                $(this).find('[data-name]').each(function () {
                    var dataName = $(this).attr('data-name');
                    var dataValue = $(this).val();
                    valueToPush[dataName] = dataValue;
                });

                values.push(valueToPush);
            });

            $this.next('.ht--repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    // Responsive switchers
    $('.customize-control .responsive-switchers button').on('click', function (event) {
        // Set up variables
        var $this = $(this),
            $devices = $('.responsive-switchers'),
            $device = $(event.currentTarget).data('device'),
            $control = $('.customize-control.has-switchers'),
            $body = $('.wp-full-overlay'),
            $footer_devices = $('.wp-full-overlay-footer .devices');
        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');
        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);
        // Wrapper class
        $body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);
        // Panel footer buttons
        $footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
        $footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);
        // Open switchers
        if ($this.hasClass('preview-desktop')) {
            $control.toggleClass('responsive-switchers-open');
        }
    });

    // If panel footer buttons clicked
    $('.wp-full-overlay-footer .devices button').on('click', function (event) {
        // Set up variables
        var $this = $(this),
            $devices = $('.customize-control.has-switchers .responsive-switchers'),
            $device = $(event.currentTarget).data('device'),
            $control = $('.customize-control.has-switchers');
        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');
        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);
        // Open switchers
        if (!$this.hasClass('preview-desktop')) {
            $control.addClass('responsive-switchers-open');
        } else {
            $control.removeClass('responsive-switchers-open');
        }
    });

    // Linked button
    $('.ht--linked').on('click', function () {
        // Set up variables
        var $this = $(this);
        // Remove linked class
        $this.parent().parent('.ht--dimension-wrap').prevAll().slice(0, 4).find('input').removeClass('linked').attr('data-element', '');
        // Remove class
        $this.parent('.ht--link-dimensions').removeClass('unlinked');
    });

    // Unlinked button
    $('.ht--unlinked').on('click', function () {
        // Set up variables
        var $this = $(this),
            $element = $this.data('element');
        // Add linked class
        $this.parent().parent('.ht--dimension-wrap').prevAll().slice(0, 4).find('input').addClass('linked').attr('data-element', $element);
        // Add class
        $this.parent('.ht--link-dimensions').addClass('unlinked');
    });

    // Values linked inputs
    $('.ht--dimension-wrap').on('input', '.linked', function () {
        var $data = $(this).attr('data-element'),
            $val = $(this).val();
        $('.linked[ data-element="' + $data + '" ]').each(function (key, value) {
            $(this).val($val).change();
        });
    });
});

function viral_news_set_bg_color_value($container, $element, $obj) {
    $container.find($element).wpColorPicker({
        change: function (event, ui) {
            var color = ui.color.to_s();
            $obj.set(color);
        },
        clear: function (event) {
            var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
            var color = '';
            if (element) {
                $obj.set(color);
            }
        },
    });
}

(function (api) {
    api.controlConstructor['ht--background-image'] = api.Control.extend({
        ready: function () {
            var control = this;
            control.container.on('click', '.ht--upload-button', function (event) {
                event.preventDefault();
                var imgContainer = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--thumbnail'),
                    placeholder = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--placeholder'),
                    imgIdInput = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-id'),
                    imgUrlInput = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-url'),
                    backgroundFields = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-fields');
                var frame = wp.media({
                    title: 'Select or Upload Image',
                    button: {
                        text: 'Select Image'
                    },
                    multiple: false
                });
                frame.on('select', function () {
                    var attachment = frame.state().get('selection').first().toJSON();
                    imgContainer.html('<img src="' + attachment.url + '"/>');
                    placeholder.addClass('hidden');
                    imgIdInput.val(attachment.id).trigger('change');
                    imgUrlInput.val(attachment.url).trigger('change');
                    backgroundFields.show();
                });
                // Finally, open the modal on click
                frame.open();
            });

            // DELETE IMAGE LINK
            control.container.on('click', '.ht--remove-button', function (event) {
                event.preventDefault();
                var imgContainer = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--thumbnail'),
                    placeholder = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--placeholder'),
                    imgIdInput = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-id'),
                    imgUrlInput = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-url'),
                    backgroundFields = jQuery(this).closest('.customize-control-ht--background-image').find('.ht--background-image-fields');
                imgContainer.find('img').remove();
                placeholder.removeClass('hidden');
                imgIdInput.val('').trigger('change');
                imgUrlInput.val('').trigger('change');
                backgroundFields.hide();
            });

            control.container.on('change', '.ht--background-image-repeat select', function () {
                control.settings['repeat'].set(jQuery(this).val());
            });
            control.container.on('change', '.ht--background-image-size select', function () {
                control.settings['size'].set(jQuery(this).val());
            });
            control.container.on('change', '.ht--background-image-attachment select', function () {
                control.settings['attachment'].set(jQuery(this).val());
            });
            control.container.on('change', '.ht--background-image-position select', function () {
                control.settings['position'].set(jQuery(this).val());
            });
            viral_news_set_bg_color_value(control.container, '.ht--background-image-color input', control.settings['color']);
            viral_news_set_bg_color_value(control.container, '.ht--background-image-overlay input', control.settings['overlay']);
        }
    });

    // Tab Control
    api.Tabs = [];
    api.Tab = api.Control.extend({
        ready: function () {
            var control = this;
            control.container.find('a.ht--customizer-tab').click(function (evt) {
                var tab = jQuery(this).data('tab');
                evt.preventDefault();
                control.container.find('a.ht--customizer-tab').removeClass('active');
                jQuery(this).addClass('active');
                control.toggleActiveControls(tab);
            });
            api.Tabs.push(control.id);
        },
        toggleActiveControls: function (tab) {
            var control = this,
                currentFields = control.params.buttons[tab].fields;
            _.each(control.params.fields, function (id) {
                var tabControl = api.control(id);
                if (undefined !== tabControl) {
                    if (tabControl.active() && jQuery.inArray(id, currentFields) >= 0) {
                        tabControl.toggle(true);
                    } else {
                        tabControl.toggle(false);
                    }
                }
            });
        }
    });

    jQuery.extend(api.controlConstructor, {
        'ht--tab': api.Tab
    });

    api.bind('ready', function () {
        _.each(api.Tabs, function (id) {
            var control = api.control(id);
            control.toggleActiveControls(0);
        });
    });

    // Alpha Color Picker Control
    api.controlConstructor['ht--alpha-color'] = api.Control.extend({
        ready: function () {
            var control = this;
            var paletteInput = control.container.find('.ht--alpha-color-control').data('palette');
            if (true == paletteInput) {
                palette = true;
            } else if (typeof paletteInput !== 'undefined' && paletteInput.indexOf('|') !== -1) {
                palette = paletteInput.split('|');
            } else {
                palette = false;
            }
            control.container.find('.ht--alpha-color-control').wpColorPicker({
                change: function (event, ui) {
                    var color = ui.color.to_s();
                    control.setting.set(color);
                },
                clear: function (event) {
                    var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                    var color = '';
                    if (element) {
                        control.setting.set(color);
                    }
                },
                palettes: palette
            });
        }
    });

    // Color Tab Control
    api.controlConstructor['ht--color-tab'] = api.Control.extend({
        ready: function () {
            var control = this;
            control.container.find('.ht--alpha-color-control').each(function () {
                var $elem = jQuery(this);
                var paletteInput = $elem.data('palette');
                var setting = jQuery(this).attr('data-customize-setting-link');
                if (true == paletteInput) {
                    palette = true;
                } else if (typeof paletteInput !== 'undefined' && paletteInput.indexOf('|') !== -1) {
                    palette = paletteInput.split('|');
                } else {
                    palette = false;
                }
                $elem.wpColorPicker({
                    change: function (event, ui) {
                        var color = ui.color.to_s();
                        wp.customize(setting, function (obj) {
                            obj.set(color);
                        });
                    },
                    clear: function (event) {
                        var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
                        var color = '';
                        if (element) {
                            wp.customize(setting, function (obj) {
                                obj.set(color);
                            });
                        }
                    },
                    palettes: palette
                });
            });
        }
    });

    // Dimenstion Control
    api.controlConstructor['dimensions'] = api.Control.extend({
        ready: function () {
            var control = this;
            control.container.on('change keyup paste', '.ht--dimension-desktop_top', function () {
                control.settings['desktop_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-desktop_right', function () {
                control.settings['desktop_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-desktop_bottom', function () {
                control.settings['desktop_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-desktop_left', function () {
                control.settings['desktop_left'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-tablet_top', function () {
                control.settings['tablet_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-tablet_right', function () {
                control.settings['tablet_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-tablet_bottom', function () {
                control.settings['tablet_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-tablet_left', function () {
                control.settings['tablet_left'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-mobile_top', function () {
                control.settings['mobile_top'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-mobile_right', function () {
                control.settings['mobile_right'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-mobile_bottom', function () {
                control.settings['mobile_bottom'].set(jQuery(this).val());
            });
            control.container.on('change keyup paste', '.ht--dimension-mobile_left', function () {
                control.settings['mobile_left'].set(jQuery(this).val());
            });
        }
    });

    // Sortable Control
    api.controlConstructor['ht--sortable'] = api.Control.extend({
        ready: function () {
            var control = this;
            // Set the sortable container.
            control.sortableContainer = control.container.find('ul.ht--sortable').first();
            // Init sortable.
            control.sortableContainer.sortable({
                // Update value when we stop sorting.
                stop: function () {
                    control.updateValue();
                }
            }).disableSelection().find('li').each(function () {
                // Enable/disable options when we click on the eye of Thundera.
                jQuery(this).find('i.visibility').click(function () {
                    jQuery(this).toggleClass('dashicons-visibility-faint').parents('li:eq(0)').toggleClass('invisible');
                });
            }).click(function () {
                // Update value on click.
                control.updateValue();
            });
        },
        /**
         * Updates the sorting list
         */
        updateValue: function () {
            var control = this,
                newValue = [];
            this.sortableContainer.find('li').each(function () {
                if (!jQuery(this).is('.invisible')) {
                    newValue.push(jQuery(this).data('value'));
                }
            });
            control.setting.set(newValue);
        }
    });

    api.sectionConstructor['ht--upgrade-section'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () { },

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);