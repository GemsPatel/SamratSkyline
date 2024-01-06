<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    /*
     * https://www.angelicdiamonds.com/round-diamond-engagement-ring-9k-white-gold-solitaire-with-side-stones-hera.html
     * https://zubairidrisaweda.medium.com/introduction-to-web-scraping-with-laravel-a217e1444f7c
     */

    public function index()
    {
        /*
            https://www.angelicdiamonds.com/productPrice?
            product_id=14964&
            variant%5B%5D=409&
            variant%5B%5D=182&
            variant%5B%5D=79&
            variant%5B%5D=27&
            variant%5B%5D=401&
            variant%5B%5D=81
        */

        $client = new Client();
        
        $website = $client->request('GET', 'https://www.angelicdiamonds.com/round-diamond-engagement-ring-9k-white-gold-solitaire-with-side-stones-hera.html');

        $product_id = $website->filter('.ppimg')->each( function ( $node ) {
            return $node->attr( "data-pid" );
        });

        $metalArr = $website->filter('#metalTypeProd li')->each( function ( $node ) {
            return "https://www.angelicdiamonds.com/".$node->attr( "data-url" );
        });

        $originArr = $website->filter('.origin')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        $caratArr = $website->filter('.carat')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        $clarityArr = $website->filter('.clarity')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        $colorArr = $website->filter('.color')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        $cutArr = $website->filter('.cuta')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        $certificateArr = $website->filter('.certi')->each( function ( $node ) {
            return $node->attr( "opt_id" );
        });

        dd( "metalArr: ", $metalArr, "originArr:", $originArr, "caratArr: ",$caratArr, "clarityArr: ", $clarityArr, "colorArr: ", $colorArr, "cutArr: ", $cutArr, "certificateArr: ", $certificateArr );
    }
}
