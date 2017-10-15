<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;
use Carbon\Carbon;
use DB;
use App\Tweet;
use App\Users;

class TwitterController extends Controller
{
    public function index() {
        return view('index');
    }

    public function analyseTweet(Request $request) {
        if (empty($request->tweet))
           return back()->withErrors(['tweet' => 'Please input tweet url!!']);
        else {
            $tweetArray = explode('/status/', $request->tweet);
            if(count($tweetArray) === 1) {
                return back()->withErrors(['tweet' => 'Invalid URL']);
            }else {
              // get tweet id from url
              $tweetId = $tweetArray[1];
              $result = $this->checkDuplication($tweetId);
              if (count($result) === 0){
                  return back()->withErrors(['tweet' => 'Tweet has no retweet.']);
              }else {
                  return view('result')->with('Users', $result);
              }
            }
        }
    }

    private function checkDuplication($tweetURL) {
        // get time 2 hours ago
        $twoHoursAgo = Carbon::now('Asia/Bangkok')->subHour(2);
        // check if tweet url already exist, get data from database
        $existTweet = Tweet::where('url', '=', $tweetURL)->first();
        $users = array();
        if (!is_null($existTweet) && ($existTweet->created_at->gt($twoHoursAgo))) {
            $users = Users::where('tweet_id', $existTweet->id)->get();
            foreach ($users as $value => $user) {
                $users[$value]["followers"] = $user->follower;
                $users[$value]["name"] = $user->name;
            }
            return $users;
        } else {
            $userIds = $this->getUser($tweetURL);
            // test if have one db insert fail don't insert other too
            try {
                DB::beginTransaction();
                $tweet = Tweet::create([
                            'url' => $tweetURL,

                        ]);
                if(!$tweet){
                   DB::rollBack();
                }
                if(count($userIds)){
                    foreach ($userIds as $value => $user) {
                        // get number of followers of user
                        $followers = Twitter::getFollowersIds(['id' => $user]);
                        $users[$value]["followers"] = count($followers->ids);
                        // get name of user
                        $name = Twitter::getUsers(['user_id' => $user]);
                        $users[$value]["name"] = $name->name;
                        $insertUser = Users::create([
                                        'name' => $name->name,
                                        'follower' => count($followers->ids),
                                        'tweet_id' => $tweet->id
                                    ]);
                        if(!$insertUser){
                          DB::rollBack();
                        }
                    }
                    DB::commit();
                }
                return $users;
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
    }

    private function getUser($tweetId) {
        $retweeters = Twitter::getRters(['id' => $tweetId]);
        return $retweeters->ids;
    }
}
