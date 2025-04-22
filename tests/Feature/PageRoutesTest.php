<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class PageRoutesTest extends TestCase
{
    /**
     * @array [uri,statusCode]
     */
    private $whiteList = [
        '/sanctum/csrf-cookie' => 204,
        '/graphql/repos' => 500,
        '/api/user' => 500,
        '/api/user/create' => 500,
        '/collections/works' => 500,
        '/collections/languages' => 500,
        '/collections/packagetools' => 500,
        '/collections/environments' => 500,
        '/collections/frameworks' => 500,
        '/collections/documents' => 500,
        '/setting' => 302,
        '/setting/sourcesites' => 500,
        '/setting/practiceType_environments' => 500,
        '/setting/practiceType_frameworks' => 500,
        '/test' => 500,
    ];

    /**
     * whiteList not null and not equal as statusCode will be catch
     */
    public function testPagesAreAccessible(): void
    {
        $whiteList = collect($this->whiteList);

        $failures = collect(Route::getRoutes())
            ->filter(
                fn($route) =>
                in_array('GET', $route->methods()) &&
                    is_string($route->uri()) &&
                    !str_contains($route->uri(), '{')
            )
            ->map(fn($route) => '/' . ltrim($route->uri(), '/'))
            ->reject(function ($uri) use ($whiteList) {
                $response = $this->json('GET', $uri);
                return (($whiteList->has($uri) &&
                    (!$whiteList->get($uri) || $response->getStatusCode() === $whiteList->get($uri))) ||
                    (!$whiteList->has($uri) && $response->getStatusCode() === 200));
            })
            ->map(fn($uri) => $this->recordFailure($uri, $this->json('GET', $uri)->getStatusCode()));

        if ($failures->isNotEmpty()) {
            $this->fail("以下 route 回傳錯誤狀態：\n" . $failures->implode("\n"));
        }

        $this->assertTrue(true);
    }

    private function recordFailure(string $uri, int $status): string
    {
        return "❌ [$uri] returned status $status, it must be {$this->whiteList[$uri]}";
    }
}
