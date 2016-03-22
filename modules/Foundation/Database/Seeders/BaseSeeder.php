<?php namespace Modules\Foundation\Database\Seeders;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder {

    protected $table;
    /**
     * CSV filename
     *
     * @var string
     */
    protected $filename;

    protected function seedFromCSV($filename, $deliminator = ",") {
        if (!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $header = false;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $deliminator)) !== FALSE) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }

}
