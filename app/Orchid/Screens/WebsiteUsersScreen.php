<?php

namespace App\Orchid\Screens;

use App\Models\User;
use App\Orchid\Filters\UserNameFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\UserNameFilterLayout;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Alert;

class WebsiteUsersScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'users' => User::latest()->filters(UserNameFilterLayout::class)->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Website Users';
    }

    public function description(): ?string
    {
        return 'Manage all website users here!';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            UserNameFilterLayout::class,

            Layout::table('users', [
                TD::make('name', 'User Name:')
                    ->render(fn(User $user) => $user->name . " (ID: {$user->id})"),
                TD::make('xp', 'User XP:')
                    ->render(fn(User $user) => number_format($user->xp) . ' XP'),
                TD::make('Is Banned?')
                    ->render(function(User $user){
                        $yesButton = Button::make('Yes')->type(Color::SUCCESS)->disabled();
                        $noButton = Button::make('No')->type(Color::ERROR)->disabled();
                        return $user->isBanned() ? $yesButton : $noButton;
                    }),
                TD::make('Actions:')
                    ->render(function(User $user){
                        $banButton = Button::make('Ban User')
                                        ->method('banUser', ['user' => $user->id]);

                        $unbanButton = Button::make('Unban User')
                            ->method('unbanUser', ['user' => $user->id]);
                        
                        if($user->isBanned()){
                            $banButton->disabled();
                        }  else {
                            $unbanButton->disabled();
                        }


                        return Group::make([
                            $banButton,
                            $unbanButton,
                            Button::make('Delete User')
                                ->method('deleteUser', ['user' => $user->id]),
                        ]);
                    })
            ])
        ];
    }

    public function banUser(User $user) {
        $user->ban();

        Alert::success('Successfully banned user!');

        return back();
    }

    public function unbanUser(User $user) {
        $user->unban();
        
        Alert::success('Successfully unbanned user!');

        return back();

    }

    public function deleteUser(User $user) {
        $user->delete();

        Alert::success('Successfully deleted user!');

        return back();
    }
}
