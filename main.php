<?php
require_once "app/Tasks.php";
require_once "app/Todo.php";
$tasks = [];
$allTasks = new Tasks($tasks);
$show = new Todo($allTasks);
$allTasks->loadTasks("tasks.json");
$show->getTable();
while (true) {
    echo "1. Add a new task" . PHP_EOL . "2. Update task" . PHP_EOL . "3. Delete task" . PHP_EOL . "4. Exit" . PHP_EOL;
    $userAction = (int)readline("Enter your action: ");
    if ($userAction == 4) {
        $allTasks->saveTasks("tasks.json");
        exit("Thank you for playing!");
    }
    $show->chooseAction($userAction);
}