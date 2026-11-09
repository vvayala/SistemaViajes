<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [

            'Experiencia turística en Estados Unidos' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793677627/1.webp',
            'Experiencia turística en Canadá' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793677695/2.webp',
            'Experiencia turística en México' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793677725/3.webp',
            'Experiencia turística en Guatemala' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793677754/4.webp',
            'Experiencia turística en El Salvador' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839688/5.webp',
            'Experiencia turística en Honduras' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839730/6.webp',
            'Experiencia turística en Nicaragua' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839775/7.webp',
            'Experiencia turística en Costa Rica' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839803/8.webp',
            'Experiencia turística en Panamá' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839852/9.webp',
            'Experiencia turística en Belice' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839880/10.webp',

            'Experiencia turística en Argentina' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839904/11.webp',
            'Experiencia turística en Brasil' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793839967/12.webp',
            'Experiencia turística en Chile' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840022/13.webp',
            'Experiencia turística en Colombia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840063/14.webp',
            'Experiencia turística en Perú' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840091/15.webp',
            'Experiencia turística en Uruguay' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840117/16.webp',
            'Experiencia turística en Paraguay' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840146/17.webp',
            'Experiencia turística en Ecuador' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840251/18.webp',
            'Experiencia turística en Bolivia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840282/19.webp',
            'Experiencia turística en Venezuela' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840310/20.webp',

            'Experiencia turística en España' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840353/21.webp',
            'Experiencia turística en Francia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840376/22.webp',
            'Experiencia turística en Italia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840400/23.webp',
            'Experiencia turística en Alemania' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840425/24.webp',
            'Experiencia turística en Reino Unido' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840451/25.webp',
            'Experiencia turística en Portugal' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840485/26.webp',
            'Experiencia turística en Países Bajos' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840521/27.webp',
            'Experiencia turística en Suiza' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840594/28.webp',
            'Experiencia turística en Grecia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840625/29.webp',
            'Experiencia turística en Austria' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840658/30.webp',

            'Experiencia turística en Japón' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840699/31.webp',
            'Experiencia turística en China' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840722/32.webp',
            'Experiencia turística en India' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840746/33.webp',
            'Experiencia turística en Corea del Sur' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840773/34.webp',
            'Experiencia turística en Tailandia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840799/35.webp',
            'Experiencia turística en Vietnam' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840910/36.webp',
            'Experiencia turística en Indonesia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840937/37.webp',
            'Experiencia turística en Filipinas' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840959/38.webp',
            'Experiencia turística en Malasia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793840982/39.webp',
            'Experiencia turística en Singapur' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841053/40.webp',

            'Experiencia turística en Sudáfrica' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793851683/54.webp',
            'Experiencia turística en Egipto' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841328/41.webp',
            'Experiencia turística en Marruecos' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841352/42.webp',
            'Experiencia turística en Kenia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841375/43.webp',
            'Experiencia turística en Tanzania' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841403/44.webp',
            'Experiencia turística en Nigeria' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841433/45.webp',
            'Experiencia turística en Ghana' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841487/46.webp',
            'Experiencia turística en Túnez' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841528/47.webp',

            'Experiencia turística en Australia' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841556/48.webp',
            'Experiencia turística en Nueva Zelanda' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841580/49.webp',
            'Experiencia turística en Fiyi' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841610/50.webp',
            'Experiencia turística en Papúa Nueva Guinea' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841697/51.jpg',
            'Experiencia turística en Samoa' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841754/52.jpg',
            'Experiencia turística en Tonga' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841781/53.jpg',
            'Experiencia turística en Vanuatu' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841806/55.jpg',
            'Experiencia turística en Palau' => 'https://res.cloudinary.com/isshzjdh/image/upload/v1793841836/56.jpg',
        ];

        foreach ($images as $activityName => $url) {

        $activity = Activity::where(
            'name',
            $activityName
        )->first();

        if ($activity && $url !== 'URL_AQUI') {

            Image::create([
                'entity_type' => 'activity',
                'entity_id' => $activity->activity_id,
                'image_path' => $url,
                'is_primary' => true,
            ]);
        }
    }
    }
}
