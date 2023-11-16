<?php include('../includes/header.php'); // Adjust path as necessary ?>
<?php include('../includes/navbar.php'); // Adjust path as necessary ?>

    <div class="container mt-5">
        <h1>Gestion des Utilisateurs</h1>

        <!-- User Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- User data will be loaded here via AJAX -->
            </tbody>
        </table>

        <!-- Add/Edit User Modal -->
        <!-- Place modal code here for adding or editing users -->

        <!-- Include your modal for adding/editing users here -->
    </div>
    <?php include('../includes/footer.php'); // Adjust path as necessary ?>