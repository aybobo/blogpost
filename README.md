#Blog Test
#The project is built with laravel 
#Authentication is done with laravel passport but custom token is assigned instead of randomly generating custom.
#All routes are guarded except the login route
#The relationship between Blog and post is one to many that is a blog can have many posts but a post can only belong to a blog
#The relationship between Post and comment is one to many that is a post can have many comment but a comment can only belong to one post
#The relationship between post and likes is one to many that is a post can have many likes but a like can only belong to one post
#Proper relationship definition allows to load records with their relations