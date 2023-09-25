<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Answer</title>
    <link rel="stylesheet" href="{{asset('css/crud.css')}}">
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
           <form method="GET" action="{{ route('search.question.answer') }}" class="crud-search-form">
                <input type="text" name="search" class="crud-search-input" placeholder="Search Here">
                <button type="submit" class="crud-search-button">Search</button>
            </form>
        </div>

        <a href="{{route('create.question.answer')}}" class="crud-create-button">Create A Question Answer</a>
    </div>
    <div class="crud-table-section">
        <table class="crud-table">
            <thead>
            <tr class="crud-table-headers">
            <th class="crud-table-header" id="id-header">
    Id <button id="sort-id-button" class="sort-button"><img class="sorting-icon" src="{{ asset('img/sorting.png') }}" alt="">
</button>
</th>
                <th class="crud-table-header">Question</th>
                <th class="crud-table-header">Option A</th>
                <th class="crud-table-header">Option B</th>
                <th class="crud-table-header">Option C</th>
                <th class="crud-table-header">Option D</th>
                <th class="crud-table-header">Correct Answer</th>
                <th class="crud-table-header" id="marks-header">
    Marks <button id="sort-marks-button" class="sort-button"><img class="sorting-icon" src="{{ asset('img/sorting.png') }}" alt=""></button>
</th>
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
                        <td class="crud-table-row">{{$questionAnswer['option_b']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['option_c']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['option_d']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['correct_answer']}}</td>
                        <td class="crud-table-row">{{$questionAnswer['marks']}}</td>
                        <td class="crud-table-row">
                        <label class="switch">
                        <input type="checkbox" class="toggle-switch" name="is_active" id="is_active" value="1"  @if($questionAnswer['is_active']) checked @endif>
                        <span class="slider round"></span>
                    </label>
</td>
                        <td class="crud-table-row" colspan="3"><a href="/view-question-answer/{{$questionAnswer['id']}}" class="crud-view-button">View</a>
                        <a
                                href="/edit-question-answer/{{$questionAnswer['id']}}" class="crud-edit-button">Edit</a>
                                <a href="#" class="crud-delete-button" data-question-id="{{$questionAnswer['id']}}">Delete</a>

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

    <div class="pagination-pages">
        @for ($i = 1; $i <= $questionAnswers->lastPage(); $i++)
            @if ($i == $questionAnswers->currentPage())
                <span class="current-page">{{ $i }}</span>
            @else
                <a href="{{ $questionAnswers->url($i) }}">{{ $i }}</a>
            @endif
        @endfor
    </div>

    @if ($questionAnswers->nextPageUrl())
        <a href="{{ $questionAnswers->nextPageUrl() }}" class="pagination-button">Next</a>
    @endif
</div>

</tfoot>

</section>
</body>
</html>

<script>
    let deleteButtons = document.querySelectorAll('.crud-delete-button');
    let deleteConfirmationPopup = document.getElementById('deleteConfirmationPopup');
    let confirmDeleteButton = document.getElementById('confirmDeleteButton');
    let cancelDeleteButton = document.getElementById('cancelDeleteButton');
    

    // Add event listener to all delete buttons using event delegation
    document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('crud-delete-button')) {
            event.preventDefault();

            // Get the question ID from the data attribute
            let questionId = event.target.getAttribute('data-question-id');

            // Set the action URL of the delete form dynamically
            let deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/delete-question-answer/${questionId}`;

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



    
// JavaScript to handle sorting by the "Marks" column
let marksHeader = document.getElementById('marks-header');
let sortMarksButton = document.getElementById('sort-marks-button');
let ascendingOrderForMarks = true; // Initial sorting order is ascending

sortMarksButton.addEventListener('click', () => {
    // Get all the rows from the table body
    let tableBody = document.querySelector('.crud-table tbody');
    let rows = Array.from(tableBody.querySelectorAll('tr'));

    // Sort the rows based on the content of the "Marks" column
    rows.sort((a, b) => {
        let marksA = parseInt(a.querySelector('.crud-table-row:nth-child(8)').textContent);
        let marksB = parseInt(b.querySelector('.crud-table-row:nth-child(8)').textContent);

        if (ascendingOrderForMarks) {
            return marksA - marksB;
        } else {
            return marksB - marksA;
        }
    });

    // Reverse the sorting order for the next click
    ascendingOrderForMarks = !ascendingOrderForMarks;

    // Reorder the table rows
    rows.forEach(row => tableBody.appendChild(row));
});

// JavaScript to handle sorting by the "Id" column
let idHeader = document.getElementById('id-header');
let sortIdButton = document.getElementById('sort-id-button');
let ascendingOrderForId = true; // Initial sorting order is ascending

sortIdButton.addEventListener('click', () => {
    // Get all the rows from the table body
    let tableBody = document.querySelector('.crud-table tbody');
    let rows = Array.from(tableBody.querySelectorAll('tr'));

    // Sort the rows based on the content of the "Id" column
    rows.sort((a, b) => {
        let idA = parseInt(a.querySelector('.crud-table-row:first-child').textContent);
        let idB = parseInt(b.querySelector('.crud-table-row:first-child').textContent);

        if (ascendingOrderForId) {
            return idA - idB;
        } else {
            return idB - idA;
        }
    });

    // Reverse the sorting order for the next click
    ascendingOrderForId = !ascendingOrderForId;

    // Reorder the table rows
    rows.forEach(row => tableBody.appendChild(row));
});


</script>