<?php namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\NaftemporikiModel;

class Naftemporiki extends BaseController
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
        foreach ($selectors as $selector) {
            if ($crawler->filter($selector)->count()) {
                $raw_html_content = $crawler->filter($selector)->html();
                return $this->cleanHtmlContent($raw_html_content);
            }
        }
        return 'No content available';  // Return this if no content is found
    }

    public function index() {
        $model = new NaftemporikiModel();
        $client = new Client();
        $url = "https://www.naftemporiki.gr/newsroom/";

        try {
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

            $newsItems = $crawler->filter('.item.item-stream.position-relative')->each(function (Crawler $node) use ($client, $url, $model, $selectors) {
                $title = $node->filter('h3.item-title a')->count() ? $node->filter('h3.item-title a')->text() : null;
                $link = $node->filter('h3.item-title a')->count() ? $url . $node->filter('h3.item-title a')->attr('href') : null;
                $date = $node->filter('time.item-published')->count() ? $node->filter('time.item-published')->text() : null;
                $category = $node->filter('a.category-link-post')->count() ? $node->filter('a.category-link-post')->text() : null;
                $image = $node->filter('.item-image.mb-2 a img')->count() ? $node->filter('.item-image.mb-2 a img')->attr('src') : null;
                $summary = $node->filter('div.item-small')->count() ? trim($node->filter('div.item-small')->text()) : null;

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

                if ($link) {
                    try {
                        $detailedResponse = $client->request('GET', $link);
                        $detailedHtml = (string) $detailedResponse->getBody();
                        $newsData['html_content'] = $this->extractContentUsingSelectors($detailedHtml, $selectors);
                        $detailedCrawler = new Crawler($detailedHtml);
                        $newsData['tags'] = implode(', ', $detailedCrawler->filter('nav.related-links ul li a')->each(function (Crawler $tagNode) {
                            return trim($tagNode->text());
                        }));
                    } catch (\Exception $e) {
                        log_message('error', "Failed fetching or parsing detailed page for {$link}: " . $e->getMessage());
                        $newsData['html_content'] = 'Failed to fetch detailed content';
                    }
                }

                $model->saveNews($newsData);
            });

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
