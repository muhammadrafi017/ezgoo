<?php

use Illuminate\Database\Seeder;

use App\User as User;
use App\Group as Group;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //membuat Group
        $memberGroup = new Group();
        $memberGroup->group = 'member';
        $memberGroup->save();

        //membuat Group
        $adminGroup = new Group();
        $adminGroup->group = 'admin';
        $adminGroup->save();

        //membuat User
        $member = new User();
        $member->name         = 'Member EzGoo';
        $member->first_name = 'Member';
        $member->last_name  = 'EzGoo';
        $member->title  = 'Tuan';
        $member->phone  = '082220279970';
        $member->email  = 'member@ezgoo.com';
        $member->password  = bcrypt('member');
        $member->verified = true;
        $member->verification_token = '123tokenm';
        $member->save();

        $member->groups()->attach($memberGroup->id);

        //membuat User
        $admin = new User();
        $admin->name         = 'Admin EzGoo';
        $admin->first_name = 'Admin';
        $admin->last_name  = 'EzGoo';
        $admin->title  = 'Tuan';
        $admin->phone  = '082220279970';
        $admin->email  = 'admin@ezgoo.com';
        $admin->password  = bcrypt('admin');
        $admin->verified = true;
        $admin->verification_token = '123tokena';
        $admin->save();

        $admin->groups()->attach($adminGroup->id);
    }
}
