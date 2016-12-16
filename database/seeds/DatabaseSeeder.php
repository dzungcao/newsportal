<?php

use Illuminate\Database\Seeder;
use App\Models\Site;
use App\Models\Device;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $indicators = explode(';','BC;E13W;HR;PA;TC');

        \DB::beginTransaction();
        foreach (Device::all() as $device) {
            $children = $device->children;
            foreach ($indicators as $key => $ind) {
                foreach ($children as $child) {
                    if(in_array($child->short_label,$indicators)){
                        break 2;
                    }
                }
                Device::create([
                    'parent_id'=>$device->id,
                    'site_id'=>$device->site_id,
                    'label'=>$ind,
                    'short_label'=>$ind,
                    'serial'=>$ind.$device->serial,
                ]);
            }
        }
        \DB::commit();
    }    
}
