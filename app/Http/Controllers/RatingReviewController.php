<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RatingReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RatingReviewController extends Controller
{
    // simpang rating dan review
    public function store (Request $request, $id) {
        try {

            // dd($request);

            $validasi = $request->validate([
                'rating' => ['required', 'integer'],
                'review' => ['string'],
            ]);

            DB::beginTransaction();
            
            $rating = (int) $validasi['rating'];
            $validasi['rating'] = $rating;
            $validasi['cafe_id'] = $id;
            $validasi['user_id'] = Auth::id();
            
            // dd($validasi);

            RatingReview::create($validasi);
            
            DB::commit();
            
            return redirect()->back()->with('success', 'Rating dan review berhasil terkirim');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal memberikan rating dan review!')->withInput();
        } catch (\Exception $e) {
            // Tangkap error dan gagalkan store
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memberikan rating dan review!');
        }
    }
}
