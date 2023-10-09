<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="{{ asset('css/crud.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="deleteConfirmationPopup" class="delete-confirmation-popup">
        <div class="popup-content">
            <p class="popup-text">Are you sure you want to delete?</p>
            <form method="POST" id="deleteForm" action="">
                @csrf
                <button type="submit" id="confirmDeleteButton" class="confirm-delete-button">Delete</button>
            </form>
            <button id="cancelDeleteButton" class="cancel-delete-button">Cancel</button>
        </div>
    </div>

    @include('Admin.Layouts.navbar')
    <section class="crud-section">
        @if (session('success'))
            <div class="success-message">
                <span class="success-icon"></span>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                <span class="error-icon"></span>{{ session('error') }}
            </div>
        @endif

        <h1 class="crud-header">User List</h1>
        <div class="crud-top">
            <div class="crud-search">
                <form method="GET" action="{{ route('search.user') }}" class="crud-search-form">
                    <input type="text" name="search" class="crud-search-input" placeholder="Search Here">
                    <button type="submit" class="crud-search-button">Search</button>
                </form>
            </div>

            <a href="{{ route('create.user') }}" class="crud-create-button">Create A User</a>
        </div>
        <div class="crud-table-section">
            <table class="crud-table">
                <thead>
                    <tr class="crud-table-headers">
                        <th class="crud-table-header">
                            <a href="{{ route('sort.id.user', ['sort_column' => 'id', 'sort_order' => 'asc']) }}">Id
                                <img class="sorting-icon" src="{{ asset('img/sorting.png') }}" alt=""></a>
                        </th>
                        <th class="crud-table-header">Name</th>
                        <th class="crud-table-header">Email</th>
                        <th class="crud-table-header">Phone</th>
                        <th class="crud-table-header">Address</th>
                        <th class="crud-table-header">Date Of Birth</th>
                        <th class="crud-table-header">Gender</th>
                        <th class="crud-table-header">User Type</th>
                        <th class="crud-table-header">Is Active</th>
                        <th class="crud-table-header" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($hasData)
                        @foreach ($users as $user)
                            <tr class="crud-table-body">
                                <td class="crud-table-row">{{ $user['id'] }}</td>
                                <td class="crud-table-row">{{ $user['name'] }}</td>
                                <td class="crud-table-row">{{ $user['email'] }}</td>
                                <td class="crud-table-row">{{ $user['phone'] }}</td>
                                <td class="crud-table-row">{{ $user['address'] }}</td>
                                <td class="crud-table-row">{{ $user['dob'] }}</td>
                                <td class="crud-table-row">{{ $user['gender'] }}</td>
                                <td class="crud-table-row">{{ $user['user_type'] }}</td>
                                <td class="crud-table-row">
                                    <form method="POST"
                                        action="{{ route('active.deactive.users', ['id' => $user['id']]) }}">
                                        @csrf
                                        @method('POST')
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-switch" name="is_active" value="1"
                                                @if ($user['is_active']) checked @endif
                                                onchange="this.form.submit()">
                                            <span class="slider round"></span>
                                        </label>
                                    </form>
                                </td>

                                <td class="crud-table-row" colspan="3"><a
                                        href="/quiz-app/admin/view-users/{{ $user['id'] }}"
                                        class="crud-view-button">View</a>
                                    <a href="/quiz-app/admin/edit-users/{{ $user['id'] }}"
                                        class="crud-edit-button">Edit</a>
                                    <a href="#" class="crud-delete-button"
                                        data-users-id="{{ $user['id'] }}">Delete</a>
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
                @if ($users->previousPageUrl())
                    <a href="{{ $users->previousPageUrl() }}" class="pagination-button">Previous</a>
                @endif

                <span class="pagination-info">Page {{ $users->currentPage() }} of
                    {{ $users->lastPage() }}</span>

                <div class="pagination-pages">
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                        @if ($i == $users->currentPage())
                            <span class="current-page">{{ $i }}</span>
                        @else
                            <a href="{{ $users->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor
                </div>

                @if ($users->nextPageUrl())
                    <a href="{{ $users->nextPageUrl() }}" class="pagination-button">Next</a>
                @endif
            </div>

        </tfoot>

    </section>


    <script>
        let deleteButtons = document.querySelectorAll('.crud-delete-button');
        let deleteConfirmationPopup = document.getElementById('deleteConfirmationPopup');
        let confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let cancelDeleteButton = document.getElementById('cancelDeleteButton');


        // Add event listener to all delete buttons using event delegation
        document.body.addEventListener('click', function(event) {
            if (event.target.classList.contains('crud-delete-button')) {
                event.preventDefault();

                // Get the users ID from the data attribute
                let usersId = event.target.getAttribute('data-users-id');

                // Set the action URL of the delete form dynamically
                let deleteForm = document.getElementById('deleteForm');
                deleteForm.action = `/quiz-app/admin/delete-users/${usersId}`;

                // Show the confirmation popup
                deleteConfirmationPopup.style.display = 'flex';
            }
        });

        // Add event listener to confirm delete button
        confirmDeleteButton.addEventListener('click', () => {
            // Perform the delete action here (you can customize this logic)
            console.log('Deleting item at index:', currentItemToDelete);

            // Close the confirmation popup
            deleteConfirmationPopup.style.display = 'none';
        });

        // Add event listener to cancel delete button
        cancelDeleteButton.addEventListener('click', () => {
            // Close the confirmation popup
            deleteConfirmationPopup.style.display = 'none';
        });
    </script>
</body>

</html>
