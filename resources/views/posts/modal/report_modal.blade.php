<div class="hidden fixed top-0 left-0 h-screen w-screen bg-black/50 flex justify-center items-center font-serif" id="report_modal">
    <div class="bg-zinc-800 rounded-lg w-1/3 min-h-64 max-h-content py-4 flex flex-col">
        <h1 class="text-white text-2xl ml-4 mb-2">Report Blog Post?</h1>
        <div class="w-full border bg-neutral-600 mb-4"></div>

        <div class="w-full px-12 flex justify-center gap-8 text-xl text-white">
            <form action="/posts/{{$post->id}}/report" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="report_type">Report Type:</label>
                    <select name="report_type" id="report_type" class="text-black">
                        <option value="{{\App\Enums\Report::SPAM}}" selected>Spam</option>
                        <option value="{{\App\Enums\Report::INAPPROPRIATE}}" >Inappropriate Content</option>
                        <option value="{{\App\Enums\Report::BULLYING}}" >Bullying</option>
                    </select>
                </div>

                <div class="flex flex-col justify-center mb-6">
                    <label for="additional_comment">Any additional comments (optional):</label>
                    <textarea class="text-black" name="additional_comment" id="additional_comment" cols="30" rows="5"></textarea>
                    @error('additional_comment')
                        <p class='text-red-400'>{{$message}}</p>
                    @enderror
                </div>

                <div class="flex justify-center gap-2 mb-6">
                    <button type="button" class="bg-red-500 w-24 h-8 rounded text-white hover:cursor-pointer" onclick="closeReportModal()">Close</button>
                    <input class="bg-green-600 w-24 h-8 rounded text-white hover:cursor-pointer" type="submit" value="Submit">
                </div>
            </form>

        </div>
    </div>
</div>