<?php namespace Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Foundation\Database\Seeders\BaseSeeder;
use Modules\Location\Repositories\Entities\LocationStateModel;
class StateSuburbSeeder extends BaseSeeder
{
    public function __construct() {
        $this->table = 'location_suburb_entities';
        $this->filename = app_path() . '/database/csv/Australian_Post_Codes_Lat_Lon.csv'; // Filename and location of data in csv file
    }

    public function run()
    {
        Model::unguard();

        $states = [
            'Australian Capital Territory',
            'New South Wales',
            'Northern Territory',
            'Queensland',
            'South Australia',
            'Tasmania',
            'Victoria',
            'Western Australia',
        ];

       $abbreviations = [
            'ACT',
            'NSW',
            'NT',
            'QLD',
            'SA',
            'TAS',
            'VIC',
            'WA',
       ];




        $stateCount = count($states);

        for($i = 0; $i < $stateCount; $i++) {
            $state = new LocationStateModel();

            $state->name = $states[$i];
            $state->abbreviation = $abbreviations[$i];

            $state->save();
        }

        $seedData = $this->seedFromCSV($this->filename, ',');
        #we need new data variable to parse suburbs and insert state id code into table
        #I didn't mess with csv to rewrite it, I will drop all fields which we do not need in db.
        $newData = array();

        foreach($seedData as $suburb)
        {
            if($suburb['state_id'] == 'ACT')
            {
                $suburb['state_id'] = 1;
            }
            if($suburb['state_id'] == 'NSW')
            {
                $suburb['state_id'] = 2;
            }
            if($suburb['state_id'] == 'NT')
            {
                $suburb['state_id'] = 3;
            }
            if($suburb['state_id'] == 'QLD')
            {
                $suburb['state_id'] = 4;
            }
            if($suburb['state_id'] == 'SA')
            {
                $suburb['state_id'] = 5;
            }
            if($suburb['state_id'] == 'TAS')
            {
                $suburb['state_id'] = 6;
            }
            if($suburb['state_id'] == 'VIC')
            {
                $suburb['state_id'] = 7;
            }
            if($suburb['state_id'] == 'WA')
            {
                $suburb['state_id'] = 8;
            }

            unset($suburb['dc'],$suburb['type'],$suburb['lon'],$suburb['lat']);
            $newData[] = $suburb;
        }

        DB::table($this->table)->insert($newData);

        $this->command->info('Tables are seeded!');

    }
}