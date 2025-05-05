<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','status','priority','order','user_id'
    ];

    public function scopeStatus($q, $status)
    {
        return $q->where('status', $status);
    }

    public function scopePriority($q, $pri)
    {
        return $q->where('priority', $pri);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}