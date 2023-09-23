<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Question Answer</title>
        <link rel="stylesheet" href="{{asset('css/crud.css')}}">
    </head>

    <body>
        @include('Admin.Layouts.navbar')
        <section class="crud-create-section">
            <a href="{{route('show.question.answer')}}" class="crud-back-button">Back</a>
            <h1 class="create-crud-title">Question Answer</h1>
           

            <div class="crud-create-form">
                <form action="{{route('store.question.answer')}}" method="POST"  class="create-form">
                    @csrf

                    <label for="id" class="create-form-label">Id</label>
                    <input readonly class="create-form-input" name="id" id="id" value="{{$questionAnswer['id']}}">

                    <label for="question" class="create-form-label">Question</label>
                    <input readonly class="create-form-input" name="question" id="question" value="{{$questionAnswer['question']}}">
                    
                    <label for="option_a" class="create-form-label">Option A</label>
                    <input readonly class="create-form-input" name="option_a" id="option_a" value="{{$questionAnswer['option_a']}}">
                   
                    <label for="option_b" class="create-form-label">Option B</label>
                    <input readonly class="create-form-input" name="option_b" id="option_b" value="{{$questionAnswer['option_b']}}">
                   
                    <label for="option_c" class="create-form-label">Option C</label>
                    <input readonly class="create-form-input" name="option_c" id="option_c" value="{{$questionAnswer['option_c']}}">
                   
                    <label for="option_d" class="create-form-label">Option D</label>
                    <input readonly class="create-form-input" name="option_d" id="option_d" value="{{$questionAnswer['option_d']}}">
                   
                    <label for="correct_answer" class="create-form-label">Corect Answer</label>
                    <input readonly class="create-form-input" name="correct_answer" id="correct_answer" value="{{$questionAnswer['correct_answer']}}">
                   
                    <label for="marks" class="create-form-label">Marks</label>
                    <input readonly class="create-form-input" name="marks" id="marks" value="{{$questionAnswer['marks']}}">
                    
                    <label for="is_active" class="create-form-label">
    Is Active
</label>
<label class="switch">
    <input readonly class="toggle-switch" name="is_active" id="is_active" value="{{$questionAnswer['is_active']}}">
    <p class="{{$questionAnswer['is_active'] ? 'active' : 'inactive'}}">{{$questionAnswer['is_active'] ? 'Active' : 'Inactive'}}</p>
</label>




                </form>
            </div>
        </section>
    </body>

</html>
