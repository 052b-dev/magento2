<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Customer\Block\DataProviders;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Directory\Model\Country\Postcode\Config as PostCodeConfig;

/**
 * Provides postcodes patterns into template.
 */
class PostCodesPatternsAttributeData implements ArgumentInterface
{
    /**
     * @var PostCodeConfig
     */
    private $postCodeConfig;

    /**
     * @var Json
     */
    private $serializer;

    /**
     * Constructor
     *
     * @param PostCodeConfig $postCodeConfig
     * @param Json $serializer
     */
    public function __construct(PostCodeConfig $postCodeConfig, Json $serializer)
    {
        $this->postCodeConfig = $postCodeConfig;
        $this->serializer = $serializer;
    }

    /**
     * Get post codes in json format
     *
     * @return string
     */
    public function getPostCodesJson(): string
    {
        return $this->serializer->serialize($this->postCodeConfig->getPostCodes());
    }
}
