<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name'=>'Experiencia turística en Estados Unidos','description'=>'Actividad emblemática de Estados Unidos.','location_id'=>1,'budget_type_id'=>1,'trip_type_id'=>1,'interest_id'=>1],
            ['name'=>'Experiencia turística en Canadá','description'=>'Actividad emblemática de Canadá.','location_id'=>2,'budget_type_id'=>2,'trip_type_id'=>2,'interest_id'=>2],
            ['name'=>'Experiencia turística en México','description'=>'Actividad emblemática de México.','location_id'=>3,'budget_type_id'=>3,'trip_type_id'=>3,'interest_id'=>3],
            ['name'=>'Experiencia turística en Guatemala','description'=>'Actividad emblemática de Guatemala.','location_id'=>4,'budget_type_id'=>1,'trip_type_id'=>4,'interest_id'=>4],
            ['name'=>'Experiencia turística en El Salvador','description'=>'Actividad emblemática de El Salvador.','location_id'=>5,'budget_type_id'=>2,'trip_type_id'=>5,'interest_id'=>5],
            ['name'=>'Experiencia turística en Honduras','description'=>'Actividad emblemática de Honduras.','location_id'=>6,'budget_type_id'=>3,'trip_type_id'=>1,'interest_id'=>6],
            ['name'=>'Experiencia turística en Nicaragua','description'=>'Actividad emblemática de Nicaragua.','location_id'=>7,'budget_type_id'=>1,'trip_type_id'=>2,'interest_id'=>7],
            ['name'=>'Experiencia turística en Costa Rica','description'=>'Actividad emblemática de Costa Rica.','location_id'=>8,'budget_type_id'=>2,'trip_type_id'=>3,'interest_id'=>8],
            ['name'=>'Experiencia turística en Panamá','description'=>'Actividad emblemática de Panamá.','location_id'=>9,'budget_type_id'=>3,'trip_type_id'=>4,'interest_id'=>9],
            ['name'=>'Experiencia turística en Belice','description'=>'Actividad emblemática de Belice.','location_id'=>10,'budget_type_id'=>1,'trip_type_id'=>5,'interest_id'=>10],
            ['name'=>'Experiencia turística en Argentina','description'=>'Actividad emblemática de Argentina.','location_id'=>11,'budget_type_id'=>2,'trip_type_id'=>1,'interest_id'=>11],
            ['name'=>'Experiencia turística en Brasil','description'=>'Actividad emblemática de Brasil.','location_id'=>12,'budget_type_id'=>3,'trip_type_id'=>2,'interest_id'=>12],
            ['name'=>'Experiencia turística en Chile','description'=>'Actividad emblemática de Chile.','location_id'=>13,'budget_type_id'=>1,'trip_type_id'=>3,'interest_id'=>13],
            ['name'=>'Experiencia turística en Colombia','description'=>'Actividad emblemática de Colombia.','location_id'=>14,'budget_type_id'=>2,'trip_type_id'=>4,'interest_id'=>14],
            ['name'=>'Experiencia turística en Perú','description'=>'Actividad emblemática de Perú.','location_id'=>15,'budget_type_id'=>3,'trip_type_id'=>5,'interest_id'=>15],
            ['name'=>'Experiencia turística en Uruguay','description'=>'Actividad emblemática de Uruguay.','location_id'=>16,'budget_type_id'=>1,'trip_type_id'=>1,'interest_id'=>16],
            ['name'=>'Experiencia turística en Paraguay','description'=>'Actividad emblemática de Paraguay.','location_id'=>17,'budget_type_id'=>2,'trip_type_id'=>2,'interest_id'=>17],
            ['name'=>'Experiencia turística en Ecuador','description'=>'Actividad emblemática de Ecuador.','location_id'=>18,'budget_type_id'=>3,'trip_type_id'=>3,'interest_id'=>18],
            ['name'=>'Experiencia turística en Bolivia','description'=>'Actividad emblemática de Bolivia.','location_id'=>19,'budget_type_id'=>1,'trip_type_id'=>4,'interest_id'=>19],
            ['name'=>'Experiencia turística en Venezuela','description'=>'Actividad emblemática de Venezuela.','location_id'=>20,'budget_type_id'=>2,'trip_type_id'=>5,'interest_id'=>20],
            ['name'=>'Experiencia turística en España','description'=>'Actividad emblemática de España.','location_id'=>21,'budget_type_id'=>3,'trip_type_id'=>1,'interest_id'=>1],
            ['name'=>'Experiencia turística en Francia','description'=>'Actividad emblemática de Francia.','location_id'=>22,'budget_type_id'=>1,'trip_type_id'=>2,'interest_id'=>2],
            ['name'=>'Experiencia turística en Italia','description'=>'Actividad emblemática de Italia.','location_id'=>23,'budget_type_id'=>2,'trip_type_id'=>3,'interest_id'=>3],
            ['name'=>'Experiencia turística en Alemania','description'=>'Actividad emblemática de Alemania.','location_id'=>24,'budget_type_id'=>3,'trip_type_id'=>4,'interest_id'=>4],
            ['name'=>'Experiencia turística en Reino Unido','description'=>'Actividad emblemática de Reino Unido.','location_id'=>25,'budget_type_id'=>1,'trip_type_id'=>5,'interest_id'=>5],
            ['name'=>'Experiencia turística en Portugal','description'=>'Actividad emblemática de Portugal.','location_id'=>26,'budget_type_id'=>2,'trip_type_id'=>1,'interest_id'=>6],
            ['name'=>'Experiencia turística en Países Bajos','description'=>'Actividad emblemática de Países Bajos.','location_id'=>27,'budget_type_id'=>3,'trip_type_id'=>2,'interest_id'=>7],
            ['name'=>'Experiencia turística en Suiza','description'=>'Actividad emblemática de Suiza.','location_id'=>28,'budget_type_id'=>1,'trip_type_id'=>3,'interest_id'=>8],
            ['name'=>'Experiencia turística en Grecia','description'=>'Actividad emblemática de Grecia.','location_id'=>29,'budget_type_id'=>2,'trip_type_id'=>4,'interest_id'=>9],
            ['name'=>'Experiencia turística en Austria','description'=>'Actividad emblemática de Austria.','location_id'=>30,'budget_type_id'=>3,'trip_type_id'=>5,'interest_id'=>10],
            ['name'=>'Experiencia turística en Japón','description'=>'Actividad emblemática de Japón.','location_id'=>31,'budget_type_id'=>1,'trip_type_id'=>1,'interest_id'=>11],
            ['name'=>'Experiencia turística en China','description'=>'Actividad emblemática de China.','location_id'=>32,'budget_type_id'=>2,'trip_type_id'=>2,'interest_id'=>12],
            ['name'=>'Experiencia turística en India','description'=>'Actividad emblemática de India.','location_id'=>33,'budget_type_id'=>3,'trip_type_id'=>3,'interest_id'=>13],
            ['name'=>'Experiencia turística en Corea del Sur','description'=>'Actividad emblemática de Corea del Sur.','location_id'=>34,'budget_type_id'=>1,'trip_type_id'=>4,'interest_id'=>14],
            ['name'=>'Experiencia turística en Tailandia','description'=>'Actividad emblemática de Tailandia.','location_id'=>35,'budget_type_id'=>2,'trip_type_id'=>5,'interest_id'=>15],
            ['name'=>'Experiencia turística en Vietnam','description'=>'Actividad emblemática de Vietnam.','location_id'=>36,'budget_type_id'=>3,'trip_type_id'=>1,'interest_id'=>16],
            ['name'=>'Experiencia turística en Indonesia','description'=>'Actividad emblemática de Indonesia.','location_id'=>37,'budget_type_id'=>1,'trip_type_id'=>2,'interest_id'=>17],
            ['name'=>'Experiencia turística en Filipinas','description'=>'Actividad emblemática de Filipinas.','location_id'=>38,'budget_type_id'=>2,'trip_type_id'=>3,'interest_id'=>18],
            ['name'=>'Experiencia turística en Malasia','description'=>'Actividad emblemática de Malasia.','location_id'=>39,'budget_type_id'=>3,'trip_type_id'=>4,'interest_id'=>19],
            ['name'=>'Experiencia turística en Singapur','description'=>'Actividad emblemática de Singapur.','location_id'=>40,'budget_type_id'=>1,'trip_type_id'=>5,'interest_id'=>20],
            ['name'=>'Experiencia turística en Sudáfrica','description'=>'Actividad emblemática de Sudáfrica.','location_id'=>41,'budget_type_id'=>2,'trip_type_id'=>1,'interest_id'=>1],
            ['name'=>'Experiencia turística en Egipto','description'=>'Actividad emblemática de Egipto.','location_id'=>42,'budget_type_id'=>3,'trip_type_id'=>2,'interest_id'=>2],
            ['name'=>'Experiencia turística en Marruecos','description'=>'Actividad emblemática de Marruecos.','location_id'=>43,'budget_type_id'=>1,'trip_type_id'=>3,'interest_id'=>3],
            ['name'=>'Experiencia turística en Kenia','description'=>'Actividad emblemática de Kenia.','location_id'=>44,'budget_type_id'=>2,'trip_type_id'=>4,'interest_id'=>4],
            ['name'=>'Experiencia turística en Tanzania','description'=>'Actividad emblemática de Tanzania.','location_id'=>45,'budget_type_id'=>3,'trip_type_id'=>5,'interest_id'=>5],
            ['name'=>'Experiencia turística en Nigeria','description'=>'Actividad emblemática de Nigeria.','location_id'=>46,'budget_type_id'=>1,'trip_type_id'=>1,'interest_id'=>6],
            ['name'=>'Experiencia turística en Ghana','description'=>'Actividad emblemática de Ghana.','location_id'=>47,'budget_type_id'=>2,'trip_type_id'=>2,'interest_id'=>7],
            ['name'=>'Experiencia turística en Túnez','description'=>'Actividad emblemática de Túnez.','location_id'=>48,'budget_type_id'=>3,'trip_type_id'=>3,'interest_id'=>8],
            ['name'=>'Experiencia turística en Australia','description'=>'Actividad emblemática de Australia.','location_id'=>49,'budget_type_id'=>1,'trip_type_id'=>4,'interest_id'=>9],
            ['name'=>'Experiencia turística en Nueva Zelanda','description'=>'Actividad emblemática de Nueva Zelanda.','location_id'=>50,'budget_type_id'=>2,'trip_type_id'=>5,'interest_id'=>10],
            ['name'=>'Experiencia turística en Fiyi','description'=>'Actividad emblemática de Fiyi.','location_id'=>51,'budget_type_id'=>3,'trip_type_id'=>1,'interest_id'=>11],
            ['name'=>'Experiencia turística en Papúa Nueva Guinea','description'=>'Actividad emblemática de Papúa Nueva Guinea.','location_id'=>52,'budget_type_id'=>1,'trip_type_id'=>2,'interest_id'=>12],
            ['name'=>'Experiencia turística en Samoa','description'=>'Actividad emblemática de Samoa.','location_id'=>53,'budget_type_id'=>2,'trip_type_id'=>3,'interest_id'=>13],
            ['name'=>'Experiencia turística en Tonga','description'=>'Actividad emblemática de Tonga.','location_id'=>54,'budget_type_id'=>3,'trip_type_id'=>4,'interest_id'=>14],
            ['name'=>'Experiencia turística en Vanuatu','description'=>'Actividad emblemática de Vanuatu.','location_id'=>55,'budget_type_id'=>1,'trip_type_id'=>5,'interest_id'=>15],
            ['name'=>'Experiencia turística en Palau','description'=>'Actividad emblemática de Palau.','location_id'=>56,'budget_type_id'=>2,'trip_type_id'=>1,'interest_id'=>16],
        ];

        DB::table('activity')->insert($data);
    }
}
