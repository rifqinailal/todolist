<?php

namespace App\Models;

use CodeIgniter\Model;

class TasksModel extends Model
{
    protected $table            = 'Tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['title', 'description', 'status', 'deadline', 'created_at', 'updated_at'];
    

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
