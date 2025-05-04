<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CafeDetail;

class CafeControllere extends Controller {

    // menampilkan halaman detail cafe
    public function index() {
        $cafe = CafeDetail::where('cafe_id', Auth::id())->first();
        return view('pages.cafe.index', compact('cafe'));
    }

    // simpan data detail cafe
    public function store (Request $request) {
        try{

            $validasi = $request->validate([
                'description' => ['required','string','min:3','max:100'],
                'image_profile' => ['required','string'],
                'address' => ['required','string','min:5'],
                'location' => ['required','string','min:10'],
                'galleries' => ['nullable','array'],
            ]);

            DB::beginTransaction();

            $validasi['cafe_id'] = Auth::id();

            CafeDetail::create($validasi);

            DB::commit();

            return redirect()
                ->route('cafe.index')
                ->with('success', 'Data Cafe Berhasil Ditambahkan');

        } catch (ValidationException $e) {
            // Tangkap error validasi dan redirect ke halaman sebelumnya dengan membawa old input
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan store
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data cafe');
        }
    }

    // update data detail cafe
    public function Update(Request $request, $id) {
        try{
            $validasi = $request->validate([
                'description' => ['required','string','min:3','max:100'],
                'image_profile' => ['required','string'],
                'address' => ['required','string','min:5'],
                'location' => ['required','string','min:10'],
                'galleries' => ['nullable','array'],
            ]);

            $validasi['cafe_id'] = Auth::id();

            $cafe = CafeDetail::findOrFail($id);
            $cafe->update($validasi);

            return redirect()
                ->route('cafe.index')
                ->with('success', 'Data Cafe Berhasil Diubah');
        } catch (ValidationException $e) {
            // Tangkap error validasi dan redirect ke halaman sebelumnya dengan membawa old input
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan update

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal update data cafe');
        }
    }

}
