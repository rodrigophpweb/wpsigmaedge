/**
 * Admin Font Awesome Icon Picker
 * Modal com busca e filtro por categoria para campos ACF de ícone.
 */
(function ($) {
    'use strict';

    // Dados localizados via wp_localize_script
    var FA_ICONS     = (window.sigmaFaPickerData && window.sigmaFaPickerData.icons) || {};
    var $modal       = null;
    var $activeInput = null;

    // =========================================================
    // PICKER UI — substitui o <input> original por botão+preview
    // =========================================================
    function initPicker($input) {
        if ($input.data('sigma-fa-init')) return;
        $input.data('sigma-fa-init', true).hide();

        var $ui = $(
            '<div class="sigma-fa-ui" style="' +
            'display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-top:6px;">' +
            '</div>'
        );

        var $preview = $(
            '<div class="sigma-fa-ui__preview" style="' +
            'width:46px;height:46px;flex-shrink:0;display:flex;align-items:center;' +
            'justify-content:center;background:#f6f7f7;border:1px solid #dcdcde;border-radius:4px;">' +
            '</div>'
        );

        var $label = $(
            '<code class="sigma-fa-ui__label" style="' +
            'flex:1;min-width:140px;font-size:12px;color:#50575e;word-break:break-all;"></code>'
        );

        var $btnChoose = $(
            '<button type="button" class="button" style="display:inline-flex;align-items:center;gap:5px;">' +
            '<i class="fa-solid fa-icons" style="font-size:13px;"></i> Escolher ícone</button>'
        );

        var $btnClear = $(
            '<button type="button" class="button" style="color:#b32d2e;">Remover</button>'
        );

        $ui.append($preview, $label, $btnChoose, $btnClear);
        $input.after($ui);

        refreshUI($input, $preview, $label);

        $btnChoose.on('click', function () {
            $activeInput = $input;
            openModal($input.val().trim());
        });

        $btnClear.on('click', function () {
            $input.val('').trigger('change');
            refreshUI($input, $preview, $label);
        });
    }

    function refreshUI($input, $preview, $label) {
        var cls = $input.val().trim();
        if (cls) {
            $preview.html('<i class="' + esc(cls) + '" style="font-size:22px;color:#3c434a;"></i>');
            $label.text(cls);
        } else {
            $preview.html('<i class="fa-regular fa-image" style="font-size:18px;color:#c3c4c7;"></i>');
            $label.html('<em style="color:#c3c4c7;font-style:italic;font-family:sans-serif;font-size:12px;">Nenhum ícone</em>');
        }
    }

    // =========================================================
    // MODAL
    // =========================================================
    function buildModal() {
        if ($('#sigma-fa-modal').length) {
            $modal = $('#sigma-fa-modal');
            return;
        }

        $modal = $(
            '<div id="sigma-fa-modal" role="dialog" aria-modal="true" aria-label="Escolher ícone" style="' +
            'position:fixed;inset:0;z-index:999999;background:rgba(0,0,0,.55);' +
            'display:flex;align-items:center;justify-content:center;padding:16px;">' +

            '<div class="sigma-fa-modal__box" style="' +
            'background:#fff;border-radius:6px;width:780px;max-width:100%;' +
            'max-height:92vh;display:flex;flex-direction:column;' +
            'box-shadow:0 4px 32px rgba(0,0,0,.28);">' +

            // Cabeçalho
            '<div style="padding:14px 20px;border-bottom:1px solid #f0f0f1;' +
            'display:flex;align-items:center;justify-content:space-between;flex-shrink:0;">' +
            '<h3 style="margin:0;font-size:15px;font-weight:600;color:#1d2327;">' +
            '<i class="fa-solid fa-icons" style="margin-right:8px;color:#787c82;"></i>Escolher Ícone Font Awesome</h3>' +
            '<button type="button" id="sigma-fa-close" aria-label="Fechar" style="' +
            'background:none;border:none;font-size:24px;line-height:1;cursor:pointer;' +
            'color:#787c82;padding:0;width:28px;height:28px;">&times;</button>' +
            '</div>' +

            // Busca
            '<div style="padding:10px 20px;border-bottom:1px solid #f0f0f1;flex-shrink:0;">' +
            '<input type="search" id="sigma-fa-search" placeholder="Buscar por nome ou classe (ex: estrela, fa-star…)" ' +
            'style="width:100%;box-sizing:border-box;padding:8px 10px;border:1px solid #8c8f94;' +
            'border-radius:4px;font-size:13px;">' +
            '</div>' +

            // Categorias
            '<div id="sigma-fa-cats" style="' +
            'padding:8px 20px;border-bottom:1px solid #f0f0f1;display:flex;gap:5px;' +
            'flex-wrap:wrap;flex-shrink:0;"></div>' +

            // Grid
            '<div id="sigma-fa-grid" style="' +
            'padding:12px 16px;overflow-y:auto;flex:1;' +
            'display:grid;grid-template-columns:repeat(auto-fill,minmax(82px,1fr));gap:2px;">' +
            '</div>' +

            // Rodapé
            '<div style="padding:10px 20px;border-top:1px solid #f0f0f1;display:flex;align-items:center;gap:10px;flex-shrink:0;">' +
            '<div id="sigma-fa-footer-preview" style="flex:1;display:flex;align-items:center;gap:10px;">' +
            '<span style="color:#a7aaad;font-size:13px;">Clique em um ícone para selecionar</span>' +
            '</div>' +
            '<button type="button" id="sigma-fa-confirm" class="button button-primary" disabled>Confirmar</button>' +
            '<button type="button" id="sigma-fa-cancel" class="button">Cancelar</button>' +
            '</div>' +

            '</div></div>'
        ).appendTo('body');

        // Eventos fixos
        $modal.on('click', '#sigma-fa-close, #sigma-fa-cancel', closeModal);
        $modal.on('click', function (e) { if ($(e.target).is('#sigma-fa-modal')) closeModal(); });
        $modal.on('click', '#sigma-fa-confirm', confirmSelection);
        $modal.on('input', '#sigma-fa-search', function () {
            renderGrid($(this).val().toLowerCase(), getActiveCat());
        });

        buildCategoryPills();
    }

    function buildCategoryPills() {
        var $cats = $('#sigma-fa-cats').empty();

        var $all = $('<button type="button" data-cat="*" class="sigma-fa-cat button button-small button-primary" ' +
            'style="font-size:11px;">Todos</button>');
        $cats.append($all);

        $.each(FA_ICONS, function (cat) {
            $cats.append(
                $('<button type="button" class="sigma-fa-cat button button-small" style="font-size:11px;" ' +
                    'data-cat="' + esc(cat) + '">' + esc(cat) + '</button>')
            );
        });

        $cats.on('click', '.sigma-fa-cat', function () {
            $cats.find('.sigma-fa-cat').removeClass('button-primary');
            $(this).addClass('button-primary');
            renderGrid($('#sigma-fa-search').val().toLowerCase(), $(this).data('cat'));
        });
    }

    function getActiveCat() {
        var $btn = $('#sigma-fa-cats .button-primary');
        return $btn.length ? $btn.data('cat') : '*';
    }

    function renderGrid(search, cat) {
        var $grid = $('#sigma-fa-grid').empty();
        var icons = [];

        if (cat === '*') {
            $.each(FA_ICONS, function (c, list) { icons = icons.concat(list); });
        } else {
            icons = FA_ICONS[cat] || [];
        }

        if (search) {
            icons = icons.filter(function (ic) {
                return ic.name.toLowerCase().indexOf(search) !== -1 ||
                    ic['class'].toLowerCase().indexOf(search) !== -1;
            });
        }

        if (!icons.length) {
            $grid.html('<p style="color:#a7aaad;text-align:center;padding:24px;grid-column:1/-1;">Nenhum ícone encontrado.</p>');
            return;
        }

        var currentSelected = $('#sigma-fa-confirm').data('pending') || '';

        $.each(icons, function (i, ic) {
            var active = ic['class'] === currentSelected;
            var $item = $(
                '<button type="button" class="sigma-fa-item" data-class="' + esc(ic['class']) + '" title="' + esc(ic['class']) + '" ' +
                'style="display:flex;flex-direction:column;align-items:center;justify-content:flex-start;' +
                'gap:5px;padding:10px 4px 8px;border-radius:4px;border:2px solid ' + (active ? '#2271b1' : 'transparent') + ';' +
                'background:' + (active ? '#f0f6fc' : 'transparent') + ';' +
                'cursor:pointer;width:100%;text-align:center;">' +
                '<i class="' + esc(ic['class']) + '" style="font-size:22px;color:#3c434a;height:28px;' +
                'display:flex;align-items:center;justify-content:center;"></i>' +
                '<span style="font-size:10px;color:#787c82;line-height:1.3;word-break:break-all;max-width:100%;">' + esc(ic.name) + '</span>' +
                '</button>'
            );

            $item.on('mouseenter', function () {
                if (!$(this).hasClass('is-active')) $(this).css({ background: '#f6f7f7', 'border-color': '#dcdcde' });
            }).on('mouseleave', function () {
                if (!$(this).hasClass('is-active')) $(this).css({ background: 'transparent', 'border-color': 'transparent' });
            }).on('click', function () {
                pickIcon($(this).data('class'));
            });

            $grid.append($item);
        });
    }

    function pickIcon(cls) {
        // Estado visual dos itens
        $('#sigma-fa-grid .sigma-fa-item').each(function () {
            var mine = $(this).data('class') === cls;
            $(this).toggleClass('is-active', mine).css({
                background: mine ? '#f0f6fc' : 'transparent',
                'border-color': mine ? '#2271b1' : 'transparent',
            });
        });

        // Rodapé
        $('#sigma-fa-footer-preview').html(
            '<i class="' + esc(cls) + '" style="font-size:26px;color:#3c434a;flex-shrink:0;"></i>' +
            '<code style="font-size:12px;color:#50575e;">' + esc(cls) + '</code>'
        );

        // Guarda e habilita confirmar
        $('#sigma-fa-confirm').data('pending', cls).prop('disabled', false);
    }

    function confirmSelection() {
        var cls = $('#sigma-fa-confirm').data('pending');
        if (cls && $activeInput) {
            $activeInput.val(cls).trigger('change');
            var $ui       = $activeInput.siblings('.sigma-fa-ui');
            var $preview  = $ui.find('.sigma-fa-ui__preview');
            var $label    = $ui.find('.sigma-fa-ui__label');
            refreshUI($activeInput, $preview, $label);
        }
        closeModal();
    }

    function openModal(currentValue) {
        buildModal();

        // Reseta busca e categoria
        $('#sigma-fa-search').val('');
        $('#sigma-fa-cats .sigma-fa-cat').removeClass('button-primary');
        $('#sigma-fa-cats [data-cat="*"]').addClass('button-primary');

        // Rodapé e estado inicial
        if (currentValue) {
            $('#sigma-fa-confirm').data('pending', currentValue).prop('disabled', false);
            $('#sigma-fa-footer-preview').html(
                '<i class="' + esc(currentValue) + '" style="font-size:26px;color:#3c434a;flex-shrink:0;"></i>' +
                '<code style="font-size:12px;color:#50575e;">' + esc(currentValue) + '</code>'
            );
        } else {
            $('#sigma-fa-confirm').removeData('pending').prop('disabled', true);
            $('#sigma-fa-footer-preview').html('<span style="color:#a7aaad;font-size:13px;">Clique em um ícone para selecionar</span>');
        }

        renderGrid('', '*');
        $modal.show();
        setTimeout(function () { $('#sigma-fa-search').focus(); }, 50);

        $(document).on('keydown.sigmafa', function (e) {
            if (e.key === 'Escape') closeModal();
        });
    }

    function closeModal() {
        if ($modal) $modal.hide();
        $(document).off('keydown.sigmafa');
    }

    // =========================================================
    // UTILITÁRIO
    // =========================================================
    function esc(str) {
        return $('<div>').text(String(str)).html();
    }

    // =========================================================
    // INICIALIZAÇÃO
    // =========================================================
    function initAll($scope) {
        var $root = $scope || $(document);
        $root.find('[data-name="icon_class"] input[type="text"]').each(function () {
            initPicker($(this));
        });
    }

    $(document).ready(function () { initAll(); });

    if (typeof acf !== 'undefined') {
        acf.addAction('append', function ($el) { initAll($el); });
    }

}(jQuery));
