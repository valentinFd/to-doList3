<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tasks</title>
    </head>
    <body>
        <ul>
            @foreach($tasks as $task)
                <li>{{ $task->description }}</li>
            @endforeach
        </ul>
    </body>
</html>
