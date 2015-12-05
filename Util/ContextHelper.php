<?php

/*
 * This file is part of the FOSRestBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\RestBundle\Util;

use FOS\RestBundle\Context\GroupableContextInterface;
use FOS\RestBundle\Context\SerializeNullContextInterface;
use FOS\RestBundle\Context\VersionableContextInterface;
use FOS\RestBundle\Context\MaxDepthContextInterface;
use JMS\Serializer\Context as JMSContext;

/**
 * @author Ener-Getick <egetick@gmail.com>
 *
 * @internal
 */
final class ContextHelper
{
    public static function getGroups($context)
    {
        if ($context instanceof GroupableContextInterface) {
            return $context->getGroups();
        } elseif ($context instanceof JMSContext) {
            try {
                return $context->attributes->get('groups')->get();
            } catch (\Exception $e) {
            }
        }
    }

    public static function addGroups($context, array $groups)
    {
        if ($context instanceof GroupableContextInterface) {
            return $context->addGroups($groups);
        } elseif ($context instanceof JMSContext) {
            return $context->setGroups($groups);
        }
    }

    public static function getVersion($context)
    {
        if ($context instanceof VersionableContextInterface) {
            return $context->getVersion();
        } elseif ($context instanceof JMSContext) {
            try {
                return $context->attributes->get('version')->get();
            } catch (\Exception $e) {
            }
        }
    }

    public static function setVersion($context, $version)
    {
        if ($context instanceof GroupableContextInterface || $context instanceof JMSContext) {
            return $context->setVersion($version);
        }
    }

    public static function getSerializeNull($context)
    {
        if ($context instanceof SerializeNullContextInterface) {
            return $context->getSerializeNull();
        } elseif ($context instanceof JMSContext) {
            return $context->shouldSerializeNull();
        }
    }

    public static function setSerializeNull($context, $serializeNull)
    {
        if ($context instanceof SerializeNullContextInterface || $context instanceof JMSContext) {
            return $context->setSerializeNull($serializeNull);
        }
    }

    public static function setMaxDepth($context, $maxDepth)
    {
        if ($context instanceof MaxDepthContextInterface) {
            $context->setMaxDepth($maxDepth);
        } elseif ($context instanceof JMSContext) {
            $context->enableMaxDepthChecks();
        }
    }
}
