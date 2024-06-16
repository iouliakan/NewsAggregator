<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NaftemporikiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Sample Title 1',
                'date_time' => '2024-06-16 12:00:00',
                'category' => 'News',
                'summary' => 'Sample summary 1',
                'tags' => 'tag1, tag2',
                'url' => 'https://example.com/sample1',
                'Image' => 'https://example.com/image1.jpg',
                'html_content' => '<p>Sample content 1</p>',
            ],
           
        ];

        // Using Query Builder
        $this->db->table('naftemporiki')->insertBatch($data);
    }
}

