<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(private TaskService $svc) {}

    public function index(Request $req)
    {
        $tasks = $this->svc->list($req->user()->id, $req->only('status','priority'));
        return response()->json($tasks);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'title'=>'required',
            'description'=>'nullable',
            'status'=>'in:pending,completed',
            'priority'=>'in:low,medium,high'
        ]);
        $data['user_id'] = $req->user()->id;
        $task = $this->svc->create($data);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $req, Task $task)
    {
        $data = $req->validate([
            'title'=>'sometimes|required',
            'description'=>'nullable',
            'status'=>'in:pending,completed',
            'priority'=>'in:low,medium,high'
        ]);
        $this->svc->update($task, $data);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $this->svc->delete($task);
        return response()->noContent();
    }

    public function reorder(Request $req)
    {
        $map = $req->validate(['order_map'=>'required|array'])['order_map'];
        $this->svc->reorder($map);
        return response()->json(['message'=>'Reordered']);
    }
}