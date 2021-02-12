<?php

namespace App\Rules;
use App\Models\Session;
use Illuminate\Contracts\Validation\Rule;

class RoomDate implements Rule
{

    private int $roomId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       $items =  Session::where('room_id', $this->roomId)
       ->where('start', '<=' ,$value)
       ->where('end', '>=' ,$value)
       ->get();
       
       return $items->count() ? false : true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Эта дата занята.';
    }
}
