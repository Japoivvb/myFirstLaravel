<?php

namespace App\Models;

class Job
{
    public $id;
    public $name;
    public $email;
    public $title;
    public $salary;

    public function __construct($id, $name, $email, $title, $salary)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->title = $title;
        $this->salary = $salary;
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
                'email' => 'john@gmail.com',
                'title' => 'director',
                'salary' => 10000
            ],
            [
                'id' => 2,
                'name' => 'Lucy Lee',
                'email' => 'lucy@gmail.com',
                'title' => 'president',
                'salary' => 20000
            ],
            [
                'id' => 3,
                'name' => 'Ben Tex',
                'email' => 'ben@gmail.com',
                'title' => 'manager',
                'salary' => 30000
            ],
        ];
    }

    
}
