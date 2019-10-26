<?php

/**
 * Wikipedia
 * */

namespace gfksx\ThanksForPosts\migrations;

class v_4_0_1 extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    { return false; }

    static public function depends_on()
    { return ['\gfksx\ThanksForPosts\migrations\v_4_0_0']; }

    public function update_schema()
    {
        return [
            'add_columns' => [
                $this->table_prefix . 'groups' => [
                    'tfp_n_per_cycle' => ['INT:11', 30],
                    'tfp_b_cycle_exempt' => ['BOOL', 0],
                ],
            ],
        ];
    }

    public function revert_schema()
    {
        return [
            'drop_columns' => [
                $this->table_prefix . 'groups' => ['tfp_n_per_cycle', 'tfp_b_cycle_exempt'],
            ],
        ];
    }

    public function set_exemptions()
    {
        global $table_prefix, $db;
        $inset = $db->sql_in_set('group_id', [4, 5, 13]);
        $sql = 'UPDATE ' . GROUPS_TABLE. ' SET tfp_b_cycle_exempt=1 WHERE ' . $inset;
        $db->sql_query($sql);
    }

    public function update_data()
    {
        return [
            ['custom', [[$this, 'set_exemptions']]],
        ];
    }


}
