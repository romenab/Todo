<?php
require_once 'vendor/autoload.php';

class Tasks
{
    private array $allTasks;

    public function __construct(array $allTasks)
    {
        $this->allTasks = $allTasks;
    }

    public function add(string $userTask): void
    {
        $completed = "-";
        $this->allTasks[] = ["id" => count($this->allTasks) + 1, "task" => $userTask, "completed" => $completed];
    }

    public function update(int $userId): void
    {
        foreach ($this->allTasks as &$task) {
            if ($task["id"] == $userId) {
                $task["completed"] = "+";
                break;
            }
        }
    }

    public function delete(int $userId): void
    {
        foreach ($this->allTasks as $key => $oneTask) {
            if ($oneTask['id'] == $userId) {
                unset($this->allTasks[$key]);
                break;
            }
        }
        $this->newId();
    }

    private function newId(): void
    {
        $this->allTasks = array_values($this->allTasks);
        foreach ($this->allTasks as $index => &$task) {
            $task["id"] = $index + 1;
        }
    }

    public function getAllTasks(): array
    {
        return $this->allTasks;
    }

    public function saveTasks(string $jsonFile): void
    {
        file_put_contents($jsonFile, json_encode($this->allTasks));
    }

    public function loadTasks(string $jsonFile): void
    {
        $this->allTasks = json_decode(file_get_contents($jsonFile), true);
    }
}
