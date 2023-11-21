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
        event.preventDefault(); // Prevent the default form submission
    
        var formData = $("#addUserForm").serialize(); // Serialize form data
    
        $.ajax({
            type: 'POST',
            url: 'http://nexalogix.nexabridge.net/api/users/create_user.php', // Adjust with the correct path
            data: formData,
            success: function(response) {
                // Handle success - maybe display a message or refresh the page
                console.log("User added successfully");
            },
            error: function() {
                // Handle error
                console.error("Error adding user");
            }
        });
    }

    loadUsers();
});
