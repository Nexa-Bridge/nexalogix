$action = 'read';

document.addEventListener('DOMContentLoaded', function() {
    // Load users when the page is ready
    loadUsers();

    // Optionally, add an event listener for a button click
    var loadButton = document.getElementById('loadUsersButton');
    if (loadButton) {
        loadButton.addEventListener('click', loadUsers);
    }
});
$action = 'read';

function loadUsers(sortColumn, sortOrder) {
    $.ajax({
        url: '/app/user_actions.php',
        type: 'POST',
        data: { action: 'read', sortColumn: sortColumn, sortOrder: sortOrder },
        success: function(response) {
            console.log("Response:", response); // Check the response
            populateUserTable(JSON.parse(response));
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: Status -", status, "Error -", error);
            console.error("Response Text:", xhr.responseText);
        
            // Pour plus de détails
            console.error("Full XHR Object:", xhr);
        }
    });
}

// Add other functions (populateUserTable, createUser, etc.) as needed



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

function sortTable(columnName) {
    let table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("userTableBody");
    switching = true;

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 0; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[columnName];
            y = rows[i + 1].getElementsByTagName("TD")[columnName];
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

