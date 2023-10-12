<?php
include('../includes/header.php');
include('../config/authentication.php');
?>

<style>
    input {
        background: transparent;
        border: none;
        border-bottom: 1px solid #000000;
    }
</style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="container border border-2 border-dark p-2">
                <h4 class="text-center "><strong>OFFICE PERFORMANCE CONTRACT AND REVIEW (OPCR) </strong></h4>
                <p>
                    I, <input type="text" />, head of the <input type="text" /> of the Local Government Unit
                    of Sta. Cruz, Occidental Mindoro, commit to deliver and agree to be rated on the attainment
                    of the following targets in accordance with the indicated measures for the period of <input type="text" />
                </p><br>
                <div class="d-flex justify-content-end align-items-center">
                    <div class="container">
                        <input type="text" /> <br>
                        <p>Head of the Office</p>
                    </div>
                </div>

            </div>
            <div class="container border border-top-0 border-2 border-dark p-2">
                <p>
                    Approved by: <input type="text" /> <br>
                </p>
            </div>
            <div class="container border border-top-0 border-2 border-dark p-2">
                <div class="row">
                    <div class="col">
                        <p>Date: <input type="text" /></p>
                    </div>
                    <div class="col">
                        <p>Date: <input type="text" /></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('../includes/footer.php');
?>