<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                          => $this->faker->firstName,
            'last_name'                     => $this->faker->lastName,
            'email'                         => $this->faker->unique()->safeEmail,
            'password'                      => $this->faker->password,
            'date_of_birth'                 => $this->faker->date,
            'gender'                        => $this->faker->randomElement(['M', 'F']),
            'cell_phone'                    => $this->faker->cellphone,
            'identity_rg'                   => $this->faker->rg(false),
            'identity_em_dt'                => $this->faker->date,
            'identity_issuing_authority'    => $this->faker->word,
            'cpf'                           => $this->faker->cpf(false),
            'cep_user'                      => '20010000',
            'level'                         => $this->faker->numberBetween(1, 8),
            'num_residence'                 => $this->faker->randomNumber,
        ];
    }
}
