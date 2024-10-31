<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{

    use ApiResponse;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => ['required','string', 'min:4'],
            'born_date'     => ['required','date'],
            'father_name'   => ['required','string', 'min:4'],
            'mother_name'   => ['required','string', 'min:4'],
            'section'       => ['required','string', 'in:Diurna,Nocturna,Sabatina'],
            'date_entry'    => ['required','date'],
            'grade_id'      => ['required','exists:grades,id'],

        ];
    }

    public function messages(){
        return [
            'name.required'=>'El nombre es requerido',
            'name.min'=>'El nombre debe contener al menos 4 caracteres',
            'born_date.required'=>'La fecha es requerida',
            'born_date.date'=>'La fecha de nacimiento no es valida',
            'father_name.required'=>'El nombre es requerido',
            'father_name.min'=>'El nombre debe contener al menos 4 caracteres',
            'mother_name.required'=>'El nombre es requerido',
            'mother_name.min'=>'El nombre debe contener al menos 4 caracteres',
            'section.in'=>'El valor ingresado no es válido',
            'date_entry.required'=>'La fecha de entrada es requerida',
            'date_entry.date'=>'La fecha de entrada no es valida',
            'grade_id.required'=>'El grado es requerido',
            'grade_id.exists'=>'El grado suministrado no existe en los registros',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $bornDate = $this->input('born_date');
            $dateEntry = $this->input('date_entry');

            if ($bornDate && $dateEntry) {
                $bornDate = \Carbon\Carbon::parse($bornDate);
                $dateEntry = \Carbon\Carbon::parse($dateEntry);

                if ($dateEntry->diffInYears($bornDate) < 4) {
                    $validator->errors()->add('date_entry', 'La fecha de entrada debe ser al menos 4 años posterior a la fecha de nacimiento');
                }
            }
        });
    }

    public function failedValidation(ValidationValidator $validator) {
        $message = $validator->errors()->all();
        throw new HttpResponseException($this->showMessage($message, 500, false));
    }
}
