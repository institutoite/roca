<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartaPlantillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carta_plantillas')->insert([
            [
                'nombre' => 'Carta (varios hermanos) - comunion',
                'tipo' => 'multiple',
                'parrafo1' => '{{lugar}} {{fecha}}',
                'parrafo2' => 'La iglesia del Señor Jesucristo que está en: {{iglesia_origen}}',
                'parrafo3' => 'A los santos y fieles hermanos en Cristo que están en: {{destino}}',
                'parrafo4' => 'Gracia y paz sea a vosotros de Dios nuestro padre y del Señor Jesucristo (Col. 1:2)',
                'parrafo5' => 'Por medio de la presente, les hacemos llegar nuestros afectuosos saludos en el nombre de nuestro Señor Jesucristo.',
                'parrafo6' => 'La presente Carta, es para poner a vuestro conocimiento que nuestros amados hermanos:',
                'parrafo7' => '{{lista_hermanos}}',
                'parrafo8' => 'Están en comunión gozando en el partimiento del pan y de la copa que contiene el fruto de la vid.',
                'parrafo9' => 'Nuestros amados hermanos viene por motivo: {{motivo}}',
                'parrafo10' => 'Amados hermanos, rogamos que los reciban como es digno de los santos en el Señor.',
                'parrafo11' => 'Sin más que decirles nos despedimos, deseándoles muchas bendiciones de nuestro Padre celestial y que la gracia del Señor Jesucristo, el amor de Dios y la comunión del Espíritu Santo sean con todos vosotros. Amen (2Co 13:14)',
                'parrafo12' => 'POR LA IGLESIA DEL SEÑOR QUE ESTA EN {{iglesia_origen}}',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carta (un hermano) - comunion',
                'tipo' => 'hermano',
                'parrafo1' => '{{lugar}}{{fecha}}',
                'parrafo2' => 'La iglesia del Señor Jesucristo que está en: {{iglesia_origen}}',
                'parrafo3' => 'A los santos y fieles hermanos en Cristo que están en: {{destino}}',
                'parrafo4' => 'Gracia y paz sea a vosotros de Dios nuestro padre y del Señor Jesucristo (Col. 1:2)',
                'parrafo5' => 'Por medio de la presente, les hacemos llegar nuestros afectuosos saludos en el nombre de nuestro Señor Jesucristo.',
                'parrafo6' => 'La presente Carta, es para poner a vuestro conocimiento que nuestro amado hermano:',
                'parrafo7' => '{{hermano}}',
                'parrafo8' => 'Está en comunión gozando en el partimiento del pan y de la copa que contiene el fruto de la vid.',
                'parrafo9' => 'Nuestro amado hermano viene por motivo: {{motivo}}',
                'parrafo10' => 'Amados hermanos, rogamos que lo reciban como es digno de los santos en el Señor.',
                'parrafo11' => 'Sin más que decirles nos despedimos, deseándoles muchas bendiciones de nuestro Padre celestial y que la gracia del Señor Jesucristo, el amor de Dios y la comunión del Espíritu Santo sean con todos vosotros. Amen (2Co 13:14)',
                'parrafo12' => 'POR LA IGLESIA DEL SEÑOR QUE ESTA EN {{iglesia_origen}}',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carta (una hermana) - comunion',
                'tipo' => 'hermana',
                'parrafo1' => '{{lugar}} {{fecha}}',
                'parrafo2' => 'La iglesia del Señor Jesucristo que está en: {{iglesia_origen}}',
                'parrafo3' => 'A los santos y fieles hermanos en Cristo que están en: {{destino}}',
                'parrafo4' => 'Gracia y paz sea a vosotros de Dios nuestro padre y del Señor Jesucristo (Col. 1:2)',
                'parrafo5' => 'Por medio de la presente, les hacemos llegar nuestros afectuosos saludos en el nombre de nuestro Señor Jesucristo.',
                'parrafo6' => 'La presente Carta, es para poner a vuestro conocimiento que nuestra amada hermana:',
                'parrafo7' => '{{hermana}}',
                'parrafo8' => 'Está en comunión gozando en el partimiento del pan y de la copa que contiene el fruto de la vid.',
                'parrafo9' => 'Nuestra amada hermana viene por motivo: {{motivo}}',
                'parrafo10' => 'Amados hermanos, rogamos que la reciban como es digno de los santos en el Señor.',
                'parrafo11' => 'Sin más que decirles nos despedimos, deseándoles muchas bendiciones de nuestro Padre celestial y que la gracia del Señor Jesucristo, el amor de Dios y la comunión del Espíritu Santo sean con todos vosotros. Amen (2Co 13:14)',
                'parrafo12' => 'POR LA IGLESIA DEL SEÑOR QUE ESTA EN {{iglesia_origen}}',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
