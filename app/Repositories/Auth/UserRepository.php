<?php

namespace App\Repositories\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserRepository {

    public function getAll() {

        return User::all();

    }

    public function getWhere(array $where) {

        return User::where($where)->get();

    }

    public function getOne(int $id) {

        return User::find($id);

    }

    public function create(object $data) {

        $user = new User();

        $user->name = $data->name;
        $user->email = $data->email;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($data->password);

        $user->save();

    }

    public function updateUser(object $data): bool {

        $user = $this->getOne($data->id);

        $user->name = $data->name;
        $user->email = $data->email;

        $user->save();

    }

    public function dropUser(int $id): bool {

        $user = $this->getOne($id);

        $user->delete();

    }

}
