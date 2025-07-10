<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Bookmark;
use App\Models\CafeDetail;
use App\Models\RatingReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
                'description' => ['required', 'string', 'min:3'],
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
            return redirect()->back()->with('error', 'Gagal menambahkan data cafe')->withInput();
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
                'description' => ['required', 'string', 'min:3'],
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
            return redirect()->back()->with('error', 'Gagal update data cafe')->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan update

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal update data cafe' . $e->getMessage());
        }
    }

    // list cafe untuk user
    public function listCafes(Request $request)
    {
        // ambil data user dengan role cafe dan join kan cafe details
        $query = DB::table('users')
            ->join('cafe_details', 'users.id', '=', 'cafe_details.cafe_id')
            ->where('users.role', 'cafe')
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'cafe_details.id as cafe_detail_id',
                'cafe_details.*'
            );

        // Filter berdasarkan nama cafe jika ada parameter search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('users.name', 'like', '%' . $search . '%');
        }

        $cafes = $query->get();

        // Tambahkan rata-rata rating (manual perhitungan: total_rating / total_review)
        foreach ($cafes as $cafe) {
            $ratingData = DB::table('rating_reviews')
                ->where('cafe_id', $cafe->user_id)
                ->selectRaw('SUM(rating) as total_rating, COUNT(*) as total_review')
                ->first();

            if ($ratingData->total_review > 0) {
                $cafe->avg_rating = round($ratingData->total_rating / $ratingData->total_review, 1);
            } else {
                $cafe->avg_rating = 0;
            }
        }


        return view('pages.index', [
            'data' => $cafes,
            'search' => $request->search
        ]);
    }


    // detail cafe untuk user
    public function show($cafe)
    {
        // cek apakah ada notif (pesan belum dibaca)
        $sum_notification = Chat::where('to_user_id', Auth::id())
            ->where('from_user_id', $cafe)
            ->where('is_read', false)
            ->count();

        // cek apakah cafe sudah pernah disimpan ke bookmark
        $is_saved = false;
        $bookmark = Bookmark::where('cafe_id', $cafe)
            ->where('user_id', Auth::id())
            ->first();

        if ($bookmark) {
            $is_saved = true;
        }

        $data = DB::table('users')
            ->join('cafe_details', 'users.id', '=', 'cafe_details.cafe_id')
            ->join('rating_reviews', 'cafe_details.cafe_id', '=', 'rating_reviews.cafe_id')
            ->where('users.id', $cafe) // cari dari cafe id
            ->select(
                'users.id',
                'users.*',
                'cafe_details.*',
                'rating_reviews.*'
            )
            ->first();

        // dd($data);

        return view('pages.detail-cafe', ['data' => $data, 'sum_notification' => $sum_notification, 'is_saved' => $is_saved]);
    }

    // simpan ke bookmark atau lepas dari bookmark
    public function storeToBookmark($id)
    {

        try {
            $user_id = Auth::id();

            // Cek apakah bookmark sudah ada
            $bookmark = Bookmark::where('cafe_id', $id)
                ->where('user_id', $user_id)
                ->first();

            if ($bookmark) {
                // Jika sudah ada, hapus
                $bookmark->delete();

                return redirect()->back()->with('success', 'Cafe telah kamu simpan sebelumnya, sekarang sudah tidak lagi');
            } else {
                // Jika belum, tambahkan
                Bookmark::create([
                    'cafe_id' => $id,
                    'user_id' => $user_id
                ]);

                return redirect()->back()->with('success', 'Cafe berhasil disimpan ke bookmark');
            }
        } catch (ValidationException $e) {
            // Tangkap error validasi dan redirect ke halaman sebelumnya 
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan ke bookmark');
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan store

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan ke bookmark');
        }
    }

    // menampilkan list bookmarks
    public function listBookmark()
    {

        $user_id = Auth::id();

        // Ambil semua cafe_id dari bookmarks
        $saves = Bookmark::where('user_id', $user_id)->get();
        $cafeIds = $saves->pluck('cafe_id')->toArray();

        // Ambil data cafe yang cocok
        $cafes = DB::table('users')
            ->join('cafe_details', 'users.id', '=', 'cafe_details.cafe_id')
            ->where('users.role', 'cafe')
            ->whereIn('users.id', $cafeIds)
            ->select(
                'users.id as user_id',
                'users.name',
                'users.email',
                'cafe_details.id as cafe_detail_id',
                'cafe_details.*'
            )
            ->get();

        // Tambahkan rata-rata rating (manual perhitungan: total_rating / total_review)
        foreach ($cafes as $cafe) {
            $ratingData = DB::table('rating_reviews')
                ->where('cafe_id', $cafe->user_id)
                ->selectRaw('SUM(rating) as total_rating, COUNT(*) as total_review')
                ->first();

            if ($ratingData->total_review > 0) {
                $cafe->avg_rating = round($ratingData->total_rating / $ratingData->total_review, 1);
            } else {
                $cafe->avg_rating = 0;
            }
        }

        // dd($cafes);

        return view('pages.bookmark', ['data' => $cafes]);
    }
}
