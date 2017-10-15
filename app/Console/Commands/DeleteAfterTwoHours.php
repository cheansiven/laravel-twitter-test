<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Tweet;
use App\Users;

class DeleteAfterTwoHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletedatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete tweet url & retweeted user after two hours';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $old_tweets = Tweet::where('created_at', '<=', Carbon::now('Asia/Bangkok')->subHour(2))->get();
        foreach ($old_tweets as $old_tweet){
            $retweets = Users::where('tweet_id', $old_tweet->id)->get();
            foreach($retweets as $retweet){
                $retweet->delete();
            }
            $old_tweet->delete();
        }
    }
}
