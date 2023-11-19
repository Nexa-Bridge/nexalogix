$(document).ready(function() {
    // Fonction pour charger et afficher les utilisateurs
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get_user.php', // Script PHP pour obtenir les utilisateurs
            success: function(response) {
                // Supposition que la réponse est en JSON
                let users = JSON.parse(response);
                let html = '';
                users.forEach(user => {
                    html += `<tr>
                                <td>${user.UserID}</td>
                                <td>${user.Username}</td>
                                <td>${user.Email}</td>
                                <td>
                                    <!-- Ici, vous pouvez ajouter des boutons ou des liens pour la mise à jour/suppression -->
                                </td>
                             </tr>`;
                });
                $('#usersTable tbody').html(html);
            },
            error: function() {
                alert("Erreur lors du chargement des utilisateurs.");
            }
        });
    }

    // Charger la liste des utilisateurs au démarrage de la page
    loadUsers();

    // Ici, vous pouvez ajouter d'autres fonctions pour la création, la mise à jour et la suppression des utilisateurs
});
