<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneNumberRequest;
use App\Http\Requests\UpdatePhoneNumberRequest;
use App\Models\PhoneNumber;
use Illuminate\Support\Facades\DB;

class PhoneNumberController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StorePhoneNumberRequest $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(PhoneNumber $phoneNumber)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdatePhoneNumberRequest $request, PhoneNumber $phoneNumber)
	{

		//
		DB::transaction(function () use ($phoneNumber, $request) {

			$phoneNumber->update($request->validated());
		});

		return response(null, 204);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(PhoneNumber $phoneNumber)
	{
		//
		return $phoneNumber->delete();
	}
}
