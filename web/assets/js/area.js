(function() {
    $(document).ready(function() {
        /* form validation here */
        $('#area_name').keyup(function(e) {
            var maxLength = 50;
            var textlen = $(this).val().length;

            if(textlen <= maxLength) {
                var spanText = "Name ("+textlen+"/"+maxLength+" chars)";
                $('#label_area_name').text(spanText);
            }
        });
    });
})();