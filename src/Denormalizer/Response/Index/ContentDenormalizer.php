<?php

/*
 * This file is part of the Ministry of Truth client <https://github.com/symfony-doge/ministry-of-truth-client>.
 *
 * (C) 2019 Pavel Petrov <itnelo@gmail.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license https://opensource.org/licenses/mit MIT
 */

declare(strict_types=1);

namespace SymfonyDoge\MinistryOfTruthClient\Denormalizer\Response\Index;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\ContentDto;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Index\TagDto;
use UnexpectedValueException;

/**
 * Converts an index node from response into a ContentDto instance.
 */
class ContentDenormalizer implements DenormalizerInterface
{
    /**
     * Converts a tag array node to a tag object
     *
     * @var DenormalizerInterface
     */
    private $tagDenormalizer;

    /**
     * ContentDenormalizer constructor.
     *
     * @param DenormalizerInterface $tagDenormalizer Converts a tag node from response to a tag object
     */
    public function __construct(DenormalizerInterface $tagDenormalizer)
    {
        $this->tagDenormalizer = $tagDenormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_array($data)) {
            throw new UnexpectedValueException('Data array for index content hydration is empty.');
        }

        $nodeNames = array_keys($data);
        $nodeNamesExpected = [ContentDto::PROPERTY_VALUE, ContentDto::PROPERTY_TAGS];

        if ($nodeNames != $nodeNamesExpected) {
            throw new UnexpectedValueException('Invalid data array for index content hydration.');
        }

        $content = new ContentDto();

        $value = (float) $data[ContentDto::PROPERTY_VALUE];
        $content->setValue($value);

        $tags = $data[ContentDto::PROPERTY_TAGS];

        if (!is_array($tags)) {
            throw new UnexpectedValueException('Expecting tags node as an array for index content hydration.');
        }

        foreach ($tags as $tagGroupName => $tagNodes) {
            foreach ($tagNodes as $tagNode) {
                /** @var TagDto $tag */
                $tag = $this->tagDenormalizer->denormalize($tagNode, TagDto::class);

                $content->addTag($tagGroupName, $tag);
            }
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return ContentDto::class === $type;
    }
}
