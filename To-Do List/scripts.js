document.getElementById('add-task-btn').addEventListener('click', function() {
    let taskText = document.getElementById('new-task').value;

    if (taskText.trim() === "") {
        return;
    }

    let taskList = document.getElementById('task-list');

    let taskItem = document.createElement('li');
    taskItem.className = 'task-item';

    let taskTextElement = document.createElement('span');
    taskTextElement.textContent = taskText;

    let removeTaskButton = document.createElement('button');
    removeTaskButton.textContent = 'Remover';
    removeTaskButton.className = 'remove-task-btn';

    taskItem.appendChild(taskTextElement);
    taskItem.appendChild(removeTaskButton);

    taskList.appendChild(taskItem);

    document.getElementById('new-task').value = "";

    taskTextElement.addEventListener('click', function() {
        taskItem.classList.toggle('completed');
    });

    removeTaskButton.addEventListener('click', function() {
        taskList.removeChild(taskItem);
    });
});
