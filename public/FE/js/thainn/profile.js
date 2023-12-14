$(document).ready(function () {
    // Add a click event listener to the "Edit Information" button
    $('#edit-button').click(function () {
        // Enable editing of form fields
        $('#email, #username, #address, #age, #male, #female').prop('readonly', false);
        $('#male, #female').prop('disabled', false);
        // Show the "Save Information" button and hide the "Edit Information" button
        $('#save-button').show();
        $(this).hide();
    });

    // Add a click event listener to the "Save Information" button
    $('#save-button').click(function () {
        // Disable editing of form fields
        $('#email, #username, #address, #age, #male, #female').prop('readonly', true);
        $('#male, #female').prop('disabled', true);
        // Show the "Edit Information" button and hide the "Save Information" button
        $('#edit-button').show();
        $(this).hide();
        // Handle saving changes here (e.g., make an AJAX request to update user data)
    });
});