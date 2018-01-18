<?php

function volunteer_submissions() {
    require_once('setup-db.php');

    wp_enqueue_style( 'bplate-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );    
    wp_enqueue_style( 'bplate-custom', get_template_directory_uri().'/volunteer-component/email-backend.css' );

    echo "<div class='header-ms'>";
    echo "<h1>Volunteer Submissions</h1>";
    echo "<p><i class='fa fa-cogs' aria-hidden='true'></i> Powered By Majority Strategies</p>";
    echo "</div>";

    global $wpdb;
    $table_name = $wpdb->prefix . "users_volunteered";

    $delete = $_GET['delete'];
    if($delete){
        $wpdb->delete($table_name, array('id' => $delete));
        echo '<h2 class="deleted">Entry Successfully Deleted.</h2>';
    }

    echo '<div class="major-options">
            <a href="'.get_template_directory_uri().'/volunteer-component/email-export.php" class="export"><i class="fa fa-download" aria-hidden="true"></i> Export to CSV</a>
          </div>';

    $retrieve_data = $wpdb->get_results("SELECT * FROM $table_name");

    $menuURL = menu_page_url('volunteer-submissions', false);


    foreach($retrieve_data as $single){ 
        $deleteURL = $menuURL . '&delete=' . $single->id;
        ?>
        <div class="single-volunteer">
            <h3><?php echo $single->first_name ?> <?php echo $single->last_name ?></h3>
            <a class="delete" href="<?php echo $deleteURL ?>">Delete</a>
            <div class="inner">
                <div>
                    <h4>Address</h4>
                    <p><?php echo $single->address ?></p>
                    <p><?php echo $single->city ?>, <?php echo $single->state ?> <?php echo $single->zip ?></p>
                </div>

                <div>
                    <h4>Email</h4>
                    <?php echo $single->email ?>

                    <h4>Phone Number</h4>
                    <?php echo $single->phone ?>
                </div>

                <div>
                    <?php $listed = []; ?>

                    <h4>Volunteering Options</h4>
                    <?php 
                    if($single->option_fundraiser) {
                        $listed[] = 'Host a fundraiser';
                    } 
                    if($single->option_door) {
                        $listed[] = 'Go door to door';
                    } 
                    if($single->option_bumper) {
                        $listed[] = 'Sport a bumper sticker';
                    } 
                    if($single->option_yard_sign) {
                        $listed[] = 'Display a yard sign';
                    } 
                    if($single->option_poll) {
                        $listed[] = 'Work an election day poll';
                    }
                    if($single->option_editor) {
                        $listed[] = 'Write a letter to an editor';
                    }

                    if($listed){
                        echo implode(', ', $listed);
                    } else {
                        echo "None Selected";
                    }
                    ?>

                    <h4>Comment</h4>
                    <?php if($single->comment){
                        echo $single->comment;
                    } else {
                        echo 'No Comment';
                    } ?>
                </div>
            </div>
        </div>
    <?php }
}

?>