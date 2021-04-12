$("#edit_event_form").validate({
    // Specify validation rules       
    rules: {
        'event_title': {
            required: true,

        },
        event_category: {
            required: true,

        },
        'event_priority': {
            required: true,

        },
        'start_date': {
            required: true,

        },
        'end_date': {
            required: true,

        },
        'organiser_name': {
            required: true,

        },
        'description': {
            required: true,

        },
        'country': {
            required: true,

        },
        'state': {
            required: true,

        },
        'city': {
            required: true,

        },
        'timezone': {
            required: true,

        },
        'ticket_name[]': {
            required: true,

        },
        'quantity[]': {
            required: true,

        },
        'ticket_start_date[]': {
            required: true,

        },
        'ticketend_date[]': {
            required: true,

        },
        'price[]': {
            required: true,
        }

    },

});
jQuery.validator.addClassRules("ticketclass", {
    "required": true
});
