jQuery(document).ready(function ($) {
    $('.ht--gradient-box').each(function () {
        var $pickerId = $(this).find('.ht--gradient-picker');
        var $inputId = $(this).find('.ht--gradient-val');
        var $previewId = $(this).find('.ht--gradient-preview');
        var $directionId = $(this).find('.ht--gradient-direction');
        var $customGradId = $(this).find('.ht--gradient-custom')
        var defaultColor = $(this).attr('data-default-color');
        var orientation = $directionId.children('option:selected').val();
        var value = $inputId.val();
        var deg = 0;
        var is_custom = 'false';

        if (value != '') {
            if (value.indexOf('-webkit-linear-gradient(vertical,') != -1) {
                var p_l = value.indexOf('-webkit-linear-gradient(vertical,');
                value = value.substring(p_l + 33);
                p_l = value.indexOf(');');
                value = value.substring(0, p_l);
                orientation = 'vertical';
            } else if (value.indexOf('-webkit-linear-gradient(horizontal,') != -1) {
                var p_l = value.indexOf('-webkit-linear-gradient(horizontal,');
                value = value.substring(p_l + 35);
                p_l = value.indexOf(');');
                value = value.substring(0, p_l);
                orientation = 'horizontal';
            } else {
                var p_l = value.indexOf('-webkit-linear-gradient(');
                value = value.substring(p_l + 24);
                p_l = value.indexOf(');');
                value = value.substring(0, p_l);
                var temp_col = value;
                var t_l = temp_col.indexOf('deg');
                var deg = temp_col.substring(0, t_l);
                value = value.substring(t_l + 4, value.length);
                orientation = 'custom';
                is_custom = 'true';
            }
        } else {
            value = defaultColor;
        }

        $directionId.children('option').each(function (i, opt) {
            if (opt.value == orientation) {
                $(this).attr('selected', true);
            }
        });

        if (is_custom == 'true') {
            orientation = deg + 'deg';
            $customGradId.show();
        }

        var onchange = false;

        $pickerId.ClassyGradient({
            orientation: orientation,
            gradient: value,
            target: $previewId,
            onChange: function (stringGradient, cssGradient) {
                cssGradient = cssGradient.replace('url(data:image/svg+xml;base64,', '');
                var e_pos = cssGradient.indexOf(';');
                cssGradient = cssGradient.substring(e_pos + 1);
                if (is_custom == 'true') {
                    var p_l = cssGradient.indexOf('background: linear-gradient');
                    var val = cssGradient.substring(p_l);
                    cssGradient = cssGradient.replace(val, '');
                }
                if (onchange) {
                    $inputId.val(cssGradient).trigger('change');
                }
            }
        });

        onchange = true;

        $directionId.on("change", function () {
            var direction = $(this).children('option:selected').val();

            if (direction == 'custom') {
                $customGradId.slideDown('fast');
                orientation = $(this).closest('.ht--gradient-box').find('.ui-slider-handle > span').text();
                $pickerId.data("ClassyGradient").setOrientation(orientation);
                var newCSS = $pickerId.data('ClassyGradient').getCSS();
                newCSS = newCSS.replace('url(data:image/svg+xml;base64,', '');
                var e_pos = newCSS.indexOf(';');
                newCSS = newCSS.substring(e_pos + 1);

                var p_l = newCSS.indexOf('background: linear-gradient');
                var val = newCSS.substring(p_l);
                newCSS = newCSS.replace(val, '');
            } else {
                $customGradId.slideUp('fast');

                $pickerId.data("ClassyGradient").setOrientation(direction);
                var newCSS = $pickerId.data('ClassyGradient').getCSS();
                newCSS = newCSS.replace('url(data:image/svg+xml;base64,', '');
                var e_pos = newCSS.indexOf(';');
                newCSS = newCSS.substring(e_pos + 1);
            }

            $inputId.val(newCSS).trigger('change');
        });

        $(this).find('.ht--gradient-range').slider({
            range: "min",
            value: deg,
            min: 0,
            max: 360,
            step: 1,
            slide: function (event, ui) {
                var orientation = ui.value + 'deg';
                $pickerId.data("ClassyGradient").setOrientation(orientation);
                var newCSS = $pickerId.data('ClassyGradient').getCSS();
                newCSS = newCSS.replace('url(data:image/svg+xml;base64,', '');
                var e_pos = newCSS.indexOf(';');
                newCSS = newCSS.substring(e_pos + 1);

                var p_l = newCSS.indexOf('background: linear-gradient');
                var val = newCSS.substring(p_l);
                newCSS = newCSS.replace(val, '');

                $inputId.val(newCSS).trigger('change');
                $(this).find('.ui-slider-handle').html('<span>' + ui.value + 'deg</span>');
            },
            create: function (event, ui) {
                $(this).find('.ui-slider-handle').html('<span>' + deg + 'deg</span>');
            }
        });

    });
});
