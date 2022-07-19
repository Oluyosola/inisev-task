- This platform allows a user to subscribe to a website and read posts related to the website susbcribed to.
- include a .env file in the project diectory and set up db details
- Run composer install to have the vendor folder that includes dependencies
- Kindly run php artisan migrate to set up the db.
- configure smtp configuration to allow email sending in .env file
- Seed the website table using php artisan db:seed --class=websiteSeeder

#Subscribe
- api for subscription {{base_url}}/api/subscribe
    method: POST
    the parameters required to subscribe are (name, email, website)
- A user can only subscribe to a website once, email is used to do the check
- A user can only subscribe to a website that exists in the website table, The website name is used for the check


#create Post
- api for creating a post is {{base_url}}/api/create-post
    method: POST
    the parameters required to create a post are (title, description, website, create_by)
- A user can only make a post with the same post title once to avoid duplicate posts.
- A user can make a post under a wesite that exists

- mail can be sent to all subscribers using the command "php artisan emails:send"

#What I am unable to achieve
- Use of Queues to schedule sending of mail in background how ever I was able to use schedule.

#Feedback
- Though a considerable amount of time was given, however I can Improve on this if I have a little more time to.
