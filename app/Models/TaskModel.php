<?php

namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'tasks';
    protected $allowedFields = ['name','text','status','due_date'];
    protected $primaryKey = 'id';

}