<?php

namespace Marbemac\AnalyticsBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;

class WoopraManager
{
    protected $dm;
    protected $m;
    protected $options;

    public function __construct(DocumentManager $dm, $options)
    {
        $this->dm = $dm;
        $this->m = $dm->getConnection()->selectDatabase($dm->getConfiguration()->getDefaultDB());

        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}