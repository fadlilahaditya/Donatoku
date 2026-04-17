<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // Kue Tart
            ['name' => 'Tart Hias Leleh Coklat (12 cm)', 'category' => 'Kue Tart', 'price' => 105000, 'description' => 'Tart hias dengan leleh coklat ukuran 12 cm', 'image_url' => '/images/TartHiasLelehCoklat.jpeg'],
            ['name' => 'Tart Hias Leleh Coklat (15 cm)', 'category' => 'Kue Tart', 'price' => 160000, 'description' => 'Tart hias dengan leleh coklat ukuran 15 cm', 'image_url' => '/images/TartHiasLelehCoklat.jpeg'],
            ['name' => 'Tart Hias Leleh Coklat (18 cm)', 'category' => 'Kue Tart', 'price' => 215000, 'description' => 'Tart hias dengan leleh coklat ukuran 18 cm', 'image_url' => '/images/TartHiasLelehCoklat.jpeg'],

            ['name' => 'Tart Kupu Kupu', 'category' => 'Kue Tart', 'price' => 80000, 'description' => 'Tart dengan hiasan kupu-kupu yang cantik', 'image_url' => '/images/TartKupuKupu.jpeg'],

            ['name' => 'Tart Merah Putih (12 cm)', 'category' => 'Kue Tart', 'price' => 110000, 'description' => 'Tart merah putih ukuran 12 cm', 'image_url' => '/images/TartMerahPutih.jpeg'],
            ['name' => 'Tart Merah Putih (15 cm)', 'category' => 'Kue Tart', 'price' => 150000, 'description' => 'Tart merah putih ukuran 15 cm', 'image_url' => '/images/TartMerahPutih.jpeg'],
            ['name' => 'Tart Merah Putih (18 cm)', 'category' => 'Kue Tart', 'price' => 180000, 'description' => 'Tart merah putih ukuran 18 cm', 'image_url' => '/images/TartMerahPutih.jpeg'],

            ['name' => 'Tart 2 Boneka (12 cm)', 'category' => 'Kue Tart', 'price' => 135000, 'description' => 'Tart dengan 2 boneka lucu ukuran 12 cm', 'image_url' => '/images/Tart2Boneka.jpeg'],
            ['name' => 'Tart 2 Boneka (15 cm)', 'category' => 'Kue Tart', 'price' => 175000, 'description' => 'Tart dengan 2 boneka lucu ukuran 15 cm', 'image_url' => '/images/Tart2Boneka.jpeg'],
            ['name' => 'Tart 2 Boneka (18 cm)', 'category' => 'Kue Tart', 'price' => 225000, 'description' => 'Tart dengan 2 boneka lucu ukuran 18 cm', 'image_url' => '/images/Tart2Boneka.jpeg'],

            ['name' => 'Tart Anak Laki-Laki', 'category' => 'Kue Tart', 'price' => 90000, 'description' => 'Tart tema anak laki-laki', 'image_url' => '/images/TartAnakLakiLaki.jpeg'],

            ['name' => 'Tart Buket (12 cm)', 'category' => 'Kue Tart', 'price' => 115000, 'description' => 'Tart dengan hiasan buket bunga ukuran 12 cm', 'image_url' => '/images/TartBuket.jpeg'],
            ['name' => 'Tart Buket (15 cm)', 'category' => 'Kue Tart', 'price' => 160000, 'description' => 'Tart dengan hiasan buket bunga ukuran 15 cm', 'image_url' => '/images/TartBuket.jpeg'],
            ['name' => 'Tart Buket (18 cm)', 'category' => 'Kue Tart', 'price' => 220000, 'description' => 'Tart dengan hiasan buket bunga ukuran 18 cm', 'image_url' => '/images/TartBuket.jpeg'],

            ['name' => 'Tart Serba Coklat (12 cm)', 'category' => 'Kue Tart', 'price' => 120000, 'description' => 'Tart serba coklat ukuran 12 cm', 'image_url' => '/images/TartSerbaCoklat.jpeg'],
            ['name' => 'Tart Serba Coklat (15 cm)', 'category' => 'Kue Tart', 'price' => 165000, 'description' => 'Tart serba coklat ukuran 15 cm', 'image_url' => '/images/TartSerbaCoklat.jpeg'],
            ['name' => 'Tart Serba Coklat (18 cm)', 'category' => 'Kue Tart', 'price' => 215000, 'description' => 'Tart serba coklat ukuran 18 cm', 'image_url' => '/images/TartSerbaCoklat.jpeg'],
            ['name' => 'Tart Serba Coklat (20 cm)', 'category' => 'Kue Tart', 'price' => 265000, 'description' => 'Tart serba coklat ukuran 20 cm', 'image_url' => '/images/TartSerbaCoklat.jpeg'],
            ['name' => 'Tart Serba Coklat (22 cm)', 'category' => 'Kue Tart', 'price' => 315000, 'description' => 'Tart serba coklat ukuran 22 cm', 'image_url' => '/images/TartSerbaCoklat.jpeg'],

            ['name' => 'Tart Puding (18 cm)', 'category' => 'Kue Tart', 'price' => 165000, 'description' => 'Tart puding ukuran 18 cm', 'image_url' => '/images/TartPuding.jpeg'],
            ['name' => 'Tart Puding (22 cm)', 'category' => 'Kue Tart', 'price' => 270000, 'description' => 'Tart puding ukuran 22 cm', 'image_url' => '/images/TartPuding.jpeg'],

            ['name' => 'Tart Tingkat', 'category' => 'Kue Tart', 'price' => 335000, 'description' => 'Tart bertingkat untuk acara spesial', 'image_url' => '/images/TartTingkat.jpeg'],
            ['name' => 'Tart Coquette', 'category' => 'Kue Tart', 'price' => 250000, 'description' => 'Tart coquette yang elegan', 'image_url' => '/images/TartCoquette.jpeg'],
            ['name' => 'Tart Karakter', 'category' => 'Kue Tart', 'price' => 350000, 'description' => 'Tart dengan karakter favorit', 'image_url' => '/images/TartKarakter.jpeg'],
            ['name' => 'Tart Topper', 'category' => 'Kue Tart', 'price' => 290000, 'description' => 'Tart dengan topper spesial', 'image_url' => '/images/TartTopper.jpeg'],
            ['name' => 'Tart Anak Perempuan', 'category' => 'Kue Tart', 'price' => 125000, 'description' => 'Tart tema anak perempuan', 'image_url' => '/images/TartAnakPerempuan.jpeg'],
            ['name' => 'Tart Hias Topper', 'category' => 'Kue Tart', 'price' => 300000, 'description' => 'Tart hias dengan topper premium', 'image_url' => '/images/TartHiasTopper.jpeg'],

            // Brownies
            ['name' => 'Fudgie Brownies Standard (23x10)', 'category' => 'Brownies', 'price' => 43000, 'description' => 'Fudgie brownies ukuran 23x10 cm', 'image_url' => '/images/FudgieBrowniesStandard.jpeg'],
            ['name' => 'Fudgie Brownies Standard (22x22)', 'category' => 'Brownies', 'price' => 85000, 'description' => 'Fudgie brownies ukuran 22x22 cm', 'image_url' => '/images/FudgieBrowniesStandard.jpeg'],
            ['name' => 'Basecake Brownies', 'category' => 'Brownies', 'price' => 25000, 'description' => 'Basecake brownies tanpa topping', 'image_url' => '/images/BaseCakeBrownies.jpeg'],
            ['name' => 'Cup Brownies (isi 3)', 'category' => 'Brownies', 'price' => 52000, 'description' => 'Cup brownies isi 3 cup', 'image_url' => '/images/CupBrownies.jpeg'],

            ['name' => 'Brownies Cup Hias (isi 4)', 'category' => 'Brownies', 'price' => 60000, 'description' => 'Brownies cup dengan hiasan isi 4 cup', 'image_url' => '/images/BrowniesCupHias.jpeg'],
            ['name' => 'Brownies Cup Hias (isi 5)', 'category' => 'Brownies', 'price' => 75000, 'description' => 'Brownies cup dengan hiasan isi 5 cup', 'image_url' => '/images/BrowniesCupHias.jpeg'],
            ['name' => 'Brownies Cup Hias (isi 6)', 'category' => 'Brownies', 'price' => 90000, 'description' => 'Brownies cup dengan hiasan isi 6 cup', 'image_url' => '/images/BrowniesCupHias.jpeg'],

            ['name' => 'Fudgy Hias (23x10)', 'category' => 'Brownies', 'price' => 75000, 'description' => 'Fudgy brownies hias ukuran 23x10 cm', 'image_url' => '/images/FudgyHias.jpeg'],
            ['name' => 'Fudgy Hias (22x22)', 'category' => 'Brownies', 'price' => 145000, 'description' => 'Fudgy brownies hias ukuran 22x22 cm', 'image_url' => '/images/FudgyHias.jpeg'],
            ['name' => 'Fudgy Brownies Hias (22x22)', 'category' => 'Brownies', 'price' => 185000, 'description' => 'Fudgy brownies hias premium ukuran 22x22 cm', 'image_url' => '/images/FudgyBrowniesHias.jpeg'],

            ['name' => 'Brownies Cup (isi 4)', 'category' => 'Brownies', 'price' => 45000, 'description' => 'Brownies cup isi 4', 'image_url' => '/images/BrowniesCup.jpeg'],
            ['name' => 'Brownies Cup (isi 8)', 'category' => 'Brownies', 'price' => 85000, 'description' => 'Brownies cup isi 8', 'image_url' => '/images/BrowniesCup.jpeg'],
            ['name' => 'Popsicle Brownies', 'category' => 'Brownies', 'price' => 120000, 'description' => 'Brownies dalam bentuk popsicle unik', 'image_url' => '/images/PopSlice.jpeg'],

            // Bento Cake
            ['name' => 'Bento Cupcake (Bento + 5 Cupcakes)', 'category' => 'Bento Cake', 'price' => 150000, 'description' => 'Paket bento cake dengan 5 cupcakes', 'image_url' => '/images/BentoCupCake.jpeg'],
            ['name' => 'Bento Cupcake (Bento + 4 Cupcakes)', 'category' => 'Bento Cake', 'price' => 135000, 'description' => 'Paket bento cake dengan 4 cupcakes', 'image_url' => '/images/BentoCupCake.jpeg'],
            ['name' => 'Bento Cake (10 cm)', 'category' => 'Bento Cake', 'price' => 55000, 'description' => 'Bento cake ukuran 10 cm', 'image_url' => '/images/BentoCake.jpeg'],

            // Lekker Holland
            ['name' => 'Lekker Holland', 'category' => 'Lekker Holland', 'price' => 40000, 'description' => 'Kue lekker holland khas', 'image_url' => '/images/LekkerHolland.jpeg'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
