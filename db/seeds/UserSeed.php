<?php

use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
  public function run()
  {
    $faker = \Faker\Factory::create('en_US');
    $data = [];
    foreach ( range(1,10) as $value) {
      $data[] =[
        'name' =>  $faker->name,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
      ];
    };

    $categoryCosts = $this->table('category_costs');
    $categoryCosts->insert($data)->save();
  }
}
