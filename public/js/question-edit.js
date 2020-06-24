$(document).ready(function() {

    var choiceIndex = 0;

    $(document).on('click', '.add-option', function() {
        ++choiceIndex;
        var fields = '<div class="form-group option-group">' +
        '<label for="option">New Option ' + choiceIndex + '</label>' +
        '<input name="option[]" id="option[]" placeholder="Enter Option Here" type="text" class="form-control" autocomplete="off">' +
        '<span class="btn btn-danger btn-sm delete-option" style="cursor:pointer; float:right; margin-top:5px">Delete</span>' +
        '</div>';
        $("#option-place").append(fields);
    });

    $(document).on('click', '.delete-option', function() {
        $(this).parent('.option-group').remove();
    });

});