jQuery(function($) {

  function bindAccordion($scope) {

    var $widget = $scope.find('.accordion-dc-widget');
    if (!$widget.length) { return; }

    var isAnimating = false; // blocca re-trigger durante animazione

    function updateAccordion($item) {

      // se è già l'item attivo o stiamo animando, ignora
      if ($item.hasClass('is-active') || isAnimating) { return; }

      var img         = $item.data('image');
      var btnUrl      = $item.data('btn-url');
      var btnTitle    = $item.data('btn-title');
      var btnExternal = $item.data('btn-external') === 'yes';
      var btnNofollow = $item.data('btn-nofollow') === 'yes';

      var $bg      = $widget.find('.accordion-dc-image-wrapper');
      var $btnWrap = $widget.find('.accordion-dc-btn');
      var $btn     = $widget.find('.accordion-dc-btn-link');

      // classe attiva
      $widget.find('.accordion-dc-item').removeClass('is-active');
      $item.addClass('is-active');

      // immagine e bottone — aggiorna subito, prima dell'animazione
      if (img) {
        $bg.css('background-image', 'url(' + img + ')');
      }

      if (btnTitle) {
        $btn.text(btnTitle);
        if (btnUrl)      { $btn.attr('href', btnUrl); }
        if (btnExternal) { $btn.attr('target', '_blank'); } else { $btn.removeAttr('target'); }
        if (btnNofollow) { $btn.attr('rel', 'nofollow'); }  else { $btn.removeAttr('rel'); }
        $btnWrap.show();
      } else {
        $btnWrap.hide();
      }

      // animazione testo — lock durante slide
      isAnimating = true;

      $widget.find('.accordion-dc-text').not($item.find('.accordion-dc-text')).stop(true, true).slideUp(200);
      $item.find('.accordion-dc-text').stop(true, true).slideDown(200, function() {
        isAnimating = false; // sblocca solo a fine animazione
      });
    }

    // HOVER — solo su desktop (pointer: fine)
    $widget.on('mouseenter', '.accordion-dc-item', function() {
      if (window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
        updateAccordion($(this));
      }
    });

    // CLICK — mobile e fallback desktop
    $widget.on('click', '.accordion-dc-item', function(e) {
      e.preventDefault();
      updateAccordion($(this));
    });

  }

  // Frontend normale
  bindAccordion($(document));

  // Elementor editor
  if (window.elementorFrontend && elementorFrontend.hooks) {
    elementorFrontend.hooks.addAction('frontend/element_ready/accordion_custom.default', function($scope) {
      bindAccordion($scope);
    });
  }

});