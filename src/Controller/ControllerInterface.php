<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace CarlosChininin\AppBundle\Controller;

use CarlosChininin\AppUtil\Message\MessageType;

interface ControllerInterface
{
    public function addFlashMessages(array $messages): void;

    public function addFlashMessage(string $message, MessageType $type = MessageType::SUCCESS): void;
}
