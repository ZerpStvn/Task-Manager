<?php
namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskRepository implements TaskRepositoryInterface
{
    public function allByUser(int $userId)
    {
        return Cache::remember("tasks:$userId", 60, fn() =>
            Task::where('user_id', $userId)
                ->orderBy('order')
                ->get()
        );
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }

    public function reorder(array $orderMap): void
    {
        foreach ($orderMap as $id => $order) {
            Task::where('id', $id)->update(['order' => $order]);
        }
    }
}