<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #222;
        }

        .navbar {
            background: #222;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .container {
            width: 85%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top h2 {
            font-size: 28px;
        }

        .btn {
            text-decoration: none;
            border: none;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }

        .btn-add {
            background: #2563eb;
        }

        .btn-edit {
            background: #f59e0b;
        }

        .btn-delete {
            background: #dc2626;
        }

        .btn-status {
            background: #16a34a;
        }

        .task-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .task-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .task-card h3 {
            margin-bottom: 10px;
        }

        .description {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .completed {
            background: #d1fae5;
            color: #065f46;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions form {
            display: inline;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 14px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Personal Task Manager</h1>
        <span>Laravel CRUD Project</span>
    </div>

    <div class="container">

        <div class="top">
            <h2>My Tasks</h2>

            <a href="{{ route('tasks.create') }}" class="btn btn-add">
                + Add Task
            </a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->count() > 0)

            <div class="task-grid">

                @foreach($tasks as $task)

                    <div class="task-card">

                        <h3>{{ $task->task_name }}</h3>

                        <p class="description">
                            {{ $task->description ?? 'No description provided.' }}
                        </p>

                        @if($task->status === 'Completed')
                            <span class="status completed">
                                Completed
                            </span>
                        @else
                            <span class="status pending">
                                Pending
                            </span>
                        @endif

                        <p>
                            <strong>Due Date:</strong>
                            {{ $task->due_date ?? 'No due date' }}
                        </p>

                        <br>

                        <div class="actions">

                            <a
                                href="{{ route('tasks.edit', $task->id) }}"
                                class="btn btn-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('tasks.status', $task->id) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-status"
                                >
                                    {{ $task->status === 'Pending'
                                        ? 'Complete'
                                        : 'Set Pending' }}
                                </button>
                            </form>

                            <form
                                action="{{ route('tasks.destroy', $task->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this task?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-delete"
                                >
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty">
                <h3>No tasks yet.</h3>
                <p>Create your first task!</p>
            </div>

        @endif

    </div>

</body>
</html>