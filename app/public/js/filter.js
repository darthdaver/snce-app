$(document).ready(function() {
    $('.filter').on('change', function (e) {
        e.preventDefault();
        this.form.submit();  
    });
});
