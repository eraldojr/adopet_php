<?php
declare(strict_types=1);
namespace adopet\View;

use Psr\Http\Message\ResponseInterface;

interface IViewRenderer
{
  public function render(string $template, array $context = []): ResponseInterface;
}
