<?php

namespace App\Orchid\Screens;

use App\Enums\Report as EnumsReport;
use App\Models\Post;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use App\Models\Report;
use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Alert;

class ReportListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'reports' => Report::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Reports';
    }

    public function description(): ?string
    {
        return "Manage all available reports";
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
            Layout::table('reports', [
                    TD::make('report_type', 'Report Type')
                        ->render(function(Report $report){
                            return EnumsReport::from($report->reportType)->title();
                        }),

                    TD::make('post_id', 'Post:')
                        ->render(function(Report $report){
                            return Button::make('Redirect To Post (' . Post::find($report->post_id)->title . ')')
                            ->method('goToPost', ['post' => $report->post_id]);
                        }),

                    TD::make('user_id', "User:")
                        ->render(function(Report $report){
                            return Button::make('Redirect To User (' . User::find($report->user_id)->name . ')')
                                ->method('goToUser', ['user' => $report->user_id]);
                        }),

                    TD::make('Go To Actions')
                        ->render(function(Report $report){
                            return Link::make('Go To Actions')
                                ->route('reports.actions', $report);
                        }),
                    
                    TD::make('additional_comment', 'Additional Comment:')->width('100px'),
                ]),
        ];
    }

    public function goToPost(Post $post) {
        return redirect('posts/' . $post->id . "/");
    }

    public function goToUser(User $user) {
        return redirect('user/' . $user->id);
    }

    public function deleteReport(Report $report) {
        $report->delete();

        Alert::success('Successfully deleted report post!');

        return back();
    }

    // Deletes a selected post
    public function deletePost(Post $post) {
        $post->delete();

        Alert::success('Successfully deleted post!');

        return back();
    }
}
