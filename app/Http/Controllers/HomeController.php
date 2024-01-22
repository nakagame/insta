<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{   
    private $post;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $home_posts      = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
            ->with('home_posts', $home_posts)
            ->with('suggested_users', $suggested_users);
    }

    public function suggestions() {
        $suggested_all_users = $this->getSuggestedUsersAll();

        if (is_array($suggested_all_users)) {
            $page = Paginator::resolveCurrentPage('page');
            $perPage = 3;
    
            $suggested_all_users = new \Illuminate\Pagination\LengthAwarePaginator(
                array_slice($suggested_all_users, ($page - 1) * $perPage, $perPage),
                count($suggested_all_users),
                $perPage,
                $page,
                ['path' => Paginator::resolveCurrentPath()]
            );
        } else {
            $suggested_all_users = $suggested_all_users->paginate(3);
        }
        
        return view('users.suggestions')->with('suggested_all_users', $suggested_all_users);
    }

    private function getHomePosts() {
        $all_posts = $this->post->latest()->get();
        // In case the $home_posts is empty, it will not return null, but instead empty
        $home_posts = [];
        foreach($all_posts as $post) {
            if($post->user->isFollowed() || $post->user->id == Auth::user()->id) {
                $home_posts[] = $post;
            }
        }

        return $home_posts;
    }

    # Get the users that the Auth user is not following - show 5 users
    private function getSuggestedUsers() {
        $all_users = $this->user->take(5)->get()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user) {
            if(!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return $suggested_users;
        // you can also use array_slice(array, start, length)
    }

    # Get the users that the Auth user is not following - show all users
    private function getSuggestedUsersAll() {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user) {
            if(!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        } 

        return $suggested_users;
    }


    public function search(Request $request) {
        $users = $this->user->where('name', 'like', '%'. $request->search. '%')->paginate(3);

        return view('users.search')
            ->with('users', $users)
            ->with('search', $request->search);
    }
}
