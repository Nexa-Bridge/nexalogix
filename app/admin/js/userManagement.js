$(document).ready(function() {
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'http://nexalogix.nexabridge.net/api/users/get_user.php',
            dataType: 'json',
            success: function(users) {
                let html = '';
                users.forEach(user => {
                    html += `<tr>
                                <td>${user.UserID}</td>
                                <td>${user.Username}</td>
                                <td>${user.Email}</td>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary updateUserModalButton" data-userid="${user.UserID}">Update</button>
                                </td>
                             </tr>`;
                });
                $('#userTableBody').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Erreur AJAX : ", status, error, xhr.responseText);
            }
        });
    }

    function addUser(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $("#addUserForm").serialize(); // Serialize form data

        $.ajax({
            type: 'POST',
            url: 'http://nexalogix.nexabridge.net/api/users/create_user.php',
            data: formData,
            success: function(response) {
                console.log("User added successfully");
                // Consider calling loadUsers() again to refresh the list
                loadUsers();
            },
            error: function() {
                console.error("Error adding user");
            }
        });
    }

    function updateUserModal(userId) {
        // AJAX call to fetch user data
        $.ajax({
            type: 'GET',
            url: 'http://nexalogix.nexabridge.net/api/users/get_user_details.php', // URL to your API endpoint that returns user data
            data: { userId: userId },
            success: function(response) {
                // Assuming the response is the user data object
                // Populate the form fields with the user data
                $('#updateUserId').val(response.UserID);
                $('#updateUsername').val(response.Username);
                $('#updateEmail').val(response.Email);
    
                // If there are other fields to populate, do it here
                // ...
    
                // Open the modal
                $('#updateUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error("Error fetching user data: ", status, error, xhr.responseText);
            }
        });
    }
    

    function updateUser(event) {
        event.preventDefault(); // Prevent the default form submission
    
        var formData = $("#updateUserForm").serialize();
    
        $.ajax({
            type: 'POST',
            url: 'http://nexalogix.nexabridge.net/api/users/update_user.php',
            data: formData,
            success: function(response) {
                console.log("User updated successfully");
                loadUsers(); // Refresh the user list
                $('#updateUserModal').modal('hide'); // Close the modal
            },
            error: function() {
                console.error("Error updating user");
            }
        });
    }

    // Initialize the user list
    loadUsers();

    // Event Listeners
    $('#addUserButton').on('click', addUser);
    $('#updateUserButton').on('click', updateUser);

    // Delegated event listener for dynamically added elements
    $(document).on('click', '.updateUserModalButton', function() {
        var userId = $(this).data('userid');
        updateUserModal(userId); // Ensure this function is defined
    });
});
