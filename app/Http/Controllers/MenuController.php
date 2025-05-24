<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use App\Models\CafeDetail;

class MenuController extends Controller
{
    public function listMenuCafe(Request $request)
    {
        // get semua menu
        $query = Menu::where('cafe_id', Auth::id());

        // apakah ada dicari tipe
        $tipe = $request->query('type');
        if ($tipe) {
            $query = Menu::where('type', $tipe);
        }

        $menus = $query->get();

        return view('cafe.menu-cafe', [
            'menus' => $menus,
            'type' => $tipe,
        ]);
    }

    public function listMenuUser(Request $request, $cafe_id)
    {
        // get semua menu
        $query = Menu::where('cafe_id', $cafe_id);

        // apakah ada dicari tipe
        $tipe = $request->query('type');
        if ($tipe) {
            $query = Menu::where('type', $tipe);
        }

        $menus = $query->get();

        return view('pages.menu-cafe', [
            'menus' => $menus,
            'type' => $tipe,
        ]);
    }

    public function show($id)
    {
        //get menu berdasarkan id menu
        $query = Menu::findOrFail($id);

        // $menus = $query->first();
        $menus = Menu::where('cafe_id', Auth::id())->get();

        return view('cafe.menu-cafe', [
            'menus' => $menus,        // collection utk table
            'menu' => $query,          // object utk modal
            'showModalEdit' => true,
        ]);
    }
    // store data menu
    public function store(Request $request)
    {

        try {
            // validasi data
            $validasi = $request->validate([
                'name' => ['required', 'string', 'min:2'],
                'type' => ['required', 'in:makanan,minuman'],
                'harga' => ['required', 'string'],
                'description' => ['required', 'string', 'min:3'],
                'image_menu_input' => ['required', 'image', 'mimes:jpg,jpeg,png,svg'],
            ]);

            DB::beginTransaction();

            $cafe = CafeDetail::where('cafe_id', Auth::id())->first();

            if (!$cafe) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Cafe Detail tidak ditemukan!');
            }

            if ($request->hasFile('image_menu_input')) {
                $image_path = $request->file('image_menu_input')->store('menu-cafe_images', 'public');
                $validasi['image'] = $image_path;
            }

            $validasi['cafe_id'] = $cafe->cafe_id;

            Menu::create($validasi);

            DB::commit();

            return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan menu!')->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan store
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan menu' . $e->getMessage());
        }
    }

    // edit data menu
    // public function edit($id)
    // {
    //     // ambil data menu
    //     $menu = Menu::findOrFail($id);

    //     return view('menucafe.edit', [
    //         'menu' => $menu,
    //         'showModalEdit' => true,
    //     ]);
    // }

    // update data menu
    public function update(Request $request, $id)
    {
        try {
            // validasi data
            $validasi = $request->validate([
                'name' => ['required', 'string', 'min:2'],
                'type' => ['required', 'in:makanan,minuman'],
                'price' => ['required', 'string'],
                'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg'],
                'description' => ['required', 'string', 'min:3'],
            ]);

            DB::beginTransaction();

            $menu = Menu::findOrFail($id);
            $menu->update($validasi);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($menu->image && file_exists(storage_path('app/public/' . $menu->image))) {
                    unlink(storage_path('app/public/' . $menu->image));
                }

                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                $image_path = $request->file('image')->storeAs('menu-cafe_images', $imageName, 'public');
                $validasi['image'] = $image_path;
            }

            $menu->update($validasi);

            DB::commit();

            return redirect()->route('cafe.menu')->with('success', 'Menu berhasil diubah.');
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

            // Hapus gambar dari storage
            if ($menu->image && Storage::exists('menu-cafe_images/' . $menu->image)) {
                Storage::delete('menu-cafe_images/' . $menu->image);
            }

            $menu->delete();

            return redirect()->route('cafe.menu')->with('success', 'Menu berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal menghapus menu.');
        }
    }
}
