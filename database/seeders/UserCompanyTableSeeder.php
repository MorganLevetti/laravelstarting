<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Ce seed efface ce qui ce trouve dans les tables users, compagnies et company_user.
     * Puis il vient créer 3 companies
     * Il me crée 10 users
     * Et peuple la company_user par rapport aux ids de company
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        \DB::table('companies')->delete();
        \DB::table('company_user')->delete();

        Company::factory()->count(3)->create();

        $company = Company::all();
        $id = $company->pluck('id')->toArray();

        User::factory()->count(10)->create()->each(function ($user) use ($id){
            shuffle($id);
            $user->companies()->attach(array_slice($id, 0));
        });
    }
}
