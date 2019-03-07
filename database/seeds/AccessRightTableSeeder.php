<?php

use Illuminate\Database\Seeder;
use App\Model\AccessRight;
class AccessRightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessRights = ['index', 'create', 'read', 'store', 'edit', 'update'];

        foreach ($accessRights as $value) {

            $accessRight = AccessRight::create([
                'name' => $value,
            ]);
        }
    }
}
