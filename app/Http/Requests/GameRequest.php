<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'is_private' => 'nullable|boolean',
            'max_players' => 'required|integer',
            'event_time' => 'required|date',
            'address' => 'nullable|string',
            'place_id' => 'nullable|biginteger|exists:places,id',
            'boardgame_id' => 'nullable|biginteger|exists:boardgames,id',
            'boardgame_name' => 'nullable|string'
        ];
    }

    public function withValidator($validator){
        $validator->after(function($validator){
            if(empty($this->address) && empty($this->place_id)){
                $validator->errors()->add('place', 'Place missing.');
            }

            if(empty($this->boardgame_name) && empty($this->boardgame_id)){
                $validator->errors()->add('boardgame', 'Boardgame missing.');
            }

            if($this->max_players <= 0){
                $validator->errors()->add('max_players', "Ha, ha, sayonara baby.");
            }

            if($this->event_time < now()){
                $validator->errors()->add('event_time', "We still don't know how to travel back in time. Try again.");
            }
        });
    }
    
}
