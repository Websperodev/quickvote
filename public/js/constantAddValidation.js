   $(document).ready(function () {
$("#add_contestant_form").validate({
    // Specify validation rules

    rules: {
        'name[]': {
            required: true,

        },
        'image[]': {
            required: true,
             accept: "jpg|jpeg|png"

        },
        'number[]': {
            required: true,

        },
        'about[]': {
            required: true,

        },

    },

});
});