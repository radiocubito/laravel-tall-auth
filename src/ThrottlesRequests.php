<?php

namespace Radiocubito\TallAuth;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * https://medium.com/@DarkGhostHunter/laravel-my-flexible-throttlesrequests-trait-for-controllers-d0a6d2dec05d
 * https://gist.github.com/DarkGhostHunter/9e957bef5280d5f0694f763c33f8fb39#file-throttlesrequests-php
 */
trait ThrottlesRequests
{
    /**
     * Check if the request should be throttled
     *
     * @param $request
     * @param  bool $hit
     * @param  int|null $maxAttempts
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function checkThrottling($request, bool $hit = false, int $maxAttempts = null)
    {
        if ($this->hasTooManyAttempts($request, $maxAttempts)) {
            if (method_exists($this, 'fireThrottledEvent')) {
                $this->fireThrottledEvent($request);
            }

            return $this->sendThrottledResponse($request);
        }

        if ($hit) {
            $this->incrementAttempts($request);
        }
    }

    /**
     * Determine if the user has attempted too many times.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int|null $maxAttempts
     * @return bool
     */
    protected function hasTooManyAttempts(Request $request, int $maxAttempts = null)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $maxAttempts ?? $this->maxAttempts()
        );
    }

    /**
     * Increment the attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),
            $this->decayMinutes() * 60
        );
    }

    /**
     * Redirect the user after determining he is throttled.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendThrottledResponse(Request $request)
    {
        throw ValidationException::withMessages([
            Lang::get('auth.throttle', ['seconds' => $this->availableIn($request)]),
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Returns how many seconds until the request can be retried again
     *
     * @param  \Illuminate\Http\Request $request
     * @return int
     */
    protected function availableIn(Request $request)
    {
        return $this->limiter()->availableIn($this->throttleKey($request));
    }

    /**
     * Clear the number of attempts for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower(get_class($this) . '|' . $request->ip());
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return $this->limiter ?? $this->limiter = app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return $this->maxAttempts ?? 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return $this->decayMinutes ?? 1;
    }
}
