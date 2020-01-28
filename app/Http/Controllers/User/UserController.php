<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserEditRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('is_admin')->only('create', 'store', 'edit', 'update', 'index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = $this->userRepository->paginate(10);
        return view('users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->only('name', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        $data['user_type'] = $request->get('is_admin') ? User::$ADMIN : User::$DATAENTRANT;
        User::create($data);
        return redirect()->to('users')->withSuccess('User Account Created');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('users.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('users.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserEditRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request, User $user)
    {
        //Todo update user to be part of staff
        // Add a checkbox to make a user staff
        $emailTaken = $this->userRepository->findByKey('email', $request->get('email'));
        $nameTaken = $this->userRepository->findByKey('name', $request->get('name'));
        if($emailTaken && $request->get('email') !== $user->email) {
            return back()->withErrors(['email_taken' => "email $emailTaken->email already in use"]);
        }
        if($nameTaken && $request->get('name') !== $user->name) {
            return back()->withErrors(['name_taken' => "name $emailTaken->name already in use"]);
        }

        $data = $request->only('email', 'name');

        if($request->get('is_admin') && !$user->is_admin) {
            $data['is_admin'] = true;
        } elseif (!$request->get('is_admin') && $user->is_admin) {
            $data['is_admin'] = false;
        }
        $user->update($data);
        return redirect()->to('users')->withSuccess('User Account Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->to('users')->withSuccess('user account Deleted');
    }
}
