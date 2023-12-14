// $(document).ready(function () {
//     // ... Your existing code ...
//     $('.delete-item').click(function () {
//         // Show a confirmation dialog
//         var result = confirm("Are you sure you want to delete this item?");
    
//         // Check the user's choice in the confirmation dialog
//         if (result) {
//             // User clicked "OK" in the confirmation dialog, perform the delete action
//             // Add your delete logic here or call a delete function
//         } else {
//             // User clicked "Cancel" in the confirmation dialog, do nothing
//         }
//     });
//     // Handle opening the modal
    // $('#add-button').click(function () {
    //     // Set the "time" field to the current date
    //     var currentDate = new Date();
    //     var formattedDate = currentDate.toISOString().split('T')[0];
    //     $('#transaction-time').val(formattedDate);
    // });
    
//     // Handle Save Transaction button click
//     $('#save-transaction-button').click(function () {
//         // Get the values from the form fields
//         var transactionName = $('#transaction-name').val();
//         var transactionAmount = $('#transaction-amount').val();
//         var transactionTime = $('#transaction-time').val();
//         var transactionCategory = $('#transaction-category').val();
    
//         // You can now use these values to save the new transaction
//         // Example: send an AJAX request to save the transaction
//         // $.ajax({
//         //     url: 'add-transaction.php',
//         //     data: {
//         //         name: transactionName,
//         //         amount: transactionAmount,
//         //         time: transactionTime
//         //     },
//         //     method: 'POST',
//         //     success: function (response) {
//         //         // Handle the response from the server (e.g., close the modal, update the data table)
//         //     }
//         // });
    
//         // Clear the form fields
//         $('#transaction-name').val('');
//         $('#transaction-amount').val('');
//         $('#transaction-time').val('');
    
//         // Close the modal
//         $('#addTransactionModal').modal('hide');
//     });
    
//     // Add a click event listener to the "Edit" icon
//     $('.edit-item').click(function () {
//         // Show the modal for editing
//         $('#editTransactionModal').modal('show');
    
       
    
//         // You can retrieve the transaction details and populate the form fields here
//         // Example: Use data attributes or an AJAX request to fetch transaction data and populate the form fields
//     });
    
//     // Handle Save Changes button click
//     $('#save-edit-button').click(function () {
//         // Get the edited transaction information from the form fields
//         // You can use this information to save the changes
//         // Example: send an AJAX request to update the transaction
//         // $.ajax({
//         //     url: 'update-transaction.php',
//         //     data: {
//         //         // Get the edited data from the form fields
//         //     },
//         //     method: 'POST',
//         //     success: function (response) {
//         //         // Handle the response from the server (e.g., close the modal, update the data table)
//         //     }
//         // });
    
//         // Close the modal
//         $('#editTransactionModal').modal('hide');
//     });
//     });
    

function confirmDelete() {
    var result = confirm("Website hiện chưa hỗ trợ chức năng xóa giao dịch!");
    if (result) {
        // If the user clicks "OK", submit the form
        document.getElementById('deleteForm').submit();
    } else {
        // If the user clicks "Cancel", do nothing
    }
}