<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    factory(App\UsersDashboard::class, 10)->create();
        $user = new \App\UsersDashboard();
        $user->full_name = "Admin admin";
        $user->username = "admin";
        $user->password = "admin";
        $user->email = "admin@admin.com";
        $user->is_admin = 1;
        $user->email_verified_at = Date("Y-m-d H:i:s");
        $user->save();

        $this->call(PermissionsSeeder::class);
    }
}
