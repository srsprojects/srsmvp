<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EnsureNoXSSInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), []);
        foreach ($request->all() as $key => $value) {
            if (is_string($value) && containsMaliciousInput($value)) {
                $validator->errors()->add($key, 'Malicious Input Found');
                //throw new ValidationException($validator);
            }
        }
        if (!empty($validator->errors()->messages())) {
            throw new ValidationException($validator);
        }
        return $next($request);
    }
}
