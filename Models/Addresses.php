<?php

namespace Modules\Companies\Models;

use Model;

class Addresses extends Model
{
    // Define the sluggable attribute for the model (the name will be used to generate a slug)
    public $sluggable = 'name';

    // Define translatable attributes (none in this case)
    public $translatable = [];

    // Define fillable attributes for mass assignment
    protected $fillable = [
        "street", 
        "city", 
        "state", 
        "post_code", 
        "country_id", 
        "addressable_type", 
        "addressable_id", 
        "is_public"
    ];

    // Define appends to include additional attributes that are not in the database
    protected $appends = ['country'];

    /**
     * Get the country attribute. 
     * This is a dynamic attribute that always returns "dk".
     *
     * @return string
     */
    public function getCountryAttribute()
    {
        return "dk";  // This returns a fixed value for the country
    }

    /**
     * Add or update an address for a given user.
     * This method either updates an existing address or creates a new one.
     *
     * @param int   $user_id  The user ID to associate the address with.
     * @param array $params   The address parameters (street, city, etc.)
     * @return \Modules\Companies\Models\Addresses
     */
    public static function add($user_id, array $params)
    {
        // Update or create a new address for the given user
        return Addresses::updateOrCreate(
            [
                "addressable_type" => "App\Models\User",  // Set the addressable type to User
                "addressable_id" => $user_id  // Associate with the specific user ID
            ],
            $params  // Use the provided address parameters (street, city, etc.)
        );
    }
}
