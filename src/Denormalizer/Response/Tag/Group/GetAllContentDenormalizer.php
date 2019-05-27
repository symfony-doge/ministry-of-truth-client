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

namespace SymfonyDoge\MinistryOfTruthClient\Denormalizer\Response\Tag\Group;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SymfonyDoge\MinistryOfTruthClient\Dto\Response\Tag\Group\ContentDto;
use UnexpectedValueException;

/**
 * Converts a tag groups data from response into a set of dto instances.
 */
class GetAllContentDenormalizer implements DenormalizerInterface
{
    /**
     * Converts an array with tag groups data to a set of objects
     *
     * @var DenormalizerInterface
     */
    private $tagGroupDenormalizer;

    /**
     * GetAllContentDenormalizer constructor.
     *
     * @param DenormalizerInterface $tagGroupDenormalizer Converts an array with tag groups data to a set of objects
     */
    public function __construct(DenormalizerInterface $tagGroupDenormalizer)
    {
        $this->tagGroupDenormalizer = $tagGroupDenormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_array($data) || empty($data)) {
            throw new UnexpectedValueException('Data array for tag groups hydration is invalid or empty.');
        }

        $tagGroups = [];

        foreach ($data as $tagGroupData) {
            $tagGroup = $this->tagGroupDenormalizer->denormalize($tagGroupData, ContentDto::class);

            $tagGroups[] = $tagGroup;
        }

        return $tagGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return ContentDto::class . '[]' === $type;
    }
}
