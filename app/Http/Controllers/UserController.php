<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

// maintenance
    public function maintenance()
    {
        return view('maintenance.maintenance',['title' => 'Maintenance']);
    }

    public function fiturmaintenance()
    {
        return view('maintenance.fiturmaintenance',['title' => ' Fitur Maintenance']);
    }

    // register
    public function index()
    {
        $user = User::all();
        return view('register.index', ['users'=> $user, 'title' => 'Pengguna']);
    }

    public function register()
    {   
        $bidang = Bidang::all();
        $role = Role::all();
        
        return view('register.register', ['title' => 'Pengguna'], compact('bidang', 'role'));
    }

    public function store_register(Request $request){
        $validatedDate = $request->validate([
            'nip' => 'required|max:18',
            'username' => 'required',
            'nama' => 'required|max:255',
            'jabatan' => 'required',
            'nama_bidang' => 'required',
            'hak_akses' => 'required',
            'no_hp' => 'required',
            'email' => '',
            'image' => 'image|file|max:1024',
            'password' => 'required|min:6'
        ]);
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('images/profile/', $imageName);
            $data->image = $imageName;
        }
        $data->save();
        
        $password = bcrypt($request->password);
        $validatedDate['password'] = bcrypt($validatedDate['password']);

        User::create($validatedDate);
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan user!');

        return redirect('/index');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('register.show',['user'=> $user, 'title' => 'Pengguna']);
    }

    public function edit($id)
    {
        $edit = User::find($id);
        return view('register.edit',['user'=> $edit, 'title' => 'Pengguna']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            $user-> nip = $request->nip,
            $user-> nama = $request->nama,
            $user-> username = $request->username,
            $user-> jabatan = $request->jabatan,
            $user-> nama_bidang = $request->nama_bidang,
            $user-> hak_akses = $request->hak_akses,
            $user-> no_hp = $request->no_hp,
            $user-> email = $request->email,
            $user-> image = $request->image,
        ]);
        if($request->password != null){
            $password = bcrypt($request->password);
            $user->update([
                $user->password = $password
            ]);
        }
        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate Data!');

        return redirect('/index')->with('succes', 'New Post has been Added');
    }

    // login
    public function login()
    {
        return view('register.login',['title'=> 'login']);
    }

    public function authenticate(Request $request)
    {
       $credentials = $request->validate([
        'username'=>['required', 'max:255'],
        'password'=> ['required', 'max:100','min:6']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'username' => 'Login Failed, username or password may wrong',
        ])->onlyInput('username');
    }

    // logout
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }   

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/index')->with('succes', 'User has been deleted');
    }

    // delete
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        // $id->accepts(session());
        session()->flash('success', 'Pengguna Berhasil dihapus');
        
        return redirect('/index')->with('success', 'Pengguna berhasil dihapus');
    }

    public function editByUser($id){
        $user = User::find($id);
        return view('home.settings.account', ['user'=>$user, 'title' => 'Pengguna']);
    }
    
    public function updateByUser(Request $request, $id){
        // dd($request->image);
        $user = User::find($id);
        $email = $request->email;
        if ($request->filled('password')) {
            $password = bcrypt($request->password);
        }else {
            $password = $user->password;
        }
        $user->update([
            'password' => $password,
            'email' => $email,
        ]);
        
        $request->session()->flash('success', 'Berhasil mengupdate Data!');
        return redirect('/dashboard')->with('success', 'Berhasil Mengupdate Data');
    }

    public function editPw($id){
        $user = User::find($id);
        return view('home.settings.password', ['user' => $user, 'title' => 'Pengguna']);
    }

    public function updatePw(Request $request, $id){
        $user = User::find($id);
        $password = bcrypt($request->password);
        $user['password'] = bcrypt($user['password']);
        $user->update([ 
            $user-> password = $password
        ]);
        $request->accepts('session');
        session()->flash('success', 'Berhasil mengupdate Data!');

        return redirect('/dashboard')->with('succes', 'New Post has been Added');
    }
    // Update 
    public function store(Request $request)
{
    $request->validate([
        'password' => 'required|min:6'
    ]);

    // Kode untuk menyimpan data ke database
}

}