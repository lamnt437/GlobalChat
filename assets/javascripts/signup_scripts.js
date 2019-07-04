$(document).ready(function () {
    $('#signIn').on('click', function () {
        window.location.href = "index.php?controller=users&action=login";
    });
});