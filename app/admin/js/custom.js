document.addEventListener('DOMContentLoaded', function() {
    // Load users when the page is ready
    loadUsers();

    // Optionally, add an event listener for a button click
    var loadButton = document.getElementById('loadUsersButton');
    if (loadButton) {
        loadButton.addEventListener('click', loadUsers);
    }
});

function loadUsers(sortColumn, sortOrder) {
    $.ajax({
        url: '/app/admin/php/user_actions.php', // Assurez-vous que cette URL est correcte
        type: 'POST',
        data: { action: 'read', sortColumn: sortColumn, sortOrder: sortOrder },
        success: function(response) {
            console.log("Response:", response); // Check the response
            try {
                let users = JSON.parse(response);
                populateUserTable(users);
            } catch (e) {
                console.error("Erreur lors de l'analyse JSON: ", e);
                // Gérer l'erreur de parsing ici (afficher un message à l'utilisateur, par exemple)
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: Status -", status, "Error -", error);
            console.error("Response Text:", xhr.responseText);
            // Pour plus de détails
            console.error("Full XHR Object:", xhr);
        }
    });
}


function populateUserTable(users) {
    const tableBody = document.getElementById('userTableBody');
    tableBody.innerHTML = ''; // Clear existing rows

    users.forEach(user => {
        const row = tableBody.insertRow();
        row.insertCell(0).innerText = user.UserID;
        row.insertCell(1).innerText = user.Username;
        row.insertCell(2).innerText = user.Email;
        row.insertCell(3).innerText = user.Role; // Assuming you have a Role column

        const actionsCell = row.insertCell(4);
        // Here, you can also add buttons or links for edit/delete actions
        actionsCell.appendChild(createEditButton(user.UserID));
        actionsCell.appendChild(createDeleteButton(user.UserID));
    });
}

function createEditButton(userId) {
    const btn = document.createElement('button');
    btn.className = 'btn btn-primary';
    btn.innerText = 'Edit';
    btn.onclick = function() { editUser(userId); };
    return btn;
}

function createDeleteButton(userId) {
    const btn = document.createElement('button');
    btn.className = 'btn btn-danger';
    btn.innerText = 'Delete';
    btn.onclick = function() { deleteUser(userId); };
    return btn;
}

function editUser(userId) {
    // Implement the logic to edit a user
    console.log("Edit user:", userId);
    // You might want to open a modal here for editing
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Implement the logic to delete a user
        console.log("Delete user:", userId);
        // Send an AJAX request to user_actions.php with action: 'delete' and the userId
    }
}

// Additional functions for handling form submissions, etc.
function handleFormSubmit(event) {
    event.preventDefault();
    // Logic to handle form submission
}

function sortTable(columnIndex) {
    let table = document.getElementById("userTableBody");
    let switching = true;
    let rows, i, x, y, shouldSwitch;

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[columnIndex];
            y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
