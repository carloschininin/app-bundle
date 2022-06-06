<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Controller;

use CarlosChininin\AppUtil\Message\MessageDto;
use CarlosChininin\AppUtil\Message\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    /** @param MessageDto[] $messages */
    protected function addFlashMessages(array $messages): void
    {
        foreach ($messages as $message) {
            $this->addFlashMessage($message->message(), $message->type());
        }
    }

    protected function addFlashMessage(string $message, MessageType $type = MessageType::SUCCESS): void
    {
        $this->addFlash($type->value, $message);
    }
}
