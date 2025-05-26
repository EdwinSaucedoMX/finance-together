<?php

namespace App\Http\Middleware;

use App\Models\Group;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateJoinRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->query('email');
        $groupId = $request->query('groupId');
        if (!$email || !$groupId) {
            abort(401, 'No autorizado.');
        }
        $group = Group::find($groupId);
        if (!$group) {
            abort(404, 'No autorizado.');
        }

        // Check if the email exists in the database
        $user = User::where('email', $email)->first();
        if (!$user) {
            // Redirect to the register page
            return redirect()->route('register', ['email' => $email, 'groupId' => $groupId]);
        }
        // Check if is logged in
        if (auth()->check()) {
            // Check if the logged-in user is the same as the user with the email
            if (auth()->user()->email !== $email) {
                abort(401, 'No autorizado.');
            } else {
                // Check if the user is already a member of the group
                if ($group->users()->where('user_id', auth()->user()->id)->exists()) {
                    // Redirect to the group page
                    return redirect()->route('specific-group', ['id' => $groupId]);
                } else {
                    // Add the user to the group
                    $group->users()->attach(auth()->user()->id);
                    // Redirect to the group page
                    return redirect()->route('specific-group', ['id' => $groupId]);
                }
            }
        } else if (auth()->guest()) {
            // Log in the user
            return redirect()->route('login', ['email' => $email, 'groupId' => $groupId]);
        } else {

            return $next($request);
        }


    }
}
