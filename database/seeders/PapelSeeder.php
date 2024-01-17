<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Hermano;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $papels = [
            ['papel' => 'PRESIDE'],
            ['papel' => 'MINISTERIO DOMINGO'],
            ['papel' => 'PREDICACION'],
            ['papel' => 'MINISTERIO MIERCOLES'],
            ['papel' => 'MINISTERIO SABADO'],
        ];

        DB::table('papels')->insert($papels);

        $alvaro = Hermano::find(1);
        $alvaro->papeles()->attach([1]);
        
        $carlos = Hermano::find(2);
        $carlos->papeles()->attach([1,3,5]);
        
        $carmelo = Hermano::find(3);
        $carmelo->papeles()->attach([2,3,4,5]);
        
        $daniel = Hermano::find(4);
        $daniel->papeles()->attach([1]);

        $david = Hermano::find(5);
        $david->papeles()->attach([3,4,5]);
        
        $diego = Hermano::find(6);
        $diego->papeles()->attach([1]);

        $domingo = Hermano::find(7);
        $domingo->papeles()->attach([1]);
        
        $eliodoro = Hermano::find(8);
        $eliodoro->papeles()->attach([2,3,4,5]);
        
        $froilan = Hermano::find(9);
        $froilan->papeles()->attach([3,4,5]);
        
        $juan = Hermano::find(10);
        $juan->papeles()->attach([2,3,4,5]);
        
        $marcial = Hermano::find(11);
        $marcial->papeles()->attach([3,4,5]);
        
        $mario = Hermano::find(12);
        $mario->papeles()->attach([2,4]);
        
        $vicente = Hermano::find(13);
        $vicente->papeles()->attach([1,3,5]);
        
        $wily = Hermano::find(14);
        $wily->papeles()->attach([1,3,5]);
        
    }
}
