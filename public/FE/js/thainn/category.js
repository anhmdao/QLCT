// $(document).ready(function () {
//     // Handle Save Category button click
//         $('#save-category-button').click(function () {
//             // Get the values from the form fields
//             var categoryName = $('#category-name').val();
//             var categoryDescription = $('#category-description').val();
//             var categoryType = $('#category-type').val();
//             var categoryColor = $('#category-color').val();
    
//             // You can now use these values to save the new category
//             // Example: send an AJAX request to save the category
//             // $.ajax({
//             //     url: 'add-category.php',
//             //     data: {
//             //         name: categoryName,
//             //         description: categoryDescription,
//             //         type: categoryType,
//             //         color: categoryColor
//             //     },
//             //     method: 'POST',
//             //     success: function (response) {
//             //         // Handle the response from the server (e.g., close the modal, update the category list)
//             //     }
//             // });
    
//             // Clear the form fields
//             $('#category-name').val('');
//             $('#category-description').val('');
//             $('#category-type').val('income');
//             $('#category-color').val('#000000');
    
//             // Close the modal
//             $('#addCategoryModal').modal('hide');
//         });
    
//         $('.delete-item').click(function () {
//             // Show a confirmation dialog
//             var result = confirm("Are you sure you want to delete this item?");
    
//             // Check the user's choice in the confirmation dialog
//             if (result) {
//                 // User clicked "OK" in the confirmation dialog, perform the delete action
//                 // Add your delete logic here or call a delete function
//             } else {
//                 // User clicked "Cancel" in the confirmation dialog, do nothing
//             }
//         });
    
//         $('.edit-item').click(function () {
//             // Show the modal for editing
//             $('#editCategoryModal').modal('show');
    
        
    
//             // You can retrieve the transaction details and populate the form fields here
//             // Example: Use data attributes or an AJAX request to fetch transaction data and populate the form fields
//         });
    
//         // Handle Save Changes button click
//         $('#save-edit-button').click(function () {
//             // Get the edited transaction information from the form fields
//             // You can use this information to save the changes
//             // Example: send an AJAX request to update the transaction
//             // $.ajax({
//             //     url: 'update-transaction.php',
//             //     data: {
//             //         // Get the edited data from the form fields
//             //     },
//             //     method: 'POST',
//             //     success: function (response) {
//             //         // Handle the response from the server (e.g., close the modal, update the data table)
//             //     }
//             // });
    
//             // Close the modal
//             $('#editTransactionModal').modal('hide');
//         });
//     });

function confirmDelete() {
    var result = confirm("Are you sure you want to delete?");
    if (result) {
        // If the user clicks "OK", submit the form
        document.getElementById('deleteForm').submit();
    } else {
        // If the user clicks "Cancel", do nothing
    }
}