<?php

namespace App\Http\Requests;

use App\Models\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePhoneNumberRequest extends FormRequest
{


	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{

		$phoneNumberId = str()->replace('-', '_', $this->id);
		return [
			'type_' . $phoneNumberId . '.value' => ["required", "alpha", Rule::in(PhoneNumber::$TYPES)],
			'sim_number_' . $phoneNumberId => ["required", "regex:/^\+[1-9][0-9]{7,14}$/", "min:10", "max:16", "unique:phone_numbers,sim_number"],
		];
	}



	public function attributes()
	{
		$phoneNumberId = str()->replace('-', '_', $this->id);
		return [
			'type_' . $phoneNumberId . '.value' => "type",
			'sim_number_' . $phoneNumberId => "sim",
		];
	}
}
