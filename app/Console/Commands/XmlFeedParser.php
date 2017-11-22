<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class XmlFeedParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'XmlFeedParser:parsefeed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xml Feed Parser';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feedUrlArr['bbchindi'] = 'http://feeds.bbci.co.uk/hindi/rss.xml';
        $feedUrlArr['Jagran'] = 'http://rss.jagran.com/rss/news/national.xml';

        foreach ($feedUrlArr as $publisherName => $feedUrl) {
            echo "----------------------- $feedUrl -----------------------------";
            $data = $this->parseXmlUri($feedUrl);
            $itemArr = $data['channel']['item'];
            print_r($itemArr);
            foreach ($itemArr as $key => $valueArr) {
                $url = $valueArr['link'];
                $title = $valueArr['title'];
                $pubDate = date("Y-m-d H:i:s", strtotime($valueArr['pubDate']));
                $created_at = date("Y-m-d H:i:s");
                DB::insert(
                    'insert into content
                    (url, title, published_at, created_at, updated_at, publisher, description) values (?, ?, ?, ?, ?, ?, ?)',
                    [$url, $title, $pubDate, $created_at, $created_at, $publisherName, $valueArr['description'] ]
                );
            }
        }

    }

    //- below are helper function
    function parseXmlUri($xml_uri) {
        $xml_content = simplexml_load_file($xml_uri, 'SimpleXMLElement', LIBXML_NOCDATA);
        $dataArr = $this->read_xml_data($xml_content);
        return $dataArr;
    }
    //--- xml to array -----
    function read_xml_data($xml_content) {
        $xml_data = array();
        if (is_object($xml_content)) {
            $xml_content = get_object_vars($xml_content);
        }
        if (is_array($xml_content)) {
            foreach ($xml_content as $name => $value) {
                if (is_object($value) || is_array($value)) {
                    $value = $this->read_xml_data($value); // recursive call
                }
                $xml_data[$name] = $value;
            }
        }
        return $xml_data;
    }
}
