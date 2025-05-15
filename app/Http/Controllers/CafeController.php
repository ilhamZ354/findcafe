<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CafeDetail;
use App\Models\RatingReview;
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

            $cafeDetail = CafeDetail::create($validasi);

            RatingReview::create([
                'cafe_id' => $cafeDetail->cafe_id,
                'user_id' => Auth::id(),
                'rating' => 5,
                'review' => null,
            ]);

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

    // list cafe untuk user
    public function listCafes() {
        $data = DB::table('users')
            ->join('cafe_details', 'users.id', '=', 'cafe_details.cafe_id')
            ->join('rating_reviews', 'cafe_details.cafe_id', '=', 'rating_reviews.cafe_id')
            ->where('users.role', 'cafe')
            ->select(
                'users.id as user_id',
                'users.username',
                'users.email',
                'cafe_details.id as cafe_detail_id',
                'cafe_details.*',
                'rating_reviews.id as review_id',
                'rating_reviews.rating',
                'rating_reviews.review'
            )
            ->get();

        // dd($data);
        return view('pages.index', compact('data'));

    }

    public function show($cafe) {

        // dd($cafe);

        $data = DB::table('users')
        ->join('cafe_details', 'users.id', '=', 'cafe_details.cafe_id')
        ->join('rating_reviews', 'cafe_details.cafe_id', '=', 'rating_reviews.cafe_id')
        ->where('users.id', $cafe) // cari dari id
        ->select(
            'users.id',
            'users.*',
            'cafe_details.*',
            'rating_reviews.*'
        )
        ->first();

        // dd($data);

        return view('pages.detail-cafe', ['data' => $data]);
    }
}
