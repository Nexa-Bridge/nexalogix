


document.addEventListener('DOMContentLoaded', function() {
    // Load users when the page is ready
    loadUsers();

    // Add event listeners for user form submissions, etc.
    // Example: document.getElementById('userForm').addEventListener('submit', createUser);
});

function loadUsers() {
    $.ajax({
        url: 'user_actions.php',
        type: 'POST',
        data: { action: 'read' },
        success: function(response) {
            console.log(response); // Check the response that you get from the server
            populateUserTable(JSON.parse(response));
        },
        error: function(xhr, status, error) {
            console.error("Error loading users:", xhr.responseText);
        }
    });
}

function populateUserTable(users) {
    let tableBody = document.getElementById('userTableBody');
    tableBody.innerHTML = '';

    users.forEach(function(user) {
        let row = tableBody.insertRow();
        row.insertCell(0).innerText = user.UserID;
        row.insertCell(1).innerText = user.Username;
        row.insertCell(2).innerText = user.Email;
        row.insertCell(3).innerText = user.Roles; // Add this line to display roles
        let actionsCell = row.insertCell(4);
        // Add buttons for actions
    });
}


function createUser(event) {
    event.preventDefault();
    // Get form data and send a create request
    // Example: var formData = new FormData(document.getElementById('userForm'));
    // Then send formData with an AJAX request to 'user_actions.php' with action: 'create'
}

function updateUser(event, userId) {
    event.preventDefault();
    // Similar to createUser, but for updating
}

function deleteUser(userId) {
    // Send a delete request for the user
    // Example: data: { action: 'delete', id: userId }
}

// Helper functions to create edit and delete buttons
function createEditButton(userId) {
    let btn = document.createElement('button');
    btn.className = 'btn btn-primary';
    btn.innerText = 'Edit';
    btn.addEventListener('click', function() {
        // Code to handle edit - populate form fields and show modal
    });
    return btn;
}

function createDeleteButton(userId) {
    let btn = document.createElement('button');
    btn.className = 'btn btn-danger';
    btn.innerText = 'Delete';
    btn.addEventListener('click', function() {
        if(confirm('Are you sure you want to delete this user?')) {
            deleteUser(userId);
        }
    });
    return btn;
}
