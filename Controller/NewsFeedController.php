<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SampleRssFeed\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Repository\NewsRepository;
use Plugin\SampleRssFeed\Repository\ConfigRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsFeedController extends AbstractController
{
    /**
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * @var ConfigRepository
     */
    protected $configRepository;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $newsRepository
     * @param ConfigRepository $configRepository
     */
    public function __construct(NewsRepository $newsRepository, ConfigRepository $configRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->configRepository = $configRepository;
    }

    /**
     * @Route("/news_feed.xml", name="sample_rss_feed_news")
     */
    public function feed()
    {
//        $news = $this->newsRepository->getList(); // 全件取得される

        $config = $this->configRepository->get();
        $limit = $config ? $config->getFeedLength() : 10;

        $builder = $this->newsRepository->createQueryBuilder('news');
        $news = $builder
            ->where('news.visible = ?1')
            ->andWhere($builder->expr()->lte('news.publish_date', '?2'))
            ->setParameters([
                1 => true,
                2 => new \DateTime(),
            ])
            ->orderBy('news.publish_date', 'DESC')
            ->addOrderBy('news.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/xml; charset=UTF-8');

        return $this->render(
            '@SampleRssFeed/news.xml.twig',
            ['news' => $news],
            $response
        );
    }
}
