<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $companies = [
            ['id' => 1, 'name' => 'Company1', 'logo_uri' => '1562697771.png', 'email' => 'company1@test.com', 'website' => ''],
            ['id' => 2, 'name' => 'Company2', 'logo_uri' => '1562697771.png', 'email' => 'company2@test.com', 'website' => ''],
            ['id' => 3, 'name' => 'Company3', 'logo_uri' => '1562697771.png', 'email' => 'company3@test.com', 'website' => ''],
            ['id' => 4, 'name' => 'Company4', 'logo_uri' => '1562697771.png', 'email' => 'company4@test.com', 'website' => ''],
        ];

        foreach ($companies as $company) {
            Company::updateOrCreate(['id' => $company['id']], $company);
        }
    }
}
