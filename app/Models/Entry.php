<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'organiser_name', 'organiser_post', 'organiser_company', 'organiser_photo',
        'rating', 'event_time', 'event_timezone',
        'activate_join_as_audience','activate_join_as_speaker', 'activate_add_to_my_schedule', 'activate_add_to_calendar'
    ];

    function toggle($field)
    {
        $this->{$field} = ($this->{$field} == true) ? false : true;
        $this->save();

        $this->refresh();
    }
}
