var map;
var currentMarker;
var locationsLayer = new L.layerGroup();
window.onload = function() {
  jQuery('.side-open').on('click', function() {
    jQuery('#main-menu').addClass('active');
    jQuery('.side-open').css('display', 'none');
  });
  jQuery('.side-close').on('click', function() {
    jQuery('.side-open').css('display', 'block');
    jQuery('#main-menu').removeClass('active');
  });
  jQuery('.mv-section-option').on('click', function(event) {
    jQuery(event.currentTarget.parentElement.parentElement).children('.active').removeClass('active');
    jQuery(event.currentTarget.parentElement).addClass('active');
    jQuery.get(event.currentTarget.dataset.url,
    {
      action: 'getSectionContent',
      id: event.currentTarget.dataset.id
    },
    function(data) {
      data = JSON.parse(data);
      if(data.msg) {
        jQuery(event.currentTarget.dataset.target).text(data.msg);
      }
    }
    );
  });
};