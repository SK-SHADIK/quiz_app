<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Answer</title>
    <link rel="stylesheet" href="{{asset('css/crud.css')}}">
</head>

<body>
<div id="deleteConfirmationPopup" class="delete-confirmation-popup">
    <div class="popup-content">
        <p class="popup-text">Are you sure you want to delete?</p>
        <a id="confirmDeleteButton" class="confirm-delete-button">Delete</a>
        <button id="cancelDeleteButton" class="cancel-delete-button">Cancel</button>
    </div>
</div>
@include('Admin.Layouts.navbar')
<section class="crud-section">
    @if(session('success'))
        <div class="success-message">
            <span class="success-icon"></span>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            <span class="error-icon"></span>{{ session('error') }}
        </div>
    @endif

    <h1 class="crud-header">Question Answer List</h1>
    <div class="crud-top">
        <div class="crud-search">
            <input type="text" class="crud-search-input" placeholder="Search Here"><button
                class="crud-search-button">Search</button>
        </div>
        <a href="{{route('create.question.answer')}}" class="crud-create-button">Create A Question Answer</a>
    </div>
    <div class="crud-table-section">
        <table class="crud-table">
            <thead>
            <tr class="crud-table-headers">
                <th class="crud-table-header">Id</th>
                <th class="crud-table-header">Question</th>
                <th class="crud-table-header">Option A</th>
                <th class="crud-table-header">Option B</th>
                <th class="crud-table-header">Option C</th>
                <th class="crud-table-header">Option D</th>
                <th class="crud-table-header">Correct Answer</th>
                <th class="crud-table-header">Marks</th>
                <th class="crud-table-header">Is Active</th>
                <th class="crud-table-header" colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @if ($hasData)
                @foreach($questionAnswers as $questionAnswer)
                    <tr class="crud-table-body">
                        <td class="crud-table-row">{{$questionAnswer['id']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['question']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['option_a']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['obtion_b']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['option_c']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['option_d']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['correct_answer']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['marks']}}</td>
                        <td class="crud-table-row" data-is-active="{{$questionAnswer['is_active']}}">
                            <label class="switch">
                                <input type="checkbox" class="toggle-switch">
                                <span class="slider round"></span>
                            </label>
                        </td>

                        <td class="crud-table-row" colspan="3"><a href="" class="crud-view-button">View</a><a
                                href="" class="crud-edit-button">Edit</a><a href=""
                                                                          class="crud-delete-button">Delete</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td style="color: orange;">No Data Found!!!</td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <tfoot>
        <div class="custom-pagination">
            @if ($questionAnswers->previousPageUrl())
                <a href="{{ $questionAnswers->previousPageUrl() }}" class="pagination-button">Previous</a>
            @endif

            <span class="pagination-info">Page {{ $questionAnswers->currentPage() }} of {{ $questionAnswers->lastPage() }}</span>

            @if ($questionAnswers->nextPageUrl())
                <a href="{{ $questionAnswers->nextPageUrl() }}" class="pagination-button">Next</a>
            @endif
        </div>
    </tfoot>
</section>
</body>
</html>

<script>
 // Update the JavaScript code
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
    
    // ...
// Initialize toggle switch state based on data attribute
toggleSwitches.forEach((toggleSwitch, index) => {
    const isActive = toggleSwitch.parentElement.parentElement.getAttribute('data-is-active');
    toggleSwitch.checked = isActive === 'true';
    console.log(`Toggle switch at index ${index} initialized with isActive = ${isActive}`);
});

// Add event listener to handle toggle switch state changes
toggleSwitches.forEach((toggleSwitch, index) => {
    toggleSwitch.addEventListener('change', () => {
        // Get the updated state of the toggle switch
        const isActive = toggleSwitch.checked;
        
        // Log the updated state for debugging
        console.log(`Toggle switch at index ${index} state changed to: ${isActive}`);
        
        // Update the "is_active" value in your database here
        // You can send an AJAX request to update the value on the server
    });
});

</script>