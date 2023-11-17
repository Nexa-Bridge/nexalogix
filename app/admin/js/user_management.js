$(document).ready(function() {
    // Charger la liste des utilisateurs au chargement de la page
    loadUsers();

    // Ajouter un utilisateur
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/app/api/users/add_user.php', // Votre script PHP pour ajouter un utilisateur
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                loadUsers(); // Recharger la liste après ajout
            }
        });
    });

    // Fonction pour charger et afficher les utilisateurs
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get_users.php', // Votre script PHP pour obtenir les utilisateurs
            success: function(response) {
                let users = JSON.parse(response); // Assumer que la réponse est en JSON
                let html = '';
                users.forEach(user => {
                    html += `<tr>
                                <td>${user.UserID}</td>
                                <td>${user.Username}</td>
                                <td>${user.Email}</td>
                                <td>
                                    <!-- Ajouter des boutons ou des liens pour la mise à jour/suppression -->
                                </td>
                             </tr>`;
                });
                $('#usersTable tbody').html(html);
            }
        });
    }
    

    // Ajouter ici des fonctions pour la mise à jour et la suppression...
    // Vous pouvez utiliser des approches similaires pour ces actions.
});