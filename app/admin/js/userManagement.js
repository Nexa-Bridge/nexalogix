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

    function addUser() {
        alert('Button clicked');
    }

    loadUsers();
});
