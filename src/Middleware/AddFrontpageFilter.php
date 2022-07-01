<?php

namespace FoF\FrontPage\Middleware;

use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddFrontpageFilter implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params = $request->getQueryParams();

        if (Arr::get($params, 'sort') === 'front') {
            $request = $request->withQueryParams(
                array_merge($params, [
                    'filter' => ['frontpage' => true],
                ])
            );

            return $handler->handle($request);
        }

        return $handler->handle($request);
    }
}
