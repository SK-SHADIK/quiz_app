<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Question Answer</title>
        <link rel="stylesheet" href="{{asset('css/crud.css')}}">
    </head>

    <body>
        @include('Admin.Layouts.navbar')
        <section class="crud-create-section">
            <a href="{{route('question.answer')}}" class="crud-back-button">Back</a>
            <h1 class="create-crud-title">Edit A Question Answer</h1>
           

            <div class="crud-create-form">
                <form action="{{route('update.question.answer')}}" method="POST"  class="create-form">
                    @csrf

                    <label for="id" class="create-form-label">Id</label>
                    <input readonly class="create-form-input" name="id" id="id" value="{{$questionAnswer['id']}}">

                    <label for="question" class="create-form-label">Question</label>
                    <input type="text" class="create-form-input" name="question" id="question" value="{{$questionAnswer['question']}}"
                        placeholder="Enter Question">
                    @error('question')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="option_a" class="create-form-label">Option A</label>
                    <input type="text" class="create-form-input" name="option_a" id="option_a" value="{{$questionAnswer['option_a']}}"
                        placeholder="Enter Option A">
                    @error('option_a')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="option_b" class="create-form-label">Option B</label>
                    <input type="text" class="create-form-input" name="option_b" id="option_b" value="{{$questionAnswer['option_b']}}"
                        placeholder="Enter Option B">
                    @error('option_b')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="option_c" class="create-form-label">Option C</label>
                    <input type="text" class="create-form-input" name="option_c" id="option_c" value="{{$questionAnswer['option_c']}}"
                        placeholder="Enter Option C">
                    @error('option_c')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="option_d" class="create-form-label">Option D</label>
                    <input type="text" class="create-form-input" name="option_d" id="option_d" value="{{$questionAnswer['option_d']}}"
                        placeholder="Enter Option D">
                    @error('option_d')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="correct_answer" class="create-form-label">Corect Answer</label>
                    <input type="text" class="create-form-input" name="correct_answer" id="correct_answer" value="{{$questionAnswer['correct_answer']}}"
                        placeholder="Enter Correct Answer">
                    @error('correct_answer')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="marks" class="create-form-label">Marks</label>
                    <input type="number" class="create-form-input" name="marks" id="marks"
                        placeholder="Enter Marks For This Question" value="{{$questionAnswer['marks']}}">
                    @error('marks')
                        <span class="error">{{$message}}</span><br>
                    @enderror
                    <label for="is_active" class="create-form-label">Is Active</label>
                    <label class="switch">
                        <input type="checkbox" class="toggle-switch" name="is_active" id="is_active" value="1"  @if($questionAnswer['is_active']) checked @endif>
                        <span class="slider round"></span>
                    </label>

                    <button class="create-form-button">Update</button>
                </form>
            </div>
        </section>
    </body>

</html>
