<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            // Bolivia
            ['pais_id' => 1, 'departamento' => 'Chuquisaca'],
            ['pais_id' => 1, 'departamento' => 'La Paz'],
            ['pais_id' => 1, 'departamento' => 'Santa Cruz'],
            ['pais_id' => 1, 'departamento' => 'Cochabamba'],
            ['pais_id' => 1, 'departamento' => 'Oruro'],
            ['pais_id' => 1, 'departamento' => 'Potosí'],
            ['pais_id' => 1, 'departamento' => 'Tarija'],
            ['pais_id' => 1, 'departamento' => 'Beni'],
            ['pais_id' => 1, 'departamento' => 'Pando'],
            // Argentina
            ['pais_id' => 2, 'departamento' => 'Buenos Aires'],
            ['pais_id' => 2, 'departamento' => 'Ciudad Autónoma de Buenos Aires'],
            ['pais_id' => 2, 'departamento' => 'Catamarca'],
            ['pais_id' => 2, 'departamento' => 'Chaco'],
            ['pais_id' => 2, 'departamento' => 'Chubut'],
            ['pais_id' => 2, 'departamento' => 'Córdoba'],
            ['pais_id' => 2, 'departamento' => 'Corrientes'],
            ['pais_id' => 2, 'departamento' => 'Entre Ríos'],
            ['pais_id' => 2, 'departamento' => 'Formosa'],
            ['pais_id' => 2, 'departamento' => 'Jujuy'],
            ['pais_id' => 2, 'departamento' => 'La Pampa'],
            ['pais_id' => 2, 'departamento' => 'La Rioja'],
            ['pais_id' => 2, 'departamento' => 'Mendoza'],
            ['pais_id' => 2, 'departamento' => 'Misiones'],
            ['pais_id' => 2, 'departamento' => 'Neuquén'],
            ['pais_id' => 2, 'departamento' => 'Río Negro'],
            ['pais_id' => 2, 'departamento' => 'Salta'],
            ['pais_id' => 2, 'departamento' => 'San Juan'],
            ['pais_id' => 2, 'departamento' => 'San Luis'],
            ['pais_id' => 2, 'departamento' => 'Santa Cruz'],
            ['pais_id' => 2, 'departamento' => 'Santa Fe'],
            ['pais_id' => 2, 'departamento' => 'Santiago del Estero'],
            ['pais_id' => 2, 'departamento' => 'Tierra del Fuego, Antártida e Islas del Atlántico Sur'],
            ['pais_id' => 2, 'departamento' => 'Tucumán'],
            
            // España 
            ['pais_id' => 3, 'departamento' => 'Andalucía'],
            ['pais_id' => 3, 'departamento' => 'Aragón'],
            ['pais_id' => 3, 'departamento' => 'Asturias'],
            ['pais_id' => 3, 'departamento' => 'Islas Baleares'],
            ['pais_id' => 3, 'departamento' => 'Canarias'],
            ['pais_id' => 3, 'departamento' => 'Cantabria'],
            ['pais_id' => 3, 'departamento' => 'Castilla y León'],
            ['pais_id' => 3, 'departamento' => 'Castilla-La Mancha'],
            ['pais_id' => 3, 'departamento' => 'Cataluña'],
            ['pais_id' => 3, 'departamento' => 'Extremadura'],
            ['pais_id' => 3, 'departamento' => 'Galicia'],
            ['pais_id' => 3, 'departamento' => 'Madrid'],
            ['pais_id' => 3, 'departamento' => 'Murcia'],
            ['pais_id' => 3, 'departamento' => 'Navarra'],
            ['pais_id' => 3, 'departamento' => 'País Vasco'],
            ['pais_id' => 3, 'departamento' => 'La Rioja'],
            ['pais_id' => 3, 'departamento' => 'Comunidad Valenciana'],
            ['pais_id' => 3, 'departamento' => 'Ceuta'],
            ['pais_id' => 3, 'departamento' => 'Melilla'],

            // Inglaterra 
            ['pais_id' => 4, 'departamento' => 'Inglaterra'],
            ['pais_id' => 4, 'departamento' => 'Escocia'],
            ['pais_id' => 4, 'departamento' => 'Gales'],
            ['pais_id' => 4, 'departamento' => 'Irlanda del Norte'],
            // Brasil 
            ['pais_id' => 5, 'departamento' => 'Acre'],
            ['pais_id' => 5, 'departamento' => 'Alagoas'],
            ['pais_id' => 5, 'departamento' => 'Amapá'],
            ['pais_id' => 5, 'departamento' => 'Amazonas'],
            ['pais_id' => 5, 'departamento' => 'Bahía'],
            ['pais_id' => 5, 'departamento' => 'Ceará'],
            ['pais_id' => 5, 'departamento' => 'Distrito Federal'],
            ['pais_id' => 5, 'departamento' => 'Espírito Santo'],
            ['pais_id' => 5, 'departamento' => 'Goiás'],
            ['pais_id' => 5, 'departamento' => 'Maranhão'],
            ['pais_id' => 5, 'departamento' => 'Mato Grosso'],
            ['pais_id' => 5, 'departamento' => 'Mato Grosso do Sul'],
            ['pais_id' => 5, 'departamento' => 'Minas Gerais'],
            ['pais_id' => 5, 'departamento' => 'Pará'],
            ['pais_id' => 5, 'departamento' => 'Paraíba'],
            ['pais_id' => 5, 'departamento' => 'Paraná'],
            ['pais_id' => 5, 'departamento' => 'Pernambuco'],
            ['pais_id' => 5, 'departamento' => 'Piauí'],
            ['pais_id' => 5, 'departamento' => 'Rio de Janeiro'],
            ['pais_id' => 5, 'departamento' => 'Rio Grande do Norte'],
            ['pais_id' => 5, 'departamento' => 'Rio Grande do Sul'],
            ['pais_id' => 5, 'departamento' => 'Rondônia'],
            ['pais_id' => 5, 'departamento' => 'Roraima'],
            ['pais_id' => 5, 'departamento' => 'Santa Catarina'],
            ['pais_id' => 5, 'departamento' => 'São Paulo'],
            ['pais_id' => 5, 'departamento' => 'Sergipe'],
            ['pais_id' => 5, 'departamento' => 'Tocantins'],

            // Chile 
            ['pais_id' => 6, 'departamento' => 'Arica y Parinacota'],
            ['pais_id' => 6, 'departamento' => 'Tarapacá'],
            ['pais_id' => 6, 'departamento' => 'Antofagasta'],
            ['pais_id' => 6, 'departamento' => 'Atacama'],
            ['pais_id' => 6, 'departamento' => 'Coquimbo'],
            ['pais_id' => 6, 'departamento' => 'Valparaíso'],
            ['pais_id' => 6, 'departamento' => 'Metropolitana de Santiago'],
            ['pais_id' => 6, 'departamento' => 'Libertador General Bernardo O\'Higgins'],
            ['pais_id' => 6, 'departamento' => 'Maule'],
            ['pais_id' => 6, 'departamento' => 'Ñuble'],
            ['pais_id' => 6, 'departamento' => 'Biobío'],
            ['pais_id' => 6, 'departamento' => 'La Araucanía'],
            ['pais_id' => 6, 'departamento' => 'Los Ríos'],
            ['pais_id' => 6, 'departamento' => 'Los Lagos'],
            ['pais_id' => 6, 'departamento' => 'Aysén del General Carlos Ibáñez del Campo'],
            ['pais_id' => 6, 'departamento' => 'Magallanes y de la Antártica Chilena'],

            // Uruguay 
            ['pais_id' => 7, 'departamento' => 'Artigas'],
            ['pais_id' => 7, 'departamento' => 'Canelones'],
            ['pais_id' => 7, 'departamento' => 'Cerro Largo'],
            ['pais_id' => 7, 'departamento' => 'Colonia'],
            ['pais_id' => 7, 'departamento' => 'Durazno'],
            ['pais_id' => 7, 'departamento' => 'Flores'],
            ['pais_id' => 7, 'departamento' => 'Florida'],
            ['pais_id' => 7, 'departamento' => 'Lavalleja'],
            ['pais_id' => 7, 'departamento' => 'Maldonado'],
            ['pais_id' => 7, 'departamento' => 'Montevideo'],
            ['pais_id' => 7, 'departamento' => 'Paysandú'],
            ['pais_id' => 7, 'departamento' => 'Río Negro'],
            ['pais_id' => 7, 'departamento' => 'Rivera'],
            ['pais_id' => 7, 'departamento' => 'Rocha'],
            ['pais_id' => 7, 'departamento' => 'Salto'],
            ['pais_id' => 7, 'departamento' => 'San José'],
            ['pais_id' => 7, 'departamento' => 'Soriano'],
            ['pais_id' => 7, 'departamento' => 'Tacuarembó'],
            ['pais_id' => 7, 'departamento' => 'Treinta y Tres'],
           
        ];
    }
}

