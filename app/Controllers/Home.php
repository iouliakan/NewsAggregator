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



    private $categoryMapping = [
       
        
        'world' => ['world', 'Κόσμος'],
        'culture' => ['culture', 'Εκδηλώσεις'],
        'society' => ['society', 'Κοινωνία'],
        'economy' => ['economy', 'Οικονομία'],
        'life' => ['life', 'Clickatlife'],
        'politics' => ['politics', 'Πολιτική'],
        'history' => ['istoria', 'history'],
        'athletics' => ['athletics', 'Αθλητικά'],
        'business' => ['business', 'Επιχειρήσεις'],
        'technology' => ['technology', 'tech', 'Τεχνολογία & Επιστήμη'],
        'music' => ['music', 'Μουσική'],
        'shipping' => ['shipping', 'Ναυτιλία'],
        'events' => ['events', 'culture', 'Εκδηλώσεις'],
        'international' => ['international', 'Διεθνή'],
        'theatre' => ['theatre', 'Θέατρο'],
        'opinions' => ['opinion', 'Απόψεις'],
        'nature' => ['nature', 'Αγρια Φύση'],
        'health' => ['health', 'Υγεία'],
        'museums' => ['museums', 'Μουσεία'],
        'cinema' => ['cinema', 'movies', 'Σινεμά']
        // 'cooking' => ['k']
    ];

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

         


        // Pass the grouped news and category mapping to the view
        return view('mainPage', [
            'groupedNews' => $groupedNews,
            'categoryMapping' => $this->categoryMapping
        ]);
    }

    private function groupNewsByCategory($news)
    {
        $groupedNews = [];
        foreach ($news as $item) {
            foreach ($this->categoryMapping as $displayCategory => $dbCategories) {
                if (in_array($item['category'], $dbCategories)) {
                    $groupedNews[$displayCategory][] = $item;
                    break;
                }
            }
        }
        return $groupedNews;
    }


    public function category($displayCategory)
    {
        // Find the database category names from the display category name
        $dbCategories = $this->categoryMapping[$displayCategory] ?? null;
        if ($dbCategories === null) {
            return "Category not found.";
        }

        // Fetch news from both models by all possible category names
        $newsNaftemporiki = $this->NaftemporikiModel->whereIn('category', $dbCategories)->findAll();
        $newsKathimerini = $this->KathimeriniModel->whereIn('category', $dbCategories)->findAll();

        // Combine news from both sources
        $allNews = array_merge($newsNaftemporiki, $newsKathimerini);

        // Pass the news and category mapping to the view
        return view('mainPage', [
            'groupedNews' => [$displayCategory => $allNews],
            'categoryMapping' => $this->categoryMapping
        ]);
    }


    private function getLatestNews($limit = 5)
{
    $newsModel1 = new NaftemporikiModel();
    $newsModel2 = new KathimeriniModel();

    // Fetch the latest news from both models
    $latestNewsNaftemporiki = $newsModel1->orderBy('date_time', 'desc')->findAll($limit);
    $latestNewsKathimerini = $newsModel2->orderBy('date_time', 'desc')->findAll($limit);

    // Combine news from both sources and limit to $limit items
    $allLatestNews = array_merge($latestNewsNaftemporiki, $latestNewsKathimerini);
    usort($allLatestNews, function($a, $b) {
        return strtotime($b['date_time']) - strtotime($a['date_time']);
    });

    return array_slice($allLatestNews, 0, $limit);
}


    private function getRelatedNews($category, $currentNewsId,$limit=5)
{
    $newsModel1 = new NaftemporikiModel();
    $newsModel2 = new KathimeriniModel();

    // Fetch related news from both models excluding the current news
    $relatedNewsNaftemporiki = $newsModel1->where('category', $category)->where('Id !=', $currentNewsId)->orderBy('date_time', 'desc')->findAll(5);
    $relatedNewsKathimerini = $newsModel2->where('category', $category)->where('Id !=', $currentNewsId)->orderBy('date_time', 'desc')->findAll(5);

    // Combine news from both sources and limit to 5 items
    $allRelatedNews = array_merge($relatedNewsNaftemporiki, $relatedNewsKathimerini);
    usort($allRelatedNews, function($a, $b) {
        return strtotime($b['date_time']) - strtotime($a['date_time']);
    });

    return array_slice($allRelatedNews, 0, $limit);
}

    public function read($Id)
    {
        // Fetch the news item using the ID
        $newsModel1 = new NaftemporikiModel();
        $newsModel2 = new KathimeriniModel();
        
        $newsItem1 = $newsModel1->find($Id);
        $newsItem2 = $newsModel2->find($Id); 

        $newsItem = $newsItem1 ?? $newsItem2;

        // Check if the news item exists
        if (!$newsItem) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('News Item Not Found');
        }

      // Check if the news item exists
    if (!$newsItem) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('News Item Not Found');
    }

    // Fetch the latest 5 news items
    $latestNews = $this->getLatestNews(5);

    // Fetch related news items
    $relatedNews = $this->getRelatedNews($newsItem['category'], $Id, 5);

    // Load the view and pass the news item data, latest news, and related news
    return view('readNews', [
        'newsItem' => $newsItem,
        'latestNews' => $latestNews,
        'relatedNews' => $relatedNews
    ]);



}





    }







