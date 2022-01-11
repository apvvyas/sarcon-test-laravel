<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $start_time = 12;
    public function definition()
    {
        $time = $this->start_time.':00 - '.($this->start_time+1).":00 PM";

        $this->start_time +=1;
        $timezone = $this->faker->timezone;
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'organiser_name' => $this->faker->name,
            'organiser_post' => $this->faker->jobTitle,
            'organiser_company' => $this->faker->company,
            'organiser_photo' => $this->faker->imageUrl(),
            'activate_join_as_audience' => 1,
            'activate_join_as_speaker' => 1,
            'activate_add_to_my_schedule' => 1,
            'activate_add_to_calendar' => 1,
            'rating' => $this->faker->numberBetween(0,5),
            'event_time' => $time,
            'event_timezone' => $this->get_timezone_abbreviation($timezone).' (UTC '.($this->get_timezone_offset($timezone)/3600)." Hrs)"
        ];
    }

    function get_timezone_abbreviation($timezone_id)
    {
        if($timezone_id){
            $abb_list = timezone_abbreviations_list();

            $abb_array = array();
            foreach ($abb_list as $abb_key => $abb_val) {
                foreach ($abb_val as $key => $value) {
                    $value['abb'] = $abb_key;
                    array_push($abb_array, $value);
                }
            }

            foreach ($abb_array as $key => $value) {
                if($value['timezone_id'] == $timezone_id){
                    return strtoupper($value['abb']);
                }
            }
        }
        return FALSE;
    }

    function get_timezone_offset($remote_tz, $origin_tz = null) {
        if($origin_tz === null) {
            if(!is_string($origin_tz = date_default_timezone_get())) {
                return false; // A UTC timestamp was returned -- bail out!
            }
        }
        $origin_dtz = new \DateTimeZone($origin_tz);
        $remote_dtz = new \DateTimeZone($remote_tz);
        $origin_dt = new \DateTime("now", $origin_dtz);
        $remote_dt = new \DateTime("now", $remote_dtz);
        $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
        return $offset;
    }
}
