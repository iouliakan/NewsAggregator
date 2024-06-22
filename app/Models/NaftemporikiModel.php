<?php

namespace App\Models;

use CodeIgniter\Model;

class NaftemporikiModel extends Model
{
    protected $table            = 'naftemporiki';
    protected $primaryKey       = 'Id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'url', 'date_time', 'category', 'Image', 'summary', 'html_content','tags'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];




    //Custom functions for the database
    
    
    
    
    public function saveNews($newsData)
    {
        $exists = $this
        // ->where('title', $newsData['title'])
                       ->where('url', $newsData['url'])
                       ->where('date_time', $newsData['date_time'])
                    //    ->where('category', $newsData['category'])
                    //    ->where('Image', $newsData['Image'])
                    //    ->where('summary', $newsData['summary'])
                    //    ->where('tags', $newsData['tags'])

                       ->first(); 

        if (!$exists) {
        // If the news item does not exist, save it to the database
            return $this->insert($newsData);
    }


        return false; 

    }

    public function getAllNews() {
        return $this->orderBy('date_time', 'desc')->findAll();  // This assumes 'date_time' is the column you want to sort by
    }





    public function get_news($Id) {
        return $this->db
                        ->table('naftemporiki')
                        ->where(["Id" => $Id])
                        ->get()
                        ->getRow();
    }

    public function update($Id = null, $data = null): bool
    {
        if ($Id === null || $data === null) {
            return false;
        }

        return $this->db->table($this->table)
            ->where($this->primaryKey, $Id)
            ->set($data)
            ->update();
    }


    public function fetchTheNews($Id)
    {
        return $this->where('Id', $Id)->findAll();
    }
    

    public function getLatestNews($limit = 5)
{
    return $this->orderBy('date_time', 'desc')->findAll($limit);
}


}
