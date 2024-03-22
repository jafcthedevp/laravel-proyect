<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StorePetRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                Rule::unique('pets')->where(function($query){
                    return $query->where('name',strtolower($this->name));
                })->ignore($this->id),
            ],
            'color' => 'required',
            'gender_id' => 'required',
            'size_id' => 'required',
            'race' => 'required',
            'birth' => 'required',
            'plate' => 'required',
            'locker' => 'required',
            'stallion_id' => 'required',
            'madrilla_id' => 'required',
            'disabilitie_id' => 'required',
            'Senasa' => 'required',
            //'atachFile' => 'required',
            'observation' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => strtolower($this->name),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo es obligatorio',
            'name.unique' => 'El dato ingresao ya esta en uso',
            'color.required' => 'El campo es obligatorio',
            'gender_id.required' => 'El campo es obligatorio',
            'size_id.required' => 'El campo es obligatorio',
            'race.required' => 'El campo es obligatorio',
            'birth.required' => 'El campo es obligatorio',
            'plate.required' => 'El campo es obligatorio',
            'locker.required' => 'El campo es obligatorio',
            'stallion_id.required' => 'El campo es obligatorio',
            'madrilla_id.required' => 'El campo es obligatorio',
            'disabilitie_id.required' => 'El campo es obligatorio',
            'Senasa.required' => 'El campo es obligatorio',
            //'atachFile.required' => 'El campo es obligatorio',
            'observation.required' => 'El campo es obligatorio',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status' => 422,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ]));
    }
}
