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
    // Attaching event listener to the Add User button
    $('#addUserButton').on('click', addUser);

    function updateUser(event) {
        event.preventDefault(); // Prevent the default form submission
    
        var formData = $("#updateUserForm").serialize(); // Serialize form data from the update form
    
        $.ajax({
            type: 'POST',
            url: 'http://nexalogix.nexabridge.net/api/users/update_user.php', // Adjust with the correct path
            data: formData,
            success: function(response) {
                console.log("User updated successfully");
                // Additional actions on success (e.g., refreshing the user list, closing the modal)
                loadUsers();
            },
            error: function() {
                console.error("Error updating user");
            }
        });
        $('#updateUserButton').on('click', updateUser);
        
    }
    loadUsers();
});

$(document).on('click', '.updateUserModalButton', function() {
    var userId = $(this).data('userid');
    updateUserModal(userId);
});
