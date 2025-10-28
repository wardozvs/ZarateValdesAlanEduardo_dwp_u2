<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel To-Do List</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .header {
            background: #2564cf;
            color: white;
            padding: 20px 25px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 0;
        }
        .form-container {
            display: flex;
            padding: 20px 25px;
            background: #fdfdfd;
            border-bottom: 1px solid #eee;
        }
        .form-container input[type="text"] {
            flex-grow: 1;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            margin-right: 10px;
            transition: border-color 0.2s;
        }
        .form-container input[type="text"]:focus {
            outline: none;
            border-color: #2564cf;
        }
        .form-container button {
            background: #2564cf;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.2s;
        }
        .form-container button:hover {
            background: #1c4a9c;
        }
        .task-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .task-item {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }
        .task-item:last-child {
            border-bottom: none;
        }
        .task-item:hover {
            background: #f9f9f9;
        }
        .task-title {
            flex-grow: 1;
            font-size: 16px;
            margin-left: 15px;
        }
        .task-item.completed .task-title {
            text-decoration: line-through;
            color: #888;
        }
        .task-actions form {
            display: inline-block;
        }

        .btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            vertical-align: middle;
        }
        .btn:hover {
            transform: scale(1.1);
        }
        
        .material-symbols-outlined {
            font-size: 24px; 
            line-height: 1;
        }

        .btn-toggle {
            color: #2564cf;
            margin-right: 5px;
        }

        .btn-delete {
            color: #777;
        }
        .btn-delete:hover {
            color: #d9534f; 
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Mi Lista de Tareas</h1>
        </div>

        <div class="content">
            <div class="form-container">
                <form method="POST" action="{{ route('tasks.store') }}" style="display: flex; width: 100%;">
                    @csrf
                    <input type="text" name="title" placeholder="Agregar una nueva tarea..." required>
                    <button type="submit">Agregar</button>
                </form>
            </div>

            <div class="task-list">
                @forelse ($tasks as $task)
                    <div class="task-item {{ $task->is_completed ? 'completed' : '' }}">
                        
                        <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-toggle">
                                <span class="material-symbols-outlined">
                                    {{ $task->is_completed ? 'check_box' : 'check_box_outline_blank' }}
                                </span>
                            </button>
                        </form>

                        <span class="task-title">{{ $task->title }}</span>

                        <div class="task-actions">
                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="task-item">
                        <span>Aún no hay tareas. Agrega una desde arriba.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</body>
</html>