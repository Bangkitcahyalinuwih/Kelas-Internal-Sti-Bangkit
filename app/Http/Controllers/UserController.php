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
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }   
            $table_title = 'Table User';
            $title = 'Data User';
            $data_user = User::all();
            return view('admin.user.list', compact('data_user', 'title', 'table_title'));
    } 
    public function store(Request $request)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        } 

        // dd($request);
        $request->validate([    
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string'
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'role' => $request->role,
        ]);
        // dd($user);
        return redirect('user')->with('succes', 'Data user Berhasil');

    } 

    public function update(Request $request, $id)
    {   
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
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
        if (Auth::user()->role != 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
            }   
        $user = User::where('id', $id)->delete();
        return redirect('user')->with('success', 'Data Berhasil dihapus');
    }
}


