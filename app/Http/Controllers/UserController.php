<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()  
    {   
        $data = array(
            'title' => 'data-user',
            'data_user' => User::all(),
        );
        return view('admin.user.list', $data);
    } 

    public function store(Request $request)
    {
        $request->validate([    
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => $request->role,
        ]);
        
        return redirect()->route('user')->with('succes', 'Data user Berhasil');

        // $validator = Validator::make($request->all(),  [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed'
        // ]);

        // if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        // $data['name'] = $request->name;
        // $data['email'] = $request->email;
        // $data['password'] = Hash::make($request->password);
        // $data['role'] = $request->role;
        // User::create($data);
        // return redirect()->route('user/list')->with('succes', 'Data user Berhasil');



        // try{    
        //     $adduser = new User();
        //     $adduser->name = $request->name;
        //     $adduser->email = $request->email;
        //     $adduser->password = Hash::make($request->password);
        //     $adduser->role = $request->role;
        //     $adduser->created_at = now();
        //     $adduser->save();
        //     dd($adduser);
        //     return redirect()->route('user/list')->with('succes', 'Data user Berhasil');

        // }catch(\Exception $e){
        //     return redirect()->route('user/list')->with('failed', $e->getMessage());
        // }

      
    } 

    public function update(Request $request, $id)
    {
        User::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect('user')->with('success', 'Data Berhasil diupdate');
    }

        public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect('user')->with('success', 'Data Berhasil dihapus');
    }
}


