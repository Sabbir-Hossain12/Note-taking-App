<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Qtec';
        $user->email = 'qtecdev.careers@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();


        for ($i = 0; $i < 20; $i++) {
            $note = new Note();
            $note->title = fake()->title();
            $note->content = fake()->text();
            $note->user_id = $user->id;
            $note->save();
        }
    }
}
