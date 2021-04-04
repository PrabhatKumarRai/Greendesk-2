<?php 
    include_once __DIR__.'/../includes/header.php';

    if(!isset($_GET['data'])){
        header("Location: ../");
        exit;
    }

    include_once __DIR__.'/../modal/enquiry.class.php';
    include_once __DIR__.'/../modal/post.class.php';

    $enquiry = new Enquiry();
    $post = new Post();
?>


<div class="dashboard-detail-container">
        <!-- Enquiry Section -->
    <?php if($_GET['data'] == "enquiry"){ ?>
        <?php
            $result = $enquiry->GetAllUnreadEnquiry();        
        ?>
        <?php if($result == '' || $result == '0'){ ?>
        
            <!-- Not Exists Section -->
            <div class="post-container text-center border-0">
                    <div class="post-inner text-light p-3 bg-secondary w-100">
                    <div class="post-bottom">
                        <h2>No Enquiry Exists</h2>
                    </div>
                </div>
            </div>
        
        <?php } else{ ?>
            <!-- Enquiry List -->
            <div class="Enquiry-container">
                <div class="font-weight-500 mb-3 font-italic">
                    Total Enquiry : <?= $result->num_rows ?>
                </div>     
                <div class="accordion" id="Enquiry_list">
                    <?php while($row = $result->fetch_assoc()){ ?>
                        <div class="card mb-3">                
                            <div class="card-header d-flex" id="enquiry_heading_<?= $row['id']; ?>">
                                <div class="w-75 font-weight-bold limit-1">
                                    <a href="#" class="collapsed text-decoration-none text-dark" data-toggle="collapse" data-target="#enquiry_<?= $row['id']; ?>" aria-expanded="false" aria-controls="enquiry_<?= $row['id']; ?>">
                                        <?= $row['subject']; ?>
                                    </a>
                                </div>
                                <div class="w-25 pl-2 limit-1">by, <?= $row['name']; ?></div>
                                <!-- Delete Icon -->
                                <div class="delete-icon">
                                    <a href="#" class="text-dark" data-toggle="modal" data-target="#deleteEnquiryModal">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <!-- Replied Symbol -->
                                <?php if(!empty($row['reply'])){ ?>
                                    <div class="replied-symbol-outer">
                                        <div class="replied-symbol-inner">                                    
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="enquiry_<?= $row['id']; ?>" class="collapse" aria-labelledby="enquiry_heading_<?= $row['id']; ?>" data-parent="#Enquiry_list">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-wrap mb-3 font-weight-500 font-14">
                                        <!-- Email ID -->
                                        <div>
                                            Email ID : <?= $row['email'] ?>
                                        </div>
                                        <!-- Date -->
                                        <div>
                                            Date: <?= date('d M,Y h:i:s a', strtotime($row['date'])); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="font-weight-500">Enquiry : </span>
                                        <?= $row['content']; ?>
                                    </div>
                                    <!----------- Reply Starts ----------->
                                    <!-- Display Sent Reply -->
                                    <?php if(!empty($row['reply'])){ ?>
                                    <div class="enquiry-sent-reply mt-3 mb-2">
                                        <span class="text-success"><span class="font-weight-bold">Replied</span> on <?= date('d M,Y h:i:s a' , strtotime($row['reply_date'])); ?> : </span>
                                        <span><?= $row['reply']; ?></span>                            
                                    </div>
                                    <form action="../controller/enquiry.inc.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                        <button class="btn btn-danger btn-sm rounded-0" name="delete-reply">Delete Reply</button>
                                    </form>
                                    <?php }else{ ?>
                                    
                                    <!-- Send Reply -->
                                    <div class="mt-3">
                                        <form action="../controller/enquiry.inc.php" method="POST">
                                            <input type="hidden" name="enquiry-id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="enquiry-email" value="<?= $row['email'] ?>">
                                            <input type="hidden" name="enquiry-subject" value="<?= $row['subject'] ?>">
                                            <div class="form-group">
                                                <textarea name="enquiry-reply"cols="30" rows="5" class="form-control rounded-0" placeholder="Send Reply.."></textarea>
                                            </div>
                                            <button class="btn btn-primary rounded-0 py-1 px-4" name="send">Send</button>
                                        </form>
                                    </div>
                                    <?php } ?>
                                    <!----------- Reply Ends ----------->
                                </div>
                            </div>                
                            <!-- Delete Confirmation Modal Section Starts -->
                            <div class="modal fade" id="deleteEnquiryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Delete Confirmation</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <h5>Are You Sure to Delete this Enquiry ?</h5>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <form action="../controller/enquiry.inc.php" method="POST">
                                            <input type="hidden" name="delete-id" value="<?= $row['id']; ?>">
                                            <button class="btn btn-danger rounded-0" name="delete">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-primary rounded-0" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Confirmation Modal Section End -->
                        </div>                
                    <?php } ?>
                </div>
            
            </div>        
        <?php } ?>

    <?php } 

        // Draft Post Section
        elseif($_GET['data'] == "draft"){ 
    ?>
        <?php 
            $result = $post->ReadDraftPost();
            if($result != '' && $result != '0'){
                while($row = $result->fetch_assoc()){
        ?>
                    <div class="post-list-item jumbotron p-2 mb-3 rounded-0">
                        <h3><a href="postdetail.php?post_id=<?= $row['post_id']; ?>&f_id=<?= $row['f_id']; ?>"><?= $row['title']; ?></a></h3>

                        <!-- Post Updated Section -->
                        <?php if($row['last_updated'] != ''){ ?>    <!-- if the post creation date and the post updated dates are not the same then display the Last Updated Section -->
                            <div class="font-12 font-weight-500">
                                Last Updated : <span class="text-dark underline"><?= date('d M, Y h:i:s a', strtotime($row['last_updated'])); ?></span>
                            </div>
                        <?php } ?>
                    </div>
        <?php
                }
            }
            else{
        ?>
                <!-- Not Exists Section -->
                <div class="post-container text-center border-0">
                    <div class="post-inner text-light p-3 bg-secondary w-100">
                        <div class="post-bottom">
                            <h4>No Draft Article Exists</h4>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>
    <?php } ?>

</div>



<?php 
    include_once __DIR__.'/../includes/footer.php';
?>