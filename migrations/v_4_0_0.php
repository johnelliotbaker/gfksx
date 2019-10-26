<?php

/**
 * Wikipedia
 * */

namespace gfksx\ThanksForPosts\migrations;

class v_4_0_0 extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    { return false; }

    static public function depends_on()
    { return ['\gfksx\ThanksForPosts\migrations\v_3_2_0']; }

    public function update_schema()
    {
        return [
            'add_tables' => [
                $this->table_prefix . 'thanks_users' => [
                    'COLUMNS' => [
                        'id' => ['UINT', null, 'auto_increment'],
                        'b_enable' => ['BOOL', 1],
                        'user_id  '  => ['INT:11', 0],
                        'timestamps' => ['VCHAR:2000', ''],
                    ],
                    'PRIMARY_KEY' => 'id',
                ],
            ],
            'add_unique_index'    => [
                $this->table_prefix . 'thanks_users' => [
                    'user_id' => ['user_id'],
                ],

            ],
        ];
    }

    public function revert_schema()
    {
        return [
            'drop_tables' => [
                $this->table_prefix . 'thanks_users',
            ],
        ];
    }

    public function update_data()
    {
        return [
        ];
    }

}
