<?php 
    $user = User::find_by_id($user_id);

    if($user->user_type == "counsellor"){
        //sql to 
    } elseif($user->user_type == "front_desk") {

    } 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sessions</h4>
                    <p class="category">Here is a subtitle for this table</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Datetime</th>
                            <th>Problem</th>
                            <th>Session Actions</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1234567</td>
                                <td>Dakota Rice</td>
                                <td>20-11-11</td>
                                <td>Love Issues</td>
                                <td>
                                    <?php if($user->user_type == "counsellor"){ ?>
                                    <a data-toggle ="modal" href="#start_sess_modal">Start </a>|
                                    <a data-toggle ="modal" href="#end_sess_modal"> End </a>|
                                    <?php } ?>
                                    <a data-toggle ="modal" href="#refer_sess_modal"> Refer </a>|
                                    <a data-toggle ="modal" href="#add_sess_modal"> Add </a>|
                                    <a data-toggle ="modal" href="#rem_sess_modal"> Remove </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>