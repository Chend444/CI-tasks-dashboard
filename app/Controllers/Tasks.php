<?php

namespace App\Controllers;
use App\Models\TaskModel;
use CodeIgniter\Controller;
use Carbon\Carbon;
use CodeIgniter\Log\Logger;


class Tasks extends Controller
{

    protected $request;
    protected TaskModel $task;
    protected array $editRule;
    protected array $creationRule;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->task = new TaskModel();

        $this->creationRule = [
            'name' => 'required|max_length[32]',
            'text' => 'required|max_length[255]',
            'status' => 'required|max_length[16]',
            'due_date' => 'required|valid_date[Y-m-d]',
        ];
        $this->editRule = [
            'text' => 'required|max_length[255]',
            'status' => 'required|max_length[16]',
        ];
    }

    public function index()
    {
        $task = new TaskModel();
        $data['tasks'] = $task->findAll();
        return view('tasks/header')
            . view('tasks/table', $data)
            . view('tasks/footer');
    }

    public function create()
    {
        $tmpArray = $this->request->getJSON();
        $validateData = json_decode(json_encode($tmpArray), true);
        if (!$this->validateData($validateData, $this->creationRule)) {
            $error = $this->validator->getErrors();
            return $this->response->setStatusCode(400)->setJSON(["error"=>$error]);
        }
        $data = [
            "name" => $tmpArray->name,
            "text" => $tmpArray->text,
            "status" => $tmpArray->status,
            "due_date" => Carbon::createFromDate($tmpArray->due_date)->format("Y-m-d"),
        ];

        $res = $this->task->insert($data);
        if (!$res) {
            return $this->response->setStatusCode(400)->setJSON(["error" => "something went wrong, update failed"]);
        }
        return $this->response->setStatusCode(200);
    }

    public function update($id)
    {
        $existedTask = $this->checkIfTaskExist($id);
        if (!$existedTask) {
            return $this->response->setStatusCode(400)->setJSON(["error"=>"task does not exist"]);
        }

        $tmpArray = $this->request->getJSON();
        $validateData = json_decode(json_encode($tmpArray), true);
        if (!$this->validateData($validateData, $this->editRule)) {
            $error = $this->validator->getErrors();
            return $this->response->setStatusCode(400)->setJSON(["error"=>$error]);
        }

        $data = [
            "text" => $validateData['text'],
            "status" => $validateData['status'],
        ];
        $res = $this->task->update($id, $data);
        if (!$res) {
            return $this->response->setStatusCode(400)->setJSON(["error" => "something went wrong, update failed"]);
        }
        return $this->response->setStatusCode(200);

    }

    public function delete($id)
    {
        $existedTask = $this->checkIfTaskExist($id);
        if (!$existedTask) {
            return $this->response->setStatusCode(400)->setJSON(["error" => "task does not exist"]);
        }
        $dt = Carbon::now();
        if ($dt->diffInDays($existedTask['due_date']) <= 6) {
            return $this->response->setStatusCode(400)->setJSON(["error" => "due date is less then 6 days, can't not delete task"]);
        }
        $res = $this->task->delete($id);
        if (!$res) {
            return $this->response->setStatusCode(400)->setJSON(["error" => "something went wrong, delete failed"]);
        }
        return $this->response->setStatusCode(200);

    }

    function checkIfTaskExist($id)
    {
        $existedTask = $this->task->find($id);
        if (!$existedTask) {
            return false;
        }
        return $existedTask;
    }


}
