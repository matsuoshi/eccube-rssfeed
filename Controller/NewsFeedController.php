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

use Eccube\Controller\Admin\Content\NewsController;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewsFeedController extends NewsController
{
    /**
     * @Route("/news_feed.xml", name="sample_rss_feed_news")
     * @Template("@SampleRssFeed/news.xml.twig")
     *
     * @param Request $request
     * @param int $page_no
     * @param Paginator $paginator
     * @return array
     */
    public function index(Request $request, int $page_no = 1, Paginator $paginator)
    {
//        $news = $this->newsRepository->getList();

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
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
            ;

        return [
            'news' => $news,
        ];
    }
}
