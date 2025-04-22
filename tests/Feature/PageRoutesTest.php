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
    private const WHITE_LIST = [
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
        $whiteList = collect(self::WHITE_LIST);

        $failures = collect(Route::getRoutes())
            ->filter(
                fn($route) =>
                in_array('GET', $route->methods()) &&
                    is_string($route->uri()) &&
                    !str_contains($route->uri(), '{')
            )
            ->map(fn($route) => '/' . ltrim($route->uri(), '/'))
            ->mapWithKeys(function ($uri) use ($whiteList) {
                $response = $this->json('GET', $uri);
                $actual = $response->getStatusCode();

                if ($whiteList->has($uri)) {
                    $expected = $whiteList->get($uri);
                    if ($actual !== $expected) {
                        return [$uri => $this->recordFailure($uri, $actual, $expected)];
                    }
                } elseif ($actual !== 200) {
                    return [$uri => $this->recordFailure($uri, $actual, 200)];
                }

                return [];
            });

        if ($failures->isNotEmpty()) {
            $this->fail("以下 route 回傳錯誤狀態：\n" . $failures->implode("\n"));
        }

        $this->assertTrue(true);
    }

    private function recordFailure(string $uri, int $actual, int $expected): string
    {
        return "❌ [$uri] returned status $actual, expected $expected";
    }
}
