<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name'         => 'administrator',
                'display_name' => 'administrator', // optional By default but i made it compulsory
                'description'  => 'system administrator', // optional By default but i made it compulsory
        ];
    }
}
