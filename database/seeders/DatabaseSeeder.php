<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $parents = array_merge(Config::get('seeder.modules'), Config::get('seeder.parent_menus'));
        $accounts = Config::get('seeder.accounts');
        $privigroups = Config::get('seeder.privilege_groups');
        $privimaps = Config::get('seeder.privileges_map');

        $accountsArr = array();
        foreach($accounts['data'] as $data) {
            $accountsArr[] = $data[4];
        }

        $privigroupsArr = array();
        foreach($privigroups['data'] as $data) {
            $privigroupsArr[] = $data[0];
        }

        $privilegesArr = array();
        foreach ($parents as $parent) {
            foreach ($parent['menus'] as $menu) {
                foreach ($menu['privileges'] as $privilege) {
                    $privilegesArr[] = $privilege['code'];
                }
            }
        }

        //reset master static table
        DB::table('ms_parent_menus')->truncate();
        DB::table('ms_menus')->truncate();
        DB::table('ms_privileges')->whereIn('code', $privilegesArr)->delete();
        DB::table('ms_privilege_groups')->whereIn('id', $privigroupsArr)->delete();
        DB::table('map_privileges')->whereIn('privilege_group_id', $privigroupsArr)->delete();
        DB::table('ms_accounts')->whereIn('username', $accountsArr)->delete();

        //insert menus
        foreach ($parents as $parentKey => $parent) {
            $parent_menu_id = DB::table('ms_parent_menus')->insertGetId(
                [
                    'label' => $parent['label'],
                    'alias' => $parent['alias'],
                    'icon' => $parent['icon'],
                    'order' => $parentKey,
                ]
            );

            foreach ($parent['menus'] as $menuKey => $menu) {
                $menu_id = DB::table('ms_menus')->insertGetId(
                    [
                        'parent_menu_id' => $parent_menu_id,
                        'label' => $menu['label'],
                        'alias' => $menu['alias'],
                        'url' => $menu['url'],
                        'order' => $menuKey
                    ]
                );

                foreach ($menu['privileges'] as $privilege) {
                    $privilege_id = DB::table('ms_privileges')->insertGetId(
                        [
                            'code' => $privilege['code'],
                            'menu_id' => $menu_id,
                            'modules' => $privilege['modules'],
                            'desc' => $privilege['desc']
                        ]
                    );

                    DB::table('map_privileges')->insert(
                        [
                            'privilege_group_id' => 1,
                            'privilege_id' => $privilege_id,
                        ]
                    );
                }
            }
        }

        //insert accounts
        foreach($privigroups['data'] as $data) {
            $data = array_combine($privigroups['column'], $data);
            DB::table('ms_privilege_groups')->insert($data);
        }

        //insert accounts
        foreach($privimaps['data'] as $data) {
            $data = array_combine($privimaps['column'], $data);
            DB::table('map_privileges')->insert($data);
        }

        //insert accounts
        foreach($accounts['data'] as $data) {
            $data = array_combine($accounts['column'], $data);
            DB::table('ms_accounts')->insert($data);
        }
    }
}
