<?php

namespace App\Http\Requests;

use App\Models\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePhoneNumberRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'type' => ["required", "alpha", Rule::in(PhoneNumber::$TYPES)],
			'sim_number' => ["required", "regex:/^\+[1-9][0-9]{10,14}$/", "min:10", "max:16", "unique:phone_numbers,sim_number"],
		];
	}
}
