document.addEventListener('DOMContentLoaded', function() {
    // Load users when the page is ready
    loadUsers();

    // Add event listener for user form submission (if applicable)
    // Example: document.getElementById('userForm').addEventListener('submit', handleFormSubmit);
});

function loadUsers() {
    $.ajax({
        url: '../php/user_actions.php', 
        type: 'POST',
        data: { action: 'read' },
        success: function(response) {
            console.log("AJAX Response:", response); // Check the AJAX response
            populateUserTable(JSON.parse(response));
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", xhr.responseText);
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
