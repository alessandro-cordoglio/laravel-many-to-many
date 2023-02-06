<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Type;
use illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $types=[   
            'Business implementation',
            'Foundational (business improvement)',
            'IT infrastructure improvement',
            'Product development (IT)',
            'Product development (non-IT)',
            'Physical engineering/construction', 
        ];

        foreach ($types as $type) {
            $new_type= new Type();
            $new_type->name = $type;
            $new_type->slug = Str::slug($new_type->name);
            $new_type->save();
        }
    }
}
