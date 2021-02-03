<?php

namespace Plugin\SampleRssFeed\Controller;

use Eccube\Controller\ProductController;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsFeedController extends ProductController
{
    /**
     * @Route("/products_feed.xml", name="sample_rss_feed_products")
     * @Template("@SampleRssFeed/products.xml.twig")
     *
     * @param Request $request
     * @param Paginator $paginator
     * @return array
     */
    public function index(Request $request, Paginator $paginator): array
    {
        $products = parent::index($request, $paginator);

        return [
            'products' => $products['pagination'],
        ];
    }
}
