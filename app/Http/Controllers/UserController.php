<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index(UserIndexRequest $request)
    {
        $filters = $request->defaults();

        $users = User::query()
            ->with('role')
            ->search($filters['q'])
            ->roleFilter($filters['role'])
            ->statusFilter($filters['status'])
            ->verifiedFilter($filters['verified'])
            ->sortBySafe($filters['sort'], $filters['dir'])
            ->paginate($filters['per_page'])
            ->withQueryString();

        $roles = Role::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('backend.users.index', [
            'users' => $users,
            'roles' => $roles,
            'filters' => $filters,
            'perPageAllowed' => [10, 25, 50, 100],
        ]);
    }

    public function create(){
        $roles = Role::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('backend.users.create', compact('roles'));
    }
    public function store(UserStoreRequest $request)
    {

        /**
         * Als validatie faalt, komt code hier nooit:
         * Laravel redirect automatisch terug met $errors en old().
         */
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'              => $data['name'],
                'email'             => $data['email'],
                'role_id'           => $data['role_id'],
                'is_active'         => $data['is_active'],
                'email_verified_at' => $data['email_verified_at'], // komt uit prepareForValidation
                'password'          => Hash::make($data['password']),
            ]);

            DB::commit();

            /**
             * SUCCESS redirect:
             * - naar index
             * - flash 'success' => wordt getoond via x-backend.flash in shell
             */
            return redirect()
                ->route('backend.users.index')
                ->with('success', "User '{$user->name}' created successfully.");

        } catch (Throwable $e) {

            DB::rollBack();

            /**
             * ERROR redirect (business error/DB error):
             * - back() => terug naar formulier
             * - withInput() => old() vult alle inputs opnieuw
             * - with('error', ...) => flash alert in shell
             */
            return back()
                ->withInput()
                ->with('error', 'User could not be created. Please try again.');
        }
    }

    public function edit(User $user)
    {
        /**
         * Route model binding:
         * - Laravel zoekt User op basis van {user} parameter
         * - Bestaat hij niet, dan geeft Laravel automatisch 404
         *
         * We laden roles voor de dropdown in het form.
         */
        $roles = Role::query()
            ->orderBy('name')
            ->get(['id', 'name']);

        /**
         * We sturen user + roles naar de view.
         * De form partial zal:
         * - prefillen met $user waarden
         * - old() laten winnen na validation errors
         */
        return view('backend.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        /**
         * validated() bevat enkel toegelaten velden.
         * Als validatie faalt:
         * - Laravel redirect automatisch terug
         * - $errors en old() worden gevuld
         * - x-backend.flash toont de errors
         */
        $data = $request->validated();

        try {
            DB::beginTransaction();

            /**
             * We updaten expliciet de velden die bij user horen.
             * Dit is duidelijker dan $user->update($data) omdat:
             * - password conditioneel is
             * - we willen exact zien wat aangepast wordt
             */
            $user->update([
                'name'              => $data['name'],
                'email'             => $data['email'],
                'role_id'           => $data['role_id'],
                'is_active'         => $data['is_active'],
                'email_verified_at' => $data['email_verified_at'],
            ]);

            /**
             * Password is optioneel bij update.
             * Alleen als het ingevuld is (niet null en niet leeg),
             * updaten we het password.
             */
            if (! empty($data['password'])) {
                $user->update([
                    'password' => Hash::make($data['password']),
                ]);
            }

            DB::commit();

            /**
             * Success: terug naar edit of naar index.
             * Best practice in admin is vaak: terug naar edit zodat je verder kan aanpassen.
             * Jij kan dit later aanpassen naar index als je dat liever hebt.
             */
            return redirect()
                ->route('backend.users.edit', $user)
                ->with('success', "User '{$user->name}' updated successfully.");

        } catch (Throwable $e) {

            DB::rollBack();

            /**
             * Business/DB error:
             * - terug naar form
             * - behoud input
             * - toon error flash
             */
            return back()
                ->withInput()
                ->with('error', 'User could not be updated. Please try again.');
        }
    }



}
