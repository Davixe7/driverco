<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    include('models.php');
    $brandIndex  = fake()->numberBetween(0, count($brands) - 1); 
    $modelsCount = count($brands[ $brandIndex ]['models']) - 1;
    $model = $brands[ $brandIndex ]['models'][fake()->numberBetween(0, $modelsCount)];
    return [
      'brand' => $brands[ $brandIndex ]['title'],
      'model' => $model['value'],
      'city'  => fake()->city(),
      'plate' => fake()->numberBetween(0, 214748),
      'user_id' => 1
    ];
  }
}
