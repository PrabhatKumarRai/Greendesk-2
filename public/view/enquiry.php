<?php

include_once __DIR__.'/../includes/header.php';


include_once 'alert.php';
?>

<div class="about-container index-container">
    <div class="about-inner index-inner text-center">
        <div>
            <div class="about-content">

                <!-- Detail -->
                <div class="contact-enquiry">
                    <h3 class="mb-4">Post an Enquiry..</h3>
                    <form action="../controller/enquiry.inc.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="enquiry-name" placeholder="Name.." value="<?= (isset($_GET['name']))? $_GET['name']: ''; ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="enquiry-email" placeholder="Email.." value="<?= (isset($_GET['email']))? $_GET['email']: ''; ?>">
                        </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="enquiry-subject" placeholder="Subject.." value="<?= (isset($_GET['subject']))? $_GET['subject']: ''; ?>">
                            </div>
                        <div class="form-group">
                            <textarea name="enquiry-detail" class="form-control" cols="30" rows="10" placeholder="Description.."><?= (isset($_GET['detail']))? $_GET['detail']: ''; ?></textarea>
                        </div>
                        <button class="btn btn-primary rounded-0" name="submit">Submit</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<?php include __DIR__.'/../includes/footer.php'; ?>