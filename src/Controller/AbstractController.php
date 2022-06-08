<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Controller;

use CarlosChininin\AppUtil\Message\MessageDto;
use CarlosChininin\AppUtil\Message\MessageType;

abstract class AbstractController implements ControllerInterface
{
    /** @param MessageDto[] $messages */
    public function addFlashMessages(array $messages): void
    {
        foreach ($messages as $message) {
            $this->addFlashMessage($message->message(), $message->type());
        }
    }

    abstract public function addFlashMessage(string $message, MessageType $type = MessageType::SUCCESS): void;
}
