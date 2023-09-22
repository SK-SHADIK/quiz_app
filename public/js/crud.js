let toggleSwitches = document.querySelectorAll('.toggle-switch');
let deleteButtons = document.querySelectorAll('.crud-delete-button');
let deleteConfirmationPopup = document.getElementById('deleteConfirmationPopup');
let confirmDeleteButton = document.getElementById('confirmDeleteButton');
let cancelDeleteButton = document.getElementById('cancelDeleteButton');

let currentItemToDelete = null;

// Add event listeners to delete buttons
deleteButtons.forEach((deleteButton, index) => {
    deleteButton.addEventListener('click', (event) => {
        // Prevent the default click behavior of anchor elements
        event.preventDefault();

        // Store the item to delete (you can customize this logic)
        currentItemToDelete = index;
        // Show the confirmation popup
        deleteConfirmationPopup.style.display = 'flex';
    });
});

// Add event listener to confirm delete button
confirmDeleteButton.addEventListener('click', () => {
    if (currentItemToDelete !== null) {
        // Perform the delete action here (you can customize this logic)
        console.log('Deleting item at index:', currentItemToDelete);

        // Close the confirmation popup
        deleteConfirmationPopup.style.display = 'none';
        currentItemToDelete = null;
    }
});

// Add event listener to cancel delete button
cancelDeleteButton.addEventListener('click', () => {
    // Close the confirmation popup
    deleteConfirmationPopup.style.display = 'none';
    currentItemToDelete = null;
});