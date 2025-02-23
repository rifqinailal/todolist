<?php

namespace App\Controllers;

use App\Models\TasksModel;

class TodolistController extends BaseController
{
    public function index(): string
    {
        $tasksModel = new TasksModel();
        $tasks = $tasksModel->findAll();

        $data = [
            'tasks' => $tasks
        ];

        return view('home', $data);
    }

    public function create()
    {
        $tasksModel = new TasksModel();
        $tasksModel->save([
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'deadline' => $this->request->getVar('deadline'),
        ]);
        return redirect()->to('');
    }

    public function delete($id){
        $tasksModel = new TasksModel();
        $tasksModel->find($id);
        $tasksModel->delete($id);

        return redirect()->to('');
    }

    public function update($id){
        $tasksModel = new TasksModel();
        $tasksModel->find($id);
        $tasksModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
            'deadline' => $this->request->getVar('deadline')
            
        ]);

        return redirect()->to('');
    }

    public function updateStatus($id){
        $tasksModel = new TasksModel();
    $task = $tasksModel->find($id);
    
    // Toggle status
    $newStatus = ($task['status'] == 'Pending') ? 'Completed' : 'Pending';
    
    $tasksModel->save([
        'id' => $id,  // Penting! Harus menyertakan id
        'status' => $newStatus
    ]);
    
    return redirect()->to('');
    }
}
