The Password Reset Flow
In this episode, we'll discuss the basic password reset flow. If a user forgets their password, a series of actions need to take place: they request a reset; we prepare a unique token and associate it with their account; we fire off an email to the user that contains a link back to our site; once clicked, we validate the token in the link against what is stored in the database; we allow the user to set a new password. Luckily, Laravel can handle this entire workflow for us automatically.

1 Click forgot password button V
2 Fill out a form with their email address V
3 Prepare a unique token and associate it with the user's account V
4 Send an email with a unique link back to our site that confirms email ownership V
5 Link back to website confirm the token and set a new password V
 
