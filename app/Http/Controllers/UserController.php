<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitKerja;
use App\Models\Pegawai;
use App\Models\DtPegawai;
use App\Models\Role;
use App\Models\MappingDashboard;
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
        $pegawai= Pegawai::all();
        $DtPegawai = DtPegawai::all();
        
        $unitkerja = UnitKerja::all();
        $role = Role::all();

        return view('register.register', ['title' => 'Pengguna', 'pegawai'=> $pegawai, 'DtPegawai'=> $DtPegawai], compact('unitkerja', 'role'));
    }

    public function store_register(Request $request){

        
        $username = $request->input('username');
        $nip = $request->input('nip');
        
        $user = User::where('username', $username)->first();
        $nip = User::where('nip', $nip)->first();

        if ($user) {
            $request->session()->flash('error', 'Username sudah ada!');
            return redirect()->back();
        }elseif ($nip) {
            $request->session()->flash('error', 'NIP sudah terdaftar!');
            return redirect()->back();
        }

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

        $password = bcrypt($request->password);
        $validatedDate['password'] = bcrypt($validatedDate['password']);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $user->nama . '_' . substr($user->nip, 0, 6) . '.' . $extension;
            $filePath = 'images/profile/' . $fileName;
            $file->move(public_path('images/profile'), $fileName);
            User::create([
                'nip' => $validatedDate['nip'],
                'username' => $validatedDate['username'],
                'nama' => $validatedDate['nama'],
                'jabatan' => $validatedDate['jabatan'],
                'nama_bidang' => $validatedDate['nama_bidang'],
                'no_hp' => $validatedDate['no_hp'],
                'hak_akses' => $validatedDate['hak_akses'],
                'password' => $validatedDate['password'],
                'image' => $filePath,
                'email' => $validatedDate['email'],
            ]);
        } 
        else {
            User::create([
                'nip' => $validatedDate['nip'],
                'username' => $validatedDate['username'],
                'nama' => $validatedDate['nama'],
                'jabatan' => $validatedDate['jabatan'],
                'nama_bidang' => $validatedDate['nama_bidang'],
                'no_hp' => $validatedDate['no_hp'],
                'hak_akses' => $validatedDate['hak_akses'],
                'password' => $validatedDate['password'],
                'email' => $validatedDate['email'],
                
            ]);
        }
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan user!');

        return redirect('/index');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('register.show', ['user'=> $user, 'title' => 'Pengguna']);
    }

    public function edit($id)
    {
        $edit = User::find($id);
        $role = Role::all();
        $map = MappingDashboard::all();
         
        return view('register.edit', ['mapping_dashboards'=> $map, 'user'=> $edit, 'role'=> $role, 'title' => 'Pengguna']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')) {
            Storage::delete('public/images/profile/' . $user->image);
        }
        if(auth()->user->id == $user->id){ // validasi data user yang login sama dengan data user yang di update
            $user->update([
                $user-> nip = $request->nip,
                $user-> nama = $request->nama,
                $user-> username = $request->username,
                $user-> jabatan = $request->jabatan,
                $user-> nama_bidang = $request->nama_bidang,
                $user-> hak_akses = $request->hak_akses,
                $user-> no_hp = $request->no_hp,
                $user-> email = $request->email,
                $image-> image = $request->image,
            ]);
            if($request->password != null){
                $password = bcrypt($request->password);
                $user->update([
                    $user->password = $password
                ]);
            }
            $request->accepts('session');
            session()->flash('success', 'Berhasil mengupdate Data!');
    
            return redirect('/index')->with('succes', 'Data berhasil dirubah');
        }
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
        // dd($user);
        return view('home.settings.account', ['user'=>$user, 'title' => '']);
    }
    
    public function updateByUser(Request $request, $id){
        
        $user = User::find($id);
        $userId =$request->user()->id;
        $email = $request->email;

        if ($request->filled('password')) {
            $password = bcrypt($request->password);
        }else {
            $password = $user->password;
        }
        // Hapus foto profil sebelumnya jika ada
        if ($request->hasFile('image')) {
            $previousImage = $user->image;
            if ($previousImage) {
                // Hapus file foto profil sebelumnya
                Storage::delete('images/profile/' . $previousImage);
            }
            // Upload foto profil baru
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $user->nama . '_' . substr($user->nip, 0, 6) . '.' . $extension;
                $filePath = 'images/profile/' . $fileName;
                $file->move(public_path('images/profile'), $fileName);
            }
            
            $user->image = $fileName;
        }
        if ($request->has('email')) {
            if (!empty($request->email)) {
                $user->email = $request->email;
            }
        }
        if ($request->has('tanggalselesai')) {
            if (!empty($request->tanggalselesai)) {
                $user->tanggalselesai = $request->tanggalselesai;
            }
        }
        if ($request->has('jabatan')) {
            if (!empty($request->jabatan)) {
                $user->jabatan = $request->jabatan;
            }
        }
        if ($request->has('tanggalmulai')) {
            if (!empty($request->tanggalmulai)) {
                $user->tanggalmulai = $request->tanggalmulai;
            }
        }
        if ($request->has('status')) {
            if (!empty($request->status)) {
                $user->status = $request->status;
            }
        }
        if ($request->has('password')) {
            if (!empty($request->password)) {
                $password = bcrypt($request->password);
                $user->password = $password;
            }
        } else if($request->image != ''){
            $user->update([
                'image' => $filePath
            ]);
        }else if($request->email != ''){
            $user->update([
                'email' => $email
            ]);
        }else if($request->jabatan != ''){
            $jabatan->update([
                'jabatan' => $jabatan
            ]);
        }else if($request->tanggalmulai != ''){
            $user->update([
                'tanggalmulai' => $tanggalmulai
            ]);
        }else if($request->tanggalselesai != ''){
            $user->update([
                'tanggalselesai' => $tanggalselesai
            ]);
        }else if($request->status != ''){
            $user->update([
                'status' => $status
            ]);
        } else {
            $user->update([
                'password' => $password
            ]);
        }
        $user->save();

        $request->accepts('session');
        $request->session()->flash('success', 'Berhasil mengupdate Data!');
        return redirect('/register/edit/'.$user->id)->with('success', 'Berhasil Mengupdate Data');
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