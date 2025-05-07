<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CafeDetail;
use Illuminate\Validation\ValidationException;

class CafeController extends Controller
{

    // menampilkan halaman detail cafe
    public function index()
    {
        $cafe = CafeDetail::where('cafe_id', Auth::id())->first();
        return view('cafe.data-cafe', compact('cafe'));
    }

    // simpan data detail cafe
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            // Bersihkan input yang tidak dibutuhkan
            unset($data['image_profile_input']);
            // Decode kalau masih string
            if (is_string($data['galleries'])) {
                $data['galleries'] = json_decode($data['galleries'], true);
            }


            $validasi = Validator::make($data, [
                'description' => ['required', 'string', 'min:3', 'max:100'],
                'image_profile' => ['required', 'string'],
                'address' => ['required', 'string', 'min:5'],
                'location' => ['required', 'string', 'min:10'],
                'galleries' => ['nullable', 'array'],
            ])->validate();


            DB::beginTransaction();

            $validasi['cafe_id'] = Auth::id();

            CafeDetail::create($validasi);

            DB::commit();

            return redirect()
                ->route('cafe.data-cafe')
                ->with('success', 'Data Cafe Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            // Tangkap error validasi dan redirect ke halaman sebelumnya dengan membawa old input
            return redirect()->back()->with('error', 'Gagal menambahkan data cafe')->withErrors($e->validator)->withInput();
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
    public function Update(Request $request, $id)
    {
        try {
            $data = $request->all();

            // Bersihkan input yang tidak dibutuhkan
            unset($data['image_profile_input']);
            // Decode kalau masih string
            if (is_string($data['galleries'])) {
                $data['galleries'] = json_decode($data['galleries'], true);
            }


            $validasi = Validator::make($data, [
                'description' => ['required', 'string', 'min:3', 'max:100'],
                'image_profile' => ['required', 'string'],
                'address' => ['required', 'string', 'min:5'],
                'location' => ['required', 'string', 'min:10'],
                'galleries' => ['nullable', 'array'],
            ])->validate();

            $validasi['cafe_id'] = Auth::id();

            $cafe = CafeDetail::findOrFail($id);
            $cafe->update($validasi);

            return redirect()
                ->route('cafe.data-cafe')
                ->with('success', 'Data Cafe Berhasil Diubah');
        } catch (ValidationException $e) {
            // Tangkap error validasi dan redirect ke halaman sebelumnya dengan membawa old input
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan update

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal update data cafe' . $e->getMessage());
        }
    }
}
