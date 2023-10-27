<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Shop;
use App\Models\Cheque;
use Database\Factories\ChequeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание заранее определенных магазинов
        Shop::create([
            'name' => 'Московский',
            'address' => 'Москва, улица Ленина, дом 1',
            'timezone' => 'Europe/Moscow',
        ]);

        Shop::create([
            'name' => 'Самарский',
            'address' => 'Самара, улица Пушкина, дом 2',
            'timezone' => 'Europe/Samara',
        ]);

        Shop::create([
            'name' => 'Якутский',
            'address' => 'Якутск, улица Карла Маркса, дом 3',
            'timezone' => 'Asia/Yakutsk',
        ]);

        // Создание рандомных чеков
        ChequeFactory::new()->count(1)->create();
    }
}
