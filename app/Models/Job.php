<?php

namespace App\Models;

class Job
{
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public static function find(int $id): array{
        $job = collect(static::all())->firstWhere('id', $id);

        if(!$job){
            abort(404);// handle unexpected values
        }
        return $job;
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@gmail.com'
            ],
            [
                'id' => 2,
                'name' => 'Lucy Lee',
                'email' => 'lucy@gmail.com'
            ],
            [
                'id' => 3,
                'name' => 'Ben Tex',
                'email' => 'ben@gmail.com'
            ],
        ];
    }

    
}
