<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\CafeDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MenuController extends Controller
{
    public function index(Request $request) {
        // get semua menu
        $query = Menu::all();

        // apakah ada dicari tipe
        $tipe = $request->query('type');
        if($tipe){
            $query = Menu::where('type', $tipe)->get();
        }

        return view('menucafe.index', [
            'menus' => $query,
            'type' => $tipe,
        ]);
    }

    // store data menu
    public function store(Request $request) {

        try {
            // validasi data
            $validasi = $request->validate([
                'name' => ['required','string','min:2'],
                'type' => ['required','in:makanan,minuman'],
                'harga' => ['required','string'],
                'image' => ['required','string'],
                'description' => ['required','string','min:3'],
            ]);

            DB::beginTransaction();

            $request['cafe_id'] = Auth::id();
            // simpan data menu
            Menu::create($validasi);

            return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan menu.')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan store
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan menu');
        }

    }

    // edit data menu
    public function edit($id) {
        // ambil data menu
        $menu = Menu::findOrFail($id);

        return view('menucafe.edit', [
            'menu' => $menu,
            'showModalEdit' => true,
        ]);
    }

    // update data menu
    public function update(Request $request, $id) {
        try {
            // validasi data
            $validasi = $request->validate([
                'name' => ['required','string','min:2'],
                'type' => ['required','in:makanan,minuman'],
                'harga' => ['required','string'],
                'image' => ['required','string'],
                'description' => ['required','string','min:3'],
            ]);

            DB::beginTransaction();

            $menu = Menu::findOrFail($id);
            $menu->update($validasi);

            return redirect()->back()->with('success', 'Menu berhasil diubah.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal mengubah menu.')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan update
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah menu');
        }
    }

    // hapus menu cafe
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return redirect()->back()->with('success', 'Menu berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus menu.');
        }
    }
}
