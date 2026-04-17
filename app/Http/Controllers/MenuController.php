<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function kueTart()
    {
        $products = [
            [
                'name' => 'Tart Hias Leleh Coklat',
                'sizes' => [
                    ['size' => '12', 'price' => 105000],
                    ['size' => '15', 'price' => 160000],
                    ['size' => '18', 'price' => 215000]
                ],
                'image' => 'tart-coklat.jpg'
            ],
            [
                'name' => 'Tart Kupu Kupu',
                'price' => 80000,
                'image' => 'tart-kupu-kupu.jpg'
            ],
            [
                'name' => 'Tart Merah Putih',
                'sizes' => [
                    ['size' => '12', 'price' => 110000],
                    ['size' => '15', 'price' => 150000],
                    ['size' => '18', 'price' => 180000]
                ],
                'image' => 'tart-merah-putih.jpg'
            ],
            [
                'name' => 'Tart 2 Boneka',
                'sizes' => [
                    ['size' => '12', 'price' => 135000],
                    ['size' => '15', 'price' => 175000],
                    ['size' => '18', 'price' => 225000]
                ],
                'image' => 'tart-2-boneka.jpg'
            ],
            [
                'name' => 'Tart Anak Laki-laki',
                'price' => 90000,
                'image' => 'tart-anak-laki.jpg'
            ],
            [
                'name' => 'Tart Buket',
                'sizes' => [
                    ['size' => '12', 'price' => 115000],
                    ['size' => '15', 'price' => 160000],
                    ['size' => '18', 'price' => 220000]
                ],
                'image' => 'tart-buket.jpg'
            ],
            [
                'name' => 'Tart Serba Coklat',
                'sizes' => [
                    ['size' => '12', 'price' => 120000],
                    ['size' => '15', 'price' => 165000],
                    ['size' => '18', 'price' => 215000],
                    ['size' => '20', 'price' => 265000],
                    ['size' => '22', 'price' => 315000]
                ],
                'image' => 'tart-serba-coklat.jpg'
            ],
            [
                'name' => 'Tart Puding',
                'sizes' => [
                    ['size' => '18', 'price' => 165000],
                    ['size' => '22', 'price' => 270000]
                ],
                'image' => 'tart-puding.jpg'
            ],
            [
                'name' => 'Tart Tingkat',
                'price' => 335000,
                'image' => 'tart-tingkat.jpg'
            ],
            [
                'name' => 'Tart Coquette',
                'price' => 250000,
                'image' => 'tart-coquette.jpg'
            ],
            [
                'name' => 'Tart Karakter',
                'price' => 350000,
                'image' => 'tart-karakter.jpg'
            ],
            [
                'name' => 'Tart Topper',
                'price' => 290000,
                'image' => 'tart-topper.jpg'
            ],
            [
                'name' => 'Tart Anak Perempuan',
                'price' => 125000,
                'image' => 'tart-anak-perempuan.jpg'
            ],
            [
                'name' => 'Tart Hias Topper',
                'price' => 300000,
                'image' => 'tart-hias-topper.jpg'
            ]
        ];

        return view('menu.kue-tart', compact('products'));
    }

    public function brownies()
    {
        $products = [
            [
                'name' => 'Fudgie Brownies Standard',
                'sizes' => [
                    ['size' => '23x10', 'price' => 43000],
                    ['size' => '22x22', 'price' => 85000]
                ],
                'image' => 'fudgie-brownies.jpg'
            ],
            [
                'name' => 'Basecake Brownies',
                'price' => 25000,
                'image' => 'basecake-brownies.jpg'
            ],
            [
                'name' => 'Cup Brownies',
                'description' => 'Isi 3',
                'price' => 52000,
                'image' => 'cup-brownies.jpg'
            ],
            [
                'name' => 'Brownies Cup Hias',
                'sizes' => [
                    ['size' => '4 pcs', 'price' => 60000],
                    ['size' => '5 pcs', 'price' => 75000],
                    ['size' => '6 pcs', 'price' => 90000]
                ],
                'image' => 'brownies-cup-hias.jpg'
            ],
            [
                'name' => 'Fudgy Hias',
                'sizes' => [
                    ['size' => '23x10', 'price' => 75000],
                    ['size' => '22x22', 'price' => 145000]
                ],
                'image' => 'fudgy-hias.jpg'
            ],
            [
                'name' => 'Fudgy Brownies Hias',
                'description' => 'Ukuran 22x22',
                'price' => 185000,
                'image' => 'fudgy-brownies-hias.jpg'
            ],
            [
                'name' => 'Brownies Cup',
                'sizes' => [
                    ['size' => '4 pcs', 'price' => 45000],
                    ['size' => '8 pcs', 'price' => 85000]
                ],
                'image' => 'brownies-cup.jpg'
            ],
            [
                'name' => 'Pop Slice',
                'price' => 120000,
                'image' => 'pop-slice.jpg'
            ]
        ];

        return view('menu.brownies', compact('products'));
    }

    public function bentoCake()
    {
        $products = [
            [
                'name' => 'Bento Cupcake',
                'sizes' => [
                    ['size' => 'Bento + 4 Cupcakes', 'price' => 135000],
                    ['size' => 'Bento + 5 Cupcakes', 'price' => 150000]
                ],
                'image' => 'bento-cupcake.jpg'
            ],
            [
                'name' => 'Bento Cake',
                'description' => 'Ukuran 10 cm',
                'price' => 55000,
                'image' => 'bento-cake.jpg'
            ]
        ];

        return view('menu.bento-cake', compact('products'));
    }

    public function lekkerHolland()
    {
        $products = [
            [
                'name' => 'Lekker Holland',
                'price' => 40000,
                'image' => 'lekker-holland.jpg',
                'description' => 'Kue khas Belanda dengan cita rasa yang autentik'
            ]
        ];

        return view('menu.lekker-holland', compact('products'));
    }
}
