<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\NaftemporikiModel;
use App\Models\KathimeriniModel; 
use App\Libraries\Hash;

class Home extends BaseController
{


    protected $KathimeriniModel;
    protected $NaftemporikiModel; 

    public function __construct()
 {

         //load the session library
         session(); 

        // Load the necessary helpers
        helper(['url', 'form']);

        // Initialize the models
        $this->KathimeriniModel = new KathimeriniModel();
        $this->NaftemporikiModel = new NaftemporikiModel();

       
       
    }



    public function index()
    {
        // Fetch all news from both models
        $newsNaftemporiki = $this->NaftemporikiModel->getAllNews();
        $newsKathimerini = $this->KathimeriniModel->getAllNews();

        // Combine news from both sources
        $allNews = array_merge($newsNaftemporiki, $newsKathimerini);

        // Group news by category
        $groupedNews = $this->groupNewsByCategory($allNews);

        // Pass the grouped news to the view
        return view('mainPage', ['groupedNews' => $groupedNews]);
    }

    private function groupNewsByCategory($news)
    {
        $groupedNews = [];
        foreach ($news as $item) {
            $groupedNews[$item['category']][] = $item;
        }
        return $groupedNews;
    }

    

    }







