<?php

namespace Marbemac\AnalyticsBundle\Document;

use Doctrine\ODM\MongoDB\DocumentManager;

class AnalyticsManager
{
    protected $dm;
    protected $m;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;

        $this->m = $dm->getConnection()->selectDatabase($dm->getConfiguration()->getDefaultDB());
    }
}