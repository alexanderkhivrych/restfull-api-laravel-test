<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Create voucher
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $voucher = $request->all();

        $validator = Validator::make($voucher, [
            'discount_id' => 'required:number',
            'start_date' => 'required:timestamp',
            'end_date' => 'required:timestamp',
        ]);

        if ($validator->fails()) {
            return redirect('/review')
                ->withErrors($validator)
                ->withInput();
        }

        Review::create([
            'message' => $review['message'],
            'user_id' => Auth::guard()->user()->id,
        ]);
    }

    /**
     * Update voucher
     *
     * @param integer $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Delete voucher
     *
     * @param integer $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
