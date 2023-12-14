// $(document).ready(function () {
//     // Handle Save Wallet button click
//     $('#save-wallet-button').click(function () {
//         // Get the values from the form fields
//         var walletName = $('#wallet-name').val();
//         var walletBalance = $('#wallet-balance').val();
//         var moneyType = $('input[name="money-type"]:checked').val();
    
//         // You can now use these values to save the new wallet
//         // Example: send an AJAX request to save the wallet
//         // $.ajax({
//         //     url: 'add-wallet.php',
//         //     data: {
//         //         name: walletName,
//         //         balance: walletBalance,
//         //         type: moneyType
//         //     },
//         //     method: 'POST',
//         //     success: function (response) {
//         //         // Handle the response from the server (e.g., close the modal, update the wallet list)
//         //     }
//         // });
    
//         // Clear the form fields
//         $('#wallet-name').val('');
//         $('#wallet-balance').val('');
//         $('input[name="money-type"]').prop('checked', false);
    
//         // Close the modal
//         $('#addWalletModal').modal('hide');
//     });
// });


    function confirmDelete() {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            // If the user clicks "OK", submit the form
            document.getElementById('deleteForm').submit();
        } else {
            // If the user clicks "Cancel", do nothing
        }
    }

