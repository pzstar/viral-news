jQuery(document).ready(function ($) {
    $('.customize-control-ht--column').each(function () {
        var columnSelector = $(this).find('.ht--column-selector')[0];
        var defaultval = $(this).find('input').val();

        if (defaultval.indexOf(',') == -1) {
            var setvalue = [50];
        } else {
            var setvalue = defaultval.split(',');
        }

        if (setvalue.length == 1) {
            var pipValues = [50, 100]
        } else if (setvalue.length == 2) {
            var pipValues = [33.33, 66.66, 100]
        } else if (setvalue.length == 3) {
            var pipValues = [25, 50, 75, 100]
        } else if (setvalue.length == 4) {
            var pipValues = [20, 40, 60, 80, 100]
        } else if (setvalue.length == 5) {
            var pipValues = [16.66, 33.33, 50, 66.66, 83.33, 100]
        }
        $th = $(this);

        noUiSlider.create(columnSelector, {
            start: setvalue,
            connect: false,
            tooltips: true,
            padding: [5, 5],
            margin: 5,
            range: {
                'min': 0,
                'max': 100
            },
            step: 0.1,
            pips: {
                mode: 'values',
                values: pipValues,
                density: 2
            }
        });

        update_nouislider(columnSelector, $th);
    });

    $('.ht--add-col').on('click', function () {
        $th = $(this);
        var columnSelectorAdd = $(this).closest('.customize-control-ht--column').find('.ht--column-selector')[0];
        var count = $(this).closest('.customize-control-ht--column').find('input').val().split(',').length + 1;

        set_uislider(columnSelectorAdd, count);

        if (count != 6) {
            update_nouislider(columnSelectorAdd, $th.closest('.customize-control-ht--column'));
        }

        return false;
    });

    $('.ht--remove-col').on('click', function () {
        $th = $(this);
        var columnSelectorRemove = $(this).closest('.customize-control-ht--column').find('.ht--column-selector')[0];
        var count = $(this).closest('.customize-control-ht--column').find('input').val().split(',').length - 1;

        set_uislider(columnSelectorRemove, count);

        if (count != 0) {
            update_nouislider(columnSelectorRemove, $th.closest('.customize-control-ht--column'));
        }

        return false;
    });

    $('.ht--reset-col').on('click', function () {
        var columnSelectorReset = $(this).closest('.customize-control-ht--column').find('.ht--column-selector')[0];
        var count = $(this).closest('.customize-control-ht--column').find('input').val().split(',').length;
        if (count == 1) {
            columnSelectorReset.noUiSlider.set([50]);
        } else if (count == 2) {
            columnSelectorReset.noUiSlider.set([33.33, 66.66]);
        } else if (count == 3) {
            columnSelectorReset.noUiSlider.set([25, 50, 75]);
        } else if (count == 4) {
            columnSelectorReset.noUiSlider.set([20, 40, 60, 80]);
        } else if (count == 5) {
            columnSelectorReset.noUiSlider.set([16.66, 33.33, 50, 66.66, 83.33]);
        }
        
        return false;
    });

    function update_nouislider(columnSelector, $elements) {
        $('[data-handle]').append('<div class="noUi-width"><span class="noUi-width-left"></span><span class="noUi-width-right"></span></div>');

        columnSelector.noUiSlider.on('update', function (values, handle, unencoded, tap, positions, noUiSlider) {
            var oldval = $elements.find('input').val();
            var newval = values.join(',');

            if (oldval != newval) {
                $elements.find('input').val(values.join(',')).trigger('change');
            }

            var leftval = 0;
            var rightval = 100;
            var prevhandle = handle - 1;
            var nexthandle = handle + 1;
            var currentval = values[handle];

            if (typeof values[handle - 1] !== 'undefined') {
                leftval = values[handle - 1];
            }

            if (typeof values[handle + 1] !== 'undefined') {
                rightval = values[handle + 1];
            }

            var newhandle = parseInt(handle) + 1;

            $('[data-handle="' + prevhandle + '"]').find('.noUi-width-right').html(parseFloat(currentval - leftval).toFixed(2) + '%');

            $('[data-handle="' + handle + '"]').find('.noUi-width-left').html(parseFloat(currentval - leftval).toFixed(2) + '%');
            $('[data-handle="' + handle + '"]').find('.noUi-width-right').html(parseFloat(rightval - currentval).toFixed(2) + '%');

            $('[data-handle="' + nexthandle + '"]').find('.noUi-width-left').html(parseFloat(rightval - currentval).toFixed(2) + '%');
        });
    }

    function set_uislider(columnSelector, count) {
        if (count == 0) {
            alert('Mimimum Column Count Reached');
        } else if (count == 1) {
            columnSelector.noUiSlider.destroy();
            noUiSlider.create(columnSelector, {
                start: [50],
                tooltips: true,
                padding: [5, 5],
                margin: 5,
                range: {
                    'min': 0,
                    'max': 100
                },
                step: 0.1,
                pips: {
                    mode: 'values',
                    values: [0, 50, 100],
                    density: 2
                }
            });
        } else if (count == 2) {
            columnSelector.noUiSlider.destroy();
            noUiSlider.create(columnSelector, {
                start: [33.33, 66.66],
                tooltips: true,
                padding: [5, 5],
                margin: 5,
                range: {
                    'min': 0,
                    'max': 100
                },
                step: 0.1,
                pips: {
                    mode: 'values',
                    values: [0, 33.33, 66.66, 100],
                    density: 2
                }
            });
        } else if (count == 3) {
            columnSelector.noUiSlider.destroy();
            noUiSlider.create(columnSelector, {
                start: [25, 50, 75],
                tooltips: true,
                padding: [5, 5],
                margin: 5,
                range: {
                    'min': 0,
                    'max': 100
                },
                step: 0.1,
                pips: {
                    mode: 'values',
                    values: [0, 25, 50, 75, 100],
                    density: 2
                }
            });
        } else if (count == 4) {
            columnSelector.noUiSlider.destroy();
            noUiSlider.create(columnSelector, {
                start: [20, 40, 60, 80],
                tooltips: true,
                padding: [5, 5],
                margin: 5,
                range: {
                    'min': 0,
                    'max': 100
                },
                step: 0.1,
                pips: {
                    mode: 'values',
                    values: [0, 20, 40, 60, 80, 100],
                    density: 2
                }
            });
        } else if (count == 5) {
            columnSelector.noUiSlider.destroy();
            noUiSlider.create(columnSelector, {
                start: [16.66, 33.33, 50, 66.66, 83.33],
                tooltips: true,
                padding: [5, 5],
                margin: 5,
                range: {
                    'min': 0,
                    'max': 100
                },
                step: 0.1,
                pips: {
                    mode: 'values',
                    values: [0, 16.66, 33.33, 50, 66.66, 83.33, 100],
                    density: 2
                }
            });
        } else if (count == 6) {
            alert('Maximum Column Count Reached');
        }
    }
});

