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
                                <td>
                                    <!-- Ici, des boutons ou liens pour la mise à jour/suppression peuvent être ajoutés -->
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

    loadUsers();
});
