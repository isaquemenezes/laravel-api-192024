<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->generateContato(),
            'cep' => $this->faker->postcode(),
            'estado' => $this->faker->state(),
            'cidade' => $this->faker->city(),
            'bairro' => $this->faker->word(),
            'endereco' => $this->faker->streetAddress(),
            'status' => $this->faker->randomElement(['ativo', 'inativo']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * @return string 
     * 
     * @var int $dd
     * @var string $numero
    */
    private function generateContato(): string
    {
        
        $dd = rand(11, 99);
        $numero = '9' . rand(10000000, 99999999);
        return "$dd $numero";
    }
}
