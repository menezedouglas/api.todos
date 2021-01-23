<?php

namespace App\Repositories\ToDo;

use App\Models\Todos as Model;
use App\Models\User;

class Todos {

    public function getAll() {

        return Model::orderBy('fixed', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public function getOne(int $id) {

        return Model::find($id);

    }

    public function getByUser(int $user_id) {

        $user = User::find($user_id);

        return $user->todos()
            ->orderBy('fixed', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

    }

    public function createTodo(object $data) {

        $todo = new Model();

        $todo->user_id = auth()->user()->id;
        $todo->title = $data->title;
        $todo->description = $data->description;
        $todo->fixed = $data->fixed;

        $todo->save();

    }

    public function updateTodo(object $data) {

        $todo = $this->getOne($data->id);

        $todo->title = $data->title;
        $todo->description = $data->description;
        $todo->fixed = $data->fixed;

        $todo->save();

    }

    public function dropTodo(int $id) {

        $todo = $this->getOne($id);

        if(is_null($todo))
            abort(404, 'ToDo não encontrado');

        $todo->delete();

    }

}
