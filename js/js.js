/**
 * Created by Dmytryi on 06.01.2015.
 */
jQuery(document).ready(function(){

    jQuery('#add_ticket').click(function(){
        var tickContainer = jQuery('#ticket_container').clone().removeAttr("id");
        jQuery('.container_tikets_input').append(tickContainer);
    });


});