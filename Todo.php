<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

class Todo
{
    private Tasks $allTasks;

    public function __construct(Tasks $allTasks)
    {
        $this->allTasks = $allTasks;
    }

    public function getTable(): void
    {
        $output = new ConsoleOutput();
        $table = new Table($output);

        $table->setHeaders(['ID', 'Completed', 'Task']);

        foreach ($this->allTasks->getAllTasks() as $task) {
            $table->addRow([
                $task['id'],
                $task['completed'],
                $task['task'],
            ]);
        }
        $table->render();
    }


    public function chooseAction(string $userAction): void
    {
        switch ($userAction) {
            case 1:
                $userTask = readline("Enter your task: ");
                $this->allTasks->add($userTask);
                break;
            case 2:
                $userId = (int)readline("Enter task ID: ");
                $this->allTasks->update($userId);
                break;
            case 3:
                $userId = (int)readline("Enter task ID: ");
                $this->allTasks->delete($userId);
                break;
            case 4:
                exit;
            default:
                echo "Invalid input!" . PHP_EOL;
        }
        $this->getTable();
    }
}