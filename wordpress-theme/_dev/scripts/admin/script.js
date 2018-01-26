jQuery(document).ready(function() {
    jQuery('.wc-tabs li').css('display', 'block', 'important');
    jQuery('.wc-tabs li').removeClass('active');
    jQuery('.wc-tabs li').on('click', function() {
        var anchor = jQuery(this).find('a');
        var currentPanel = anchor.attr('href').replace('#', '');
        jQuery('.panel.woocommerce_options_panel').each(function() {
            if(this.id != currentPanel) {
                this.style.setProperty('display', 'none', 'important');
            } else {
                this.style.setProperty('display', 'block', 'important');
            }
        });
    });
});