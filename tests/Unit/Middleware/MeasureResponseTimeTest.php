<?php

/* @noinspection PhpUnusedParameterInspection */
/* @noinspection PhpUnhandledExceptionInspection */
/* @noinspection PhpUndefinedMethodInspection */

use DefStudio\ClogDetector\Contracts\MeasureHttpResponseTime;
use DefStudio\ClogDetector\Exceptions\LongRunningException;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Request;
use function Spatie\PestPluginTestTime\testTime;

it('is disabled by default')
    ->expect(fn () => app(MeasureHttpResponseTime::class))
    ->enabled()->toBeFalse();

it('can be enabled at runtime')
    ->tap(fn () => app(MeasureHttpResponseTime::class)->enabled(true))
    ->expect(fn () => app(MeasureHttpResponseTime::class))
    ->enabled()->toBeTrue();

it('can be disabled at runtime')
    ->tap(fn () => app(MeasureHttpResponseTime::class)->enabled(true))
    ->tap(fn () => app(MeasureHttpResponseTime::class)->enabled(false))
    ->expect(fn () => app(MeasureHttpResponseTime::class)->enabled())
    ->toBeFalse();

test('max allowed time can be changed a runtime')
    ->tap(fn () => app(MeasureHttpResponseTime::class)->threshold(99))
    ->expect(fn () => app(MeasureHttpResponseTime::class)->threshold())
    ->toBe(99.0);

it('do nothing if response time is below threshold', function () {
    app(MeasureHttpResponseTime::class)->enabled(true);

    testTime()->freeze();
    $request = Request::create('/');
    $request->server->set('REQUEST_TIME_FLOAT', now()->timestamp);

    $response = app(MeasureHttpResponseTime::class)->handle(
        Request::create('/'),
        function (Request $request) {
            testTime()->addSeconds(5);

            return 'ok!';
        }
    );

    expect($response)->toBe('ok!');
});

it('reports an exception if response time breaks the threshold', function () {
    app(MeasureHttpResponseTime::class)->enabled(true);

    testTime()->freeze();
    $request = Request::create('/');
    $request->server->set('REQUEST_TIME_FLOAT', now()->timestamp);

    bind_mock(ExceptionHandler::class, report: function (LongRunningException $exception) {
        expect($exception->getMessage())->toBe('Last request took 6 seconds, max time was 5 seconds');

        return null;
    });

    $response = app(MeasureHttpResponseTime::class)->handle(
        $request,
        function (Request $request) {
            testTime()->addSeconds(6);

            return 'ok!';
        }
    );

    expect($response)->toBe('ok!');
});
