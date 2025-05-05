<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $req)
    {
        $users = User::withCount([
            'tasks as total',
            'tasks as completed_count'=>fn($q)=> $q->where('status','completed'),
            'tasks as pending_count'=>fn($q)=> $q->where('status','pending')
        ])->paginate(10);

        return response()->json($users);
    }
}