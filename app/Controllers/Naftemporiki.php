<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\NaftemporikiModel;

class Naftemporiki extends BaseController
{
    private function cleanHtmlContent($html_content) {
        // Αφαιρεί τα <script> tags και το περιεχόμενό τους
        $html_content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', '', $html_content);
        // Αφαιρεί τα <style> tags και το περιεχόμενό τους
        $html_content = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/i', '', $html_content);
        // Αφαιρεί όλα τα HTML σχόλια
        $html_content = preg_replace('/<!--.*?-->/', '', $html_content);
        // Αφαιρεί τα στοιχεία share και social media links
        $html_content = preg_replace('/<div class="(mt-auto share-post-links entry-share|google-news-wrap.*?)">(.*?)<\/div>/is', '', $html_content);
        // Αφαιρεί τα elements που δεν είναι εικόνες
        $html_content = preg_replace('/<nav class="related-links my-5">(.*?)<\/nav>/is', '', $html_content);
        // Αφαιρεί όλες τις εικόνες
        $html_content = preg_replace('/<img\b[^>]*>/i', '', $html_content);
        
        $html_content = preg_replace('/<a\b[^<]*(?:(?!<\/a>)<[^<]*)*<\/a>/i', '', $html_content);
        // Μετατρέπει τις HTML οντότητες σε κανονικούς χαρακτήρες
        $html_content = html_entity_decode($html_content);
        // Αφαιρεί περιττά κενά στην αρχή και στο τέλος του κειμένου
        $html_content = trim($html_content);
        // Αφαιρεί λέξεις-κλειδιά όπως "naftemporiki" ή "kathimerini"
        $html_content = preg_replace('/\b(naftemporiki.gr)\b/i', '', $html_content);
        // Επιστρέφει το καθαρισμένο περιεχόμενο χωρίς να αφαιρεί τα HTML tags για παραγράφους, λίστες κλπ.
        return $html_content;
    }

   private function extractContentUsingSelectors($html, $selectors) {
    $crawler = new Crawler($html);
    foreach ($selectors as $selector) {
        if ($crawler->filter($selector)->count()) {
            $raw_html_content = $crawler->filter($selector)->html();
            $cleaned_content = $this->cleanHtmlContent($raw_html_content);
            return $cleaned_content;
        }
    }
    return 'No content available';  // Return this if no content is found
}
   
    

    public function index() {



        $numPages = $this->request->getPost('numPages');
        if (!$numPages) {
            return redirect()->back()->with('error', 'Please provide the number of pages.');
        }



        $model = new NaftemporikiModel();
        $client = new Client();
        $baseUrl = "https://www.naftemporiki.gr/newsroom/page/";


        try {
            $allNewsData = []; // empty array to store all news items
            $processedLinks = []; //array to track processed news links


         

        for ($page = 1; $page <= $numPages; $page++) {
            $url = $baseUrl . $page; //URL for each page
            log_message('debug', 'Fetching URL: ' . $url);

            $response = $client->request('GET', $url);
            $html = (string) $response->getBody();
            $crawler = new Crawler($html);
            $selectors = [
                'article.news-article.article-main-py-5',
                'div.post-content',
                'div.article',
                'section.content',
                'div.content'
            ];

            $newsItems = $crawler->filter('.item.item-stream.position-relative')->each(function (Crawler $node) use ($client, $url, $model, $selectors, &$processedLinks) {
                $title = $node->filter('h3.item-title a')->count() ? $node->filter('h3.item-title a')->text() : null;
                $linkPart = $node->filter('h3.item-title a')->count() ? $node->filter('h3.item-title a')->attr('href') : null;
                $link = $linkPart ? (strpos($linkPart, 'http') === 0 ? $linkPart : 'https://www.naftemporiki.gr' . $linkPart) : null;
                $date = $node->filter('time.item-published')->count() ? $node->filter('time.item-published')->text() : null;
                $category = $node->filter('a.category-link-post')->count() ? $node->filter('a.category-link-post')->text() : null;
                $image = $node->filter('.item-image.mb-2 a img')->count() ? $node->filter('.item-image.mb-2 a img')->attr('src') : null;
                $summary = $node->filter('div.item-small')->count() ? trim($node->filter('div.item-small')->text()) : null;



                 // Log each extracted item
                 log_message('debug', 'Extracted news item: ' . json_encode([
                    'title' => $title,
                    'link' => $link,
                    'date' => $date,
                    'category' => $category,
                    'image' => $image,
                    'summary' => $summary
                ]));




                // Ensure the link and other critical elements are not null
                if ($link && !in_array($link, $processedLinks)) {
                    log_message('debug', 'Processing news item with link: ' . $link);





                $newsData = [
                    'title' => $title,
                    'url' => $link,
                    'date_time' => $date,
                    'category' => $category,
                    'Image' => $image,
                    'summary' => $summary,
                    'html_content' => '', 
                    'tags' => ''
                ];

                 
               
                    
                    try {
                        $detailedResponse = $client->request('GET', $link);
                        $detailedHtml = (string) $detailedResponse->getBody();
                        log_message('debug', 'Detailed HTML before cleaning: ' . $detailedHtml);
                        $newsData['html_content'] = $this->extractContentUsingSelectors($detailedHtml, $selectors);
                        log_message('debug', 'Cleaned HTML Content: ' . $newsData['html_content']);
                        $detailedCrawler = new Crawler($detailedHtml);
                        $newsData['tags'] = implode(', ', $detailedCrawler->filter('nav.related-links ul li a')->each(function (Crawler $tagNode) {
                            return trim($tagNode->text());
                        }));
                    } catch (\Exception $e) {
                        log_message('error', "Failed fetching or parsing detailed page for {$link}: " . $e->getMessage());
                        $newsData['html_content'] = 'Failed to fetch detailed content';
                    }



                    $processedLinks[] = $link; // Add the link to processed links
                    
                    $model->saveNews($newsData); // Save each news item immediately
                    // return $newsData;  // Correctly return the individual news item

                }  else {
                    log_message('debug', 'Skipping news item due to missing data or duplicate link: ' . $link);
                }
                
               
            
            });
            // Merge to get all unique news items
            if (is_array($newsItems)) {
                $allNewsData = array_merge($allNewsData, $newsItems);
            } else {
                log_message('error', 'Expected newsItems to be an array but got: ' . gettype($newsItems));
            }
        }

           
         // Save all unique news items to the database
         
          foreach ($allNewsData as $newsItem) {
            if (isset($newsItem)) {
                log_message('debug', 'Saving news item: ' . json_encode($newsItem));
                $model->saveNews($newsItem);
            } else {
                log_message('error', 'Attempted to save a null news item');
            }
        }

           

            $newsItems = $model->getAllNews();  // Fetch all news from the database
            $session = session();
            $session->set('news', $newsItems);
            $session->set('source', 'Naftemporiki');
            $news = $session->get('news');
            
            return view('admin/dashboard', ['news' => $news ]);
        } catch (\Exception $e) {
            log_message('error', 'Failed fetching newsroom page: ' . $e->getMessage());
            return view('admin/dashboard', ['error' => 'Unable to fetch news data']);
        }
    }


}

