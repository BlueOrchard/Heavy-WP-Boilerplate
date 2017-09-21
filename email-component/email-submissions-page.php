<?php

function email_submissions() {
    require_once('setup-db.php');

    wp_enqueue_style( 'bplate-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );    
    wp_enqueue_style( 'bplate-custom', get_template_directory_uri().'/email-component/email-backend.css' );

    echo "<div class='header-ms'>";
    echo "<h1>Email Submissions</h1>";
    echo "<p><i class='fa fa-cogs' aria-hidden='true'></i> Powered By Majority Strategies</p>";
    echo "</div>";

    global $wpdb;
    $table_name = $wpdb->prefix . "users_subscribed";

    $delete = $_GET['delete'];
    if($delete){
        $wpdb->delete($table_name, array('id' => $delete));
        echo '<h2 class="deleted">Entry Successfully Deleted.</h2>';
    }

    echo '<div class="major-options">
            <a href="'.get_template_directory_uri().'/email-component/email-export.php" class="export"><i class="fa fa-download" aria-hidden="true"></i> Export to CSV</a>
          </div>';

    $retrieve_data = $wpdb->get_results("SELECT * FROM $table_name");

    $menuURL = menu_page_url('email-submissions', false);

    echo '<table class="submissions-ms">';
    echo '<tr>';
    foreach($options_db as $option){
        echo '<th>'.$option->name.'</th>';
    }
    echo '<th>Options</th></tr>';
        foreach($retrieve_data as $single){ 
            $deleteURL = $menuURL . '&delete=' . $single->id;
            ?>

            <tr>
                <?php foreach($options_db as $option){ 
                    $slug = $option->slug;
                    echo '<td>'.$single->$slug.'</td>';
                } ?>
                <td class="options">
                    <a class="delete" href="<?php echo $deleteURL ?>">Delete</a>
                </td>
            </tr>

        <?php }
    echo '</table>';
}

?>