<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
		return Contact::where("user_id", request()->user()->id)
			->filter(request()->only('search', 'trashed'))
			->paginate(9)
			->through(function ($contact) {
				return [
					'id' => $contact->id,
					'user_id' => $contact->user_id,
					'first_name' => $contact->first_name,
					'last_name' => $contact->last_name,
					'duration' => $contact->created_at->diffForHumans(),
					'phone' => $contact->phoneNumbers
				];
			});
	}


	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		//

		DB::transaction(function () use ($request) {
			$contact = request()->user()->contacts()->create([
				"first_name" => $request->first_name,
				"last_name" => $request->last_name,
			]);

			$contact->phoneNumbers()->create([
				'type' => $request->type,
				'sim_number' => $request->sim_number,
			]);
		});

		return response("", 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Contact $contact)
	{
		//
		$data = Contact::where("id", $contact->id)
			->paginate(1)
			->through(function ($contact) {
				return [
					'id' => $contact->id,
					'user_id' => $contact->user_id,
					'first_name' => $contact->first_name,
					'last_name' => $contact->last_name,
					'duration' => $contact->created_at->diffForHumans(),
					'phone' => $contact->phoneNumbers
				];
			});
		return $data;
	}


	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateContactRequest $request, Contact $contact)
	{
		//

		DB::transaction(function () use ($contact, $request) {
			$contact->update($request->validated());
		});

		return response(null, 204);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Contact $contact)
	{
		//
		return $contact->delete();
	}
}
