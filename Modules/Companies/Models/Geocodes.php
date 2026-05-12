<?php

namespace Modules\Companies\Models\Geocodes;

use HasFactory;
use Model;
use Illuminate\Support\Facades\Log;

class Geocodes extends Model
{
    // Use HasFactory for model factory features (e.g., database seeding)
    use HasFactory;
    
    // Static variable to hold the API key
    public static $api_key;

    // Fillable attributes to allow mass assignment
    public $fillable = [
        "lat",  // Latitude of the location
        "lng",  // Longitude of the location
    ];

    /**
     * Configures the API key by loading it from the configuration file.
     *
     * @return string
     */
    public static function config()
    {
        // Assigns the API key from config to the static variable
        return self::$api_key = config('geocoder.key');
    }

    /**
     * Fetches the geocode coordinates (latitude and longitude) for the given address and country.
     *
     * @param string $address The address to geocode
     * @param string $country The country where the address is located
     * @return array|null The result containing latitude and longitude, or null if there was an error
     */
    public static function get($address, $country)
    {
        // Retrieve the API key configuration
        $api_key = self::config();

        try {
            // Initialize the HTTP client and geocoder
            $client = new \GuzzleHttp\Client();
            $geocoder = new \Spatie\Geocoder\Geocoder($client);
            $geocoder->setApiKey($api_key);  // Set the API key for the geocoder
            $geocoder->setCountry($country); // Set the country for the geocoding query
            // Fetch the coordinates for the given address
            $result = $geocoder->getCoordinatesForAddress($address);

        } catch (\Exception $e) {
            // Log any exception that occurs
            Log::warning($e->getMessage());
        }

        // Return the result (coordinates) or null if no result
        return $result;
    }
}
