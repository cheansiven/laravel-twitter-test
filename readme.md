# Laravel Tweet
This application will lookup the people who retweeted the tweet. If the tweet's url has already been insert within the last two hours, the app will retrieve the data from the database instead of calling the Twitter API.

Although the application works, it has a few limitations default by thujohn/twitter package:
* For tweets with more than 100 retweets, it can only get the first 100 users that retweeted it.
* If a user retweets a tweet but has more than 5000 followers, only the first 5000 followers are retrieved.
* At times, the Twitter API's rate limit can be reached due to too many calls, especially when retrieving a tweet with a large number of retweeters.
