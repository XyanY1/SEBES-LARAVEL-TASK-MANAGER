<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        textarea {
            height: 120px;
        }

        button,
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #f59e0b;
            color: white;
        }

        a {
            background: #666;
            color: white;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Task</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('tasks.update', $task->id) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <label>Task Name</label>

        <input
            type="text"
            name="task_name"
            value="{{ old('task_name', $task->task_name) }}"
            required
        >

        <label>Description</label>

        <textarea name="description">{{ old('description', $task->description) }}</textarea>

        <label>Status</label>

        <select name="status">

            <option
                value="Pending"
                {{ $task->status === 'Pending' ? 'selected' : '' }}
            >
                Pending
            </option>

            <option
                value="Completed"
                {{ $task->status === 'Completed' ? 'selected' : '' }}
            >
                Completed
            </option>

        </select>

        <label>Due Date</label>

        <input
            type="date"
            name="due_date"
            value="{{ old('due_date', $task->due_date) }}"
        >

        <button type="submit">
            Update Task
        </button>

        <a href="{{ route('tasks.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>
</html>