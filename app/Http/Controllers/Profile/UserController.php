<?php

namespace App\Http\Controllers\Profile;

use Symfony\Component\HttpFoundation\Response;

use App\Http\Controllers\Controller;
use App\Models\Administrator\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user_profile = User::findOrFail($id);
        $user_profile->name = $request->name;
        $user_profile->username = $request->username;
        if ($request->password != null) {
            $user_profile->password = bcrypt($request->password);
        }
        if ($request->hasFile('avatar')) {
            if ($user_profile->avatar != "avatar-default.png") {
                File::delete(public_path('assets/image/avatar/' . $user_profile->avatar));
            }
            $nama_gambar = $request->username . "_" . time() . "." . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('assets/image/avatar/'), $nama_gambar);
            $user_profile->avatar = $request->username . "_" . time() . "." . $request->file('avatar')->getClientOriginalExtension();
        }
        $user_profile->save();

        return response("Data berhasil diubah");
    }

    public function edit($id)
    {
        $profile_user = User::findOrFail($id);
        return response()->json([
            'data' => $profile_user
        ], Response::HTTP_OK);
    }
}
