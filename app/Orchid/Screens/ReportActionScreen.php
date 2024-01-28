<?php

namespace App\Orchid\Screens;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ReportActionScreen extends Screen
{

    /**
     * @var Report
     */
    public $report;
    
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Report $report): iterable
    {
        return [
            'report' => $report
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Report Actions';
    }

    public function description(): ?string
    {
        return "Decide the fate of a report.";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {

        $banPostCreator = Button::make('Ban Post Creator')
                            ->method('banPostCreator')
                            ->icon('hammer');

        $banReportCreator = Button::make('Ban Report Creator')
                            ->method('banReportCreator')
                            ->icon('hammer');

        // Check whether the report creator is banned.
        if(User::find($this->report->user_id)->isBanned()) $banReportCreator->disabled();

        // Check whether the post creator is banned.
        if(Post::find($this->report->post_id)->user->isBanned()) $banPostCreator->disabled();

        return [
            $banPostCreator,
            $banReportCreator,
            Button::make('Delete Report')
                ->method('deleteReport')
                ->icon('trash'),
            Button::make('Delete Report and Post')
                ->method('deleteReportAndPost')
                ->icon('trash'),

        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            
        ];
    }

    public function banPostCreator() {
        $creator = Post::find($this->report->post_id)->user;

        $creator->ban();

        Alert::success('Successfully banned post creator!');

        return back();
    }

    public function banReportCreator() {
        $creator = User::find($this->report->user_id);

        $creator->ban();

        Alert::success('Successfully banned report creator!');
        
        return back();
    }

    public function deleteReport() {
        $this->report->delete();

        Alert::success('Successfully deleted report!');
        
        return back();
    }

    public function deleteReportAndPost() {
        // Since it cascades when we delete posts, we can just use this.
        Post::find($this->report->post_id)->delete();

        Alert::success('Successfully deleted report and post!');
        
        return to_route('reports.list');
    }
}
