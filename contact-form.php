<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <label class="text-dark-blue" for="fullName">Full Name (required)<span>*</span></label>
        <input class="input" type="text" name="fullName" value size="40" placeholder="Your full name.." required value="<?php echo $fullName; ?>"></input>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="email">Email Address (required)<span>*</span></label>
        <input class="input" type="email" name="email" value size="40" placeholder="Your email address.." required value="<?php echo $email; ?>"></input>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="phoneNumber">Phone Number</label>
        <input class="input" type="tel" name="phoneNumber" value size="14" placeholder="Your phone number.." required value="<?php echo $phoneNumber; ?>"></input>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="subject">Subject (required)<span>*</span></label>
        <input class="input" type="text" name="subject" value size="40" placeholder="Nature of enquiry.." required value="<?php echo $subject; ?>"></input>
    </fieldset>

    <fieldset>
        <label class="text-dark-blue" for="message">Message (required)<span>*</span></label>
        <textarea class="input" name="message" cols="40" rows="10" placeholder="Write your message.." required value="<?php echo $message; ?>"></textarea>
        <p class="hide">Leave this empty <input type="text" name="url"></input></p>
    </fieldset>

    <fieldset>
        <input class="btn round text-white btn--contact" type="submit" value="Submit"></input>
    </fieldset>
</form>
