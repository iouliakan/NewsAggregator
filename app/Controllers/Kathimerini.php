<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\KathimeriniModel;



class Kathimerini extends BaseController
{



    private function cleanHtmlContent($html_content) {
        $html_content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', '', $html_content);
        $html_content = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/i', '', $html_content);
        $html_content = preg_replace('/<!--.*?-->/', '', $html_content);
        $html_content = strip_tags($html_content);
        $html_content = html_entity_decode($html_content);
        $html_content = trim($html_content);
        $html_content = preg_replace('/\s+/', ' ', $html_content);
        return $html_content;
    }

    private function extractContentUsingSelectors($html, $selectors) {
        $crawler = new Crawler($html);
        
        $content = '';

    foreach ($selectors as $selector) {
        $crawler->filter($selector)->each(function (Crawler $node) use (&$content) {
            $content .= $this->cleanHtmlContent($node->outerHtml()) . "\n";
        });
    }

    return trim($content) ?: 'No content available';
    }


    private function extractCategoryFromUrl($url) {
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path']; 

        //splits the path into segments based on the '/' delimiter.
        $segments = explode('/', trim($path, '/'));
    
        // Assuming the category is always the second segment in the URL
        return isset($segments[0]) ? $segments[0] : 'Unknown';

    }






    public function index() {


        $numPages = $this->request->getPost('numPages');
        if (!$numPages) {
        return redirect()->back()->with('error', 'Please provide the number of pages.');
    }



        $model = new KathimeriniModel();
        $client = new Client();
        $baseUrl = "https://www.kathimerini.gr/epikairothta/page/";
    
        try {

            $allNewsData = [];
            $processedLinks = [];



            for ($page = 1; $page <= $numPages; $page++) {
                $url = $baseUrl . $page;
                log_message('debug', 'Fetching URL: ' . $url);

            $response = $client->request('GET', $url);
            $html = (string) $response->getBody();
            log_message('debug', 'Fetched HTML: ' . $html);
            $crawler = new Crawler($html);


          
           
            // Define the main selector for news items
            $newsItems = $crawler->filter('.nx-article.p-0.mb-5.pb-5.is-flex.column.is-full.cat-template3')->each(function (Crawler $node) use ($client, $model, $processedLinks) {
    
                // Updated selectors based on provided HTML structure
                $title = $node->filter('.card-title')->count() ? $node->filter('.card-title')->text() : null;
                $linkPart = $node->filter('.py-4.mainlink')->count() ? $node->filter('.py-4.mainlink')->attr('href') : null;
                $link = $linkPart ? 'https://www.kathimerini.gr' . $linkPart : null;
                $url = $node->filter('.py-4.mainlink')->count() ? $node->filter('.py-4.mainlink')->attr('href') : null;
                $date_time = $node->filter('.posted-on time')->count() ? $node->filter('.posted-on time')->text() : null;
                $category = $this->extractCategoryFromUrl($url);
                $Image = $node->filter('figure img')->count() ? $node->filter('figure img')->attr('src') : 'default_image.jpg';
             
    

                 // Ensure the link is unique
                 if ($link && !in_array($link, $processedLinks)) {
                    log_message('debug', 'Processing news item with link: ' . $link);



                $newsData = [
                    'title' => $title,
                    'url' => $url,
                    'date_time' => $date_time,
                    'category' => $category,
                    'Image' => $Image,
                    'summary' => '',
                    'html_content' => '',
                    'tags' => ''
                ];
    
                // Fetch detail page content
                 
                    try {
                        $detailedResponse = $client->request('GET', $url);
                        $detailedHtml = (string) $detailedResponse->getBody();

                        $selectors = [
                            '.entry-content > p',
                            '.entry-content > div',
                            '.entry-content > strong'
                        ];



                        $newsData['html_content'] = $this->extractContentUsingSelectors($detailedHtml, $selectors);


                        $detailedCrawler = new Crawler($detailedHtml);
                    
                    
                        
                        // Get summary and tags from detail page
                        $newsData['summary'] = $detailedCrawler->filter('.nx-excerpt')->count() ? $detailedCrawler->filter('.nx-excerpt')->text() : '';
                        $newsData['tags'] = implode(', ', $detailedCrawler->filter('.tags-links a')->each(function (Crawler $tagNode) {
                            return trim($tagNode->text());
                        }));
                    } catch (\Exception $e) {
                        log_message('error', "Failed fetching or parsing detailed page for {$url}: " . $e->getMessage());
                    }



                    $processedLinks[] = $link;
                    $model->saveNews($newsData);
                    return $newsData;

                } else {
                    log_message('debug', 'Skipping duplicate news item with link: ' . $link);
                }
    
                $model->saveNews($newsData);
                return $newsData;
            });
    
            $allNewsData = array_merge($allNewsData, $newsItems);
        }
    
            $newsItems = $model->getAllNews();  // Fetch all news from the database
            $session = session();
            $session->set('news', $newsItems);
            $news = $session->get('news');


            return view('admin/dashboard', ['news' => $news]);

        } catch (\Exception $e) {

            log_message('error', 'Failed fetching newsroom page: ' . $e->getMessage());
            return view('admin/dashboard', ['error' => 'Unable to fetch news data']);
        }
    }
    
       
    }

