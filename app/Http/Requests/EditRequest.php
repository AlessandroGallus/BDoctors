<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    

  

        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' =>['required', 'string', 'min:1', 'max:255'],
            'city' => ['required', 'string', 'min:1', 'max:255'],
            'address' =>['required', 'string', 'min:1', 'max:255'],
            'date_of_birth' =>['required'],
            'CF'=>['required', 'string', 'min:1',  'max:16'],
            'phone_number'=>['required', 'string', 'min:1', 'max:17'],
            'url_cv'=>['required'],
             'url_img' => 'required|mimes:png,jpeg,gif',
           'specializations' => ['required'],
      
        ];
    }
    public function messages(){
        return[
            'name.required'=>'Questo campo è obbligatorio test',
            'surname.required'=>'Questo campo è obbligatorio',
            'city.required'=>'la città è obbligsatoria',
            'address.required'=>'Questo campo è obbligatorio',
            'date_of_birth.required'=>'Questo campo è obbligatorio',
            'date_of_birth.date_format'=>'FORMAT SBAGLIATO',
            'CF.required'=>'Questo campo è obbligatorio',
            'phone_number.required'=>'Questo campo è obbligatorio',
            'url_cv.required'=>'Questo campo è obbligatorio',
      // 'url_img.required'=>'Questo campo è obbligatorio',
             
      'url_img.required' => 'Questo campo è obbligatorio',
      'specializations.required' => 'scegliere specializzazione',
    ];
           
    }
}
