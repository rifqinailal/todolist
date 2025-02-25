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

        // $apiUrl = "http://localhost:8081/tasks";
        // $client = \Config\Services::curlrequest();
        // $response = $client->get($apiUrl);
        // $data['tasks'] = json_decode($response->getBody(), true);

        // return view('home', $data);
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
        // $apiUrl = "http://localhost:8081/task/create";
        // $client = \Config\Services::curlrequest();
        // $title = $this->request->getPost("title");
        // $description = $this->request->getPost("description");
        // $deadline = $this->request->getPost("deadline"); // Format: YYYY-MM-DD

        // $formattedDate = date('Y-m-d', strtotime($deadline));

        // $data = [
        //     "title" => $title,
        //     "description" => $description,
        //     "deadline" => $formattedDate
        // ];

        // $response = $client->post($apiUrl, [
        //     "json" => $data,
        //     "http_errors" => false
        // ]);

        // return redirect()->to('/');
    }

    public function delete($id)
    {
        $tasksModel = new TasksModel();
        $tasksModel->find($id);
        $tasksModel->delete($id);

        return redirect()->to('');
    //     $apiUrl = "http://localhost:8081/task/delete/" . $id;
    //     $client = \Config\Services::curlrequest();

    //     try {
    //         $response = $client->delete($apiUrl);

    //         return redirect('/');
    //     } catch (\Exception $e) {

    //         return redirect()->to('/');
    //     }
     }

    public function update($id)
    {
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

        // $apiUrl = "http://localhost:8081/task/update/" . $id;
        // $client = \Config\Services::curlrequest();

        // $title = $this->request->getPost("title");
        // $description = $this->request->getPost("description");
        // $deadline = $this->request->getPost("deadline");
        // $status = $this->request->getPost("status");

        // $formattedDate = date('Y-m-d', strtotime($deadline));

        // $data = [
        //     "title" => $title,
        //     "description" => $description,
        //     "deadline" => $formattedDate,
        //     "status" => $status
        // ];

        // $response = $client->put($apiUrl, [
        //     "json" => $data,
        //     "http_errors" => false
        // ]);

        // return redirect()->to('/');
    }

    public function updateStatus($id)
    {
        $tasksModel = new TasksModel();
        $task = $tasksModel->find($id);

        $newStatus = ($task['status'] == 'pending') ? 'completed' : 'pending';

        $tasksModel->save([
            'id' => $id,
            'status' => $newStatus
        ]);

        return redirect()->to('');
    }

    public function pending(){
        $tasksModel = new TasksModel();
        $tasks = $tasksModel->where('status', 'pending')
        ->orderBy('deadline', 'ASC') 
        ->findAll();

        $data = [
            'tasks' => $tasks
        ];

        return view('pending', $data);
    }

    public function completed(){
        $tasksModel = new TasksModel();
        $tasks = $tasksModel->where('status', 'completed')
        ->orderBy('deadline', 'ASC') 
        ->findAll();

        $data = [
            'tasks' => $tasks
        ];

        return view('completed', $data);
    }
}
