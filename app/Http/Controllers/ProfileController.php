<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        // Periksa apakah ada file yang diunggah
        if ($request->hasFile('image')) {
            // Validasi file
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Hapus foto profil sebelumnya jika ada
            if ($user->image) {
                Storage::delete($user->image);
            }

            // Simpan foto profil yang diunggah ke direktori public/profile-photos
            $imagePath = $request->file('image')->store('public/profile-photos');

            // Perbarui kolom foto profil di model pengguna
            $user->image = $imagePath;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto profil.');
    }
}

