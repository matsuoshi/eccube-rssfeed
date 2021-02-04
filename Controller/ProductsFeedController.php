<?php

namespace Plugin\SampleRssFeed\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Repository\ProductRepository;
use Plugin\SampleRssFeed\Repository\ConfigRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsFeedController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * NewsController constructor.
     *
     * @param ProductRepository $productRepository
     * @param ConfigRepository $configRepository
     */
    public function __construct(ProductRepository $productRepository, ConfigRepository $configRepository)
    {
        $this->productRepository = $productRepository;
        $this->configRepository = $configRepository;
    }

    /**
     * @Route("/products_feed.xml", name="sample_rss_feed_products")
     */
    public function feed()
    {
        $products = $this->productRepository->findBy(
            ['Status' => 1],
            [
                'create_date' => 'DESC',
                'id' => 'DESC',
            ],
            $this->configRepository->getFeedLength()
        );

        $response = new Response();
        $response->headers->set('Content-Type', 'application/xml; charset=UTF-8');

        return $this->render(
            '@SampleRssFeed/products.xml.twig',
            ['products' => $products],
            $response
        );
    }
}
