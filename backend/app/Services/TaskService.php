<?php
namespace App\Services;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskService
{
    public function __construct(private TaskRepositoryInterface $repo) {}

    public function list($userId, $filters = [])
    {
        $query = Task::where('user_id', $userId);
        if (isset($filters['status'])) {
            $query->status($filters['status']);
        }
        if (isset($filters['priority'])) {
            $query->priority($filters['priority']);
        }
        return $query->orderBy('order')->get();
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update(Task $task, array $data)
    {
        return $this->repo->update($task, $data);
    }

    public function delete(Task $task)
    {
        return $this->repo->delete($task);
    }

    public function reorder(array $orderMap)
    {
        $this->repo->reorder($orderMap);
    }
}