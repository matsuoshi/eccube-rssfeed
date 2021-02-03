<?php

namespace Plugin\SampleRssFeed\Entity;

use Doctrine\ORM\Mapping as ORM;

if (!class_exists('\Plugin\SampleRssFeed\Entity\Config', false)) {
    /**
     * Config
     *
     * @ORM\Table(name="plg_sample_rss_feed_config")
     * @ORM\Entity(repositoryClass="Plugin\SampleRssFeed\Repository\ConfigRepository")
     */
    class Config
    {
        /**
         * @var int
         *
         * @ORM\Column(name="id", type="integer", options={"unsigned":true})
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="IDENTITY")
         */
        private $id;

        /**
         * @var int
         *
         * @ORM\Column(name="feed_length", type="integer", options={"unsigned":true})
         */
        private $feed_length;

        /**
         * @return int
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return int
         */
        public function getFeedLength()
        {
            return $this->feed_length;
        }

        /**
         * @param int $feed_length
         *
         * @return $this;
         */
        public function setFeedLength(int $feed_length)
        {
            $this->feed_length = $feed_length;

            return $this;
        }
    }
}
