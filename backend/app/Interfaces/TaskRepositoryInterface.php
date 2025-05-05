<?php
namespace App\Interfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function allByUser(int $userId);
    public function create(array $data): Task;
    public function update(Task $task, array $data): bool;
    public function delete(Task $task): bool;
    public function reorder(array $orderMap): void;
}