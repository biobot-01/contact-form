<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label class="text-dark-blue" for="fullName">Full Name (required)</label>
        <input class="input" type="text" name="fullName" value size="40" placeholder="Your full name.." required value="<?php echo $fullName; ?>"></input>
        <span>* <?php if(isset($fullName_error)) echo $fullName_error; ?></span>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="email">Email Address (required)</label>
        <input class="input" type="email" name="email" value size="40" placeholder="Your email address.." required value="<?php echo $email; ?>"></input>
        <span>* <?php if(isset($email_error)) echo $email_error; ?></span>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="phoneNumber">Phone Number (required)</label>
        <input class="input" type="tel" name="phoneNumber" value size="14" placeholder="Your phone number.." required value="<?php echo $phoneNumber; ?>"></input>
        <span>* <?php if(isset($phoneNumber_error)) echo $phoneNumber_error; ?></span>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="subject">Subject (required)</label>
        <input class="input" type="text" name="subject" value size="40" placeholder="Nature of enquiry.." required value="<?php echo $subject; ?>"></input>
        <span>* <?php if(isset($subject_error)) echo $subject_error; ?></span>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="message">Message (required)</label>
        <textarea class="input" name="message" cols="40" rows="10" placeholder="Write your message.." required value="<?php echo $message; ?>"></textarea>
        <span>* <?php if(isset($message_error)) echo $message_error; ?></span>
        <p class="hide">Leave this empty <input type="text" name="url"></input></p>
    </fieldset>

    <fieldset>
        <input class="btn round text-white btn--contact" type="submit" value="Submit"></input>
    </fieldset>
</form>
