<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincias = [
            // chuquisaca
            ['departamento_id' => 1, 'provincia' => 'Azurduy'],
            ['departamento_id' => 1, 'provincia' => 'Belisario Boeto'],
            ['departamento_id' => 1, 'provincia' => 'Hernando Siles'],
            ['departamento_id' => 1, 'provincia' => 'Jaime Zudáñez'],
            ['departamento_id' => 1, 'provincia' => 'Luis Calvo'],
            ['departamento_id' => 1, 'provincia' => 'Nor Cinti'],
            ['departamento_id' => 1, 'provincia' => 'Oropeza'],
            ['departamento_id' => 1, 'provincia' => 'Sud Cinti'],
            ['departamento_id' => 1, 'provincia' => 'Tomina'],
            ['departamento_id' => 1, 'provincia' => 'Yamparáez'],
            //la paz 
            ['departamento_id' => 2, 'provincia' => 'Abel Iturralde'],
            ['departamento_id' => 2, 'provincia' => 'Aroma'],
            ['departamento_id' => 2, 'provincia' => 'Bautista Saavedra'],
            ['departamento_id' => 2, 'provincia' => 'Caranavi'],
            ['departamento_id' => 2, 'provincia' => 'Eliodoro Camacho'],
            ['departamento_id' => 2, 'provincia' => 'Franz Tamayo'],
            ['departamento_id' => 2, 'provincia' => 'Gualberto Villarroel'],
            ['departamento_id' => 2, 'provincia' => 'Ingavi'],
            ['departamento_id' => 2, 'provincia' => 'Inquisivi'],
            ['departamento_id' => 2, 'provincia' => 'José Manuel Pando'],
            ['departamento_id' => 2, 'provincia' => 'Larecaja'],
            ['departamento_id' => 2, 'provincia' => 'Loayza'],
            ['departamento_id' => 2, 'provincia' => 'Los Andes'],
            ['departamento_id' => 2, 'provincia' => 'Manco Kapac'],
            ['departamento_id' => 2, 'provincia' => 'Muñecas'],
            ['departamento_id' => 2, 'provincia' => 'Nor Yungas'],
            ['departamento_id' => 2, 'provincia' => 'Omasuyos'],
            ['departamento_id' => 2, 'provincia' => 'Pacajes'],
            ['departamento_id' => 2, 'provincia' => 'Pedro Domingo Murillo'],
            ['departamento_id' => 2, 'provincia' => 'Sud Yungas'],
            //santa cruz
            ['departamento_id' => 3, 'provincia' => 'Andrés Ibáñez'],
            ['departamento_id' => 3, 'provincia' => 'Ángel Sandóval'],
            ['departamento_id' => 3, 'provincia' => 'Chiquitos'],
            ['departamento_id' => 3, 'provincia' => 'Cordillera'],
            ['departamento_id' => 3, 'provincia' => 'Florida'],
            ['departamento_id' => 3, 'provincia' => 'Germán Busch'],
            ['departamento_id' => 3, 'provincia' => 'Guarayos'],
            ['departamento_id' => 3, 'provincia' => 'Ichilo'],
            ['departamento_id' => 3, 'provincia' => 'Manuel María Caballero'],
            ['departamento_id' => 3, 'provincia' => 'Ñuflo de Chávez'],
            ['departamento_id' => 3, 'provincia' => 'Obispo Santistevan'],
            ['departamento_id' => 3, 'provincia' => 'Sara'],
            ['departamento_id' => 3, 'provincia' => 'Vallegrande'],
            ['departamento_id' => 3, 'provincia' => 'Velasco'],
            ['departamento_id' => 3, 'provincia' => 'Warnes'],
            //cbba
            ['departamento_id' => 4, 'provincia' => 'Arani'],
            ['departamento_id' => 4, 'provincia' => 'Arque'],
            ['departamento_id' => 4, 'provincia' => 'Ayopaya'],
            ['departamento_id' => 4, 'provincia' => 'Capinota'],
            ['departamento_id' => 4, 'provincia' => 'Carrasco'],
            ['departamento_id' => 4, 'provincia' => 'Cercado'],
            ['departamento_id' => 4, 'provincia' => 'Chapare'],
            ['departamento_id' => 4, 'provincia' => 'Esteban Arce'],
            ['departamento_id' => 4, 'provincia' => 'Germán Jordán'],
            ['departamento_id' => 4, 'provincia' => 'Mizque'],
            ['departamento_id' => 4, 'provincia' => 'Narciso Campero'],
            ['departamento_id' => 4, 'provincia' => 'Punata'],
            ['departamento_id' => 4, 'provincia' => 'Quillacollo'],
            ['departamento_id' => 4, 'provincia' => 'Tapacarí'],
            ['departamento_id' => 4, 'provincia' => 'Tiraque'],
            // oruro 
            ['departamento_id' => 5, 'provincia' => 'Cercado'],
            ['departamento_id' => 5, 'provincia' => 'Sebastián Pagador'],
            ['departamento_id' => 5, 'provincia' => 'Pantaleón Dalence'],
            ['departamento_id' => 5, 'provincia' => 'Eduardo Abaroa'],
            ['departamento_id' => 5, 'provincia' => 'Poopó'],
            ['departamento_id' => 5, 'provincia' => 'Litoral'],
            ['departamento_id' => 5, 'provincia' => 'Sud Carangas'],
            ['departamento_id' => 5, 'provincia' => 'Nor Carangas'],
            ['departamento_id' => 5, 'provincia' => 'Pantaleón Dalence'],
            ['departamento_id' => 5, 'provincia' => 'Saavedra'],
            ['departamento_id' => 5, 'provincia' => 'Sajama'],
            ['departamento_id' => 5, 'provincia' => 'San Pedro de Totora'],
            ['departamento_id' => 5, 'provincia' => 'San José de Chiquitos'],
            ['departamento_id' => 5, 'provincia' => 'Ladislao Cabrera'],
            ['departamento_id' => 5, 'provincia' => 'Atahuallpa'],
            ['departamento_id' => 5, 'provincia' => 'Carangas'],
            // potosi 
            ['departamento_id' => 6, 'provincia' => 'Alonso de Ibáñez'],
            ['departamento_id' => 6, 'provincia' => 'Antonio Quijarro'],
            ['departamento_id' => 6, 'provincia' => 'Bernardino Bilbao'],
            ['departamento_id' => 6, 'provincia' => 'Charcas'],
            ['departamento_id' => 6, 'provincia' => 'Chayanta'],
            ['departamento_id' => 6, 'provincia' => 'Cornelio Saavedra'],
            ['departamento_id' => 6, 'provincia' => 'Daniel Campos'],
            ['departamento_id' => 6, 'provincia' => 'José María Linares'],
            ['departamento_id' => 6, 'provincia' => 'Modesto Omiste'],
            ['departamento_id' => 6, 'provincia' => 'Nor Chichas'],
            ['departamento_id' => 6, 'provincia' => 'Nor Lípez'],
            ['departamento_id' => 6, 'provincia' => 'Rafael Bustillo'],
            ['departamento_id' => 6, 'provincia' => 'Sud Chichas'],
            ['departamento_id' => 6, 'provincia' => 'Sud Lípez'],
            ['departamento_id' => 6, 'provincia' => 'Tomás Frías'],
            // tarija
            ['departamento_id' => 7, 'provincia' => 'Aniceto Arce'],
            ['departamento_id' => 7, 'provincia' => 'Burnet O\'Connor'],
            ['departamento_id' => 7, 'provincia' => 'Cercado'],
            ['departamento_id' => 7, 'provincia' => 'Eustaquio Méndez'],
            ['departamento_id' => 7, 'provincia' => 'Gran Chaco'],
            ['departamento_id' => 7, 'provincia' => 'José María Avilés'],
            // Beni
            ['departamento_id' => 8, 'provincia' => 'Cercado'],
            ['departamento_id' => 8, 'provincia' => 'Antonio Vaca Díez'],
            ['departamento_id' => 8, 'provincia' => 'General José Ballivián Segurola'],
            ['departamento_id' => 8, 'provincia' => 'Yacuma'],
            ['departamento_id' => 8, 'provincia' => 'Mojos'],
            ['departamento_id' => 8, 'provincia' => 'Marbán'],
            ['departamento_id' => 8, 'provincia' => 'Mamoré'],
            ['departamento_id' => 8, 'provincia' => 'Iténez'],
            //Pando 
            ['departamento_id' => 9, 'provincia' => 'Abuná'],
            ['departamento_id' => 9, 'provincia' => 'Federico Román'],
            ['departamento_id' => 9, 'provincia' => 'Manuripi'],
            ['departamento_id' => 9, 'provincia' => 'Nicolás Suárez'],
            ['departamento_id' => 9, 'provincia' => 'Madre de Dios'],
            
        ];
    }
}
