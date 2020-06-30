var choiceIndex = 2;
$(document).ready(function() {
    var field1 = '<div class="form-group option-group">' +
    '<label for="option">Option 1</label>' +
    '<input name="option[]" id="option[]" placeholder="Enter Option Here" type="text" class="form-control" autocomplete="off">' +
    '</div>';
    var field2 = '<div class="form-group option-group">' +
    '<label for="option">Option 2</label>' +
    '<input name="option[]" id="option[]" placeholder="Enter Option Here" type="text" class="form-control" autocomplete="off">' +
    '</div>';

    var min = '<div class="form-group option-group">' +
    '<label for="option">Min</label>' +
    '<input name="option[]" id="option[]" placeholder="Enter Min Value Here" type="number" class="form-control" autocomplete="off" min="0" max="99">' +
    '</div>';
    var max = '<div class="form-group option-group">' +
    '<label for="option">Max</label>' +
    '<input name="option[]" id="option[]" placeholder="Enter Max Value Here" type="number" class="form-control" autocomplete="off" min="1" max="100">' +
    '</div>';

    var addButton = '<span class="btn btn-success add-option" style="cursor:pointer; margin-bottom:5px;">Add Option</span>';

    $(document).on('change', '#type', function() {
        var selected = $('#type :selected').val();
        if(selected === "checkbox" || selected ==="radio") {
            $('#option-place').html(addButton);
            $('#option-place').append(field1);
            $('#option-place').append(field2);
        }else if (selected === "number") {
            $('.add-option').remove();
            $('.option-group').remove();
            $('#option-place').append(min);
            $('#option-place').append(max);

        }else {
            choiceIndex = 1;
            $('.add-option').remove();
            $('.option-group').remove();
        }
    });

    $(document).on('click', '.add-option', function() {
        ++choiceIndex;
        var fields = '<div class="form-group option-group">' +
        '<label for="option">Option ' + choiceIndex + '</label>' +
        '<input name="option[]" id="option[]" placeholder="Enter Option Here" type="text" class="form-control" autocomplete="off">' +
        '<span class="btn btn-danger btn-sm delete-option" style="cursor:pointer; float:right; margin-top:5px">Delete</span>' +
        '</div>';
        $("#option-place").append(fields);
    });

    $(document).on('click', '.delete-option', function() {
        $(this).parent('.option-group').remove();
    });

    // $(".collapse").collapse();

});