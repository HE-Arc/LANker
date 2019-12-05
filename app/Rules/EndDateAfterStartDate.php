<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EndDateAfterStartDate implements Rule
{

  protected $start_date;
  protected $start_time;
  protected $end_date;
  protected $end_time;
  
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start_date, $start_time, $end_date, $end_time)
    {
      $this->start_date = $start_date;
      $this->start_time = $start_time;
      $this->end_date = $end_date;
      $this->end_time = $end_time;
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
      $combinedDTStart = date('Y-m-d H:i:s', strtotime("$this->start_date $this->start_time:00"));
      $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$this->end_date $this->end_time:00"));

      return $combinedDTEnd > $combinedDTStart;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The end date must be after the start date!';
    }
}
