jQuery(document).ready(function($){
    function sendDataLayerEvent(event_type, event_detail){
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: event_type,
            detail: event_detail
        });
    }

    $('body').on('click', '[data-event-type]', function(e){
        var event_type = $(this).data('event-type');
        var event_detail = $(this).data('event-detail');
        
        sendDataLayerEvent(event_type, event_detail);
    });
});