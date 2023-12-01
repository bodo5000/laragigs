<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create(
            [
                'title' => 'laravel jon Developer',
                'tags' => 'laravel, php',
                'company' => 'Acme Group',
                'location' => 'Cairo',
                'email' => 'test@test.com',
                'website' => 'https://www.google.com',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quas eaque pariatur
                corporis? Deserunt aspernatur autem quos aliquid iure eos
                 eius obcaecati qui perferendis praesentium. Laboriosam deleniti,
                  vitae animi repudiandae odio asperiores dolor error consequuntur iure voluptates sed
                   inventore tempore molestiae repellat aut quaerat autem. Rem corporis debitis explicabo quidem.'
            ]
        );

        // Job::create(
        //     [
        //         'title' => 'nodeJs senior Developer',
        //         'tags' => 'Node, js',
        //         'company' => 'Ai Group',
        //         'location' => 'Alex',
        //         'email' => 'example@test.com',
        //         'website' => 'https://www.google.com',
        //         'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quas eaque pariatur
        //         corporis? Deserunt aspernatur autem quos aliquid iure eos
        //          eius obcaecati qui perferendis praesentium. Laboriosam deleniti,
        //           vitae animi repudiandae odio asperiores dolor error consequuntur iure voluptates sed
        //            inventore tempore molestiae repellat aut quaerat autem. Rem corporis debitis explicabo quidem.'
        //     ]
        // );
    }
}
