<?php
include '../config/dbcon.php'; // Include your database connection file
include '../includes/header.php';

if (isset($_GET['id'])) {
    $evaluationID = $_GET['id'];
    
    // Fetch data from the evaluation_table based on the provided ID
    $fetchQuery = "SELECT * FROM evaluation_table WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $fetchQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $evaluationID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                // Display the fetched data in form inputs
?>
<div class="container mt-5 mb-5">
    <form action="../config/update_evaluation.php" method="POST">
        <input type="hidden" name="evaluationID" value="<?php echo $row['ID']; ?>">
        <input type="hidden" name="evaluatee_id" value="<?php echo $row['evaluatee_id']; ?>">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label for="semester">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester"
                        value="<?php echo $row['semester']; ?>">
                </div>
                <div class="col-sm-6">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $row['date']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <strong>
                        Category
                    </strong>
                </div>
                <div class="col-sm-4">
                    <strong>
                        MFO
                    </strong>
                </div>
                <div class="col-sm-4">
                    <strong>
                        Rating
                    </strong>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Strategic Objectives
                    </p>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="strategic_mfo" id="strategic_mfo"
                        value="<?php echo $row['strategic_mfo']; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="strategic_rating" id="strategic_rating"
                        value="<?php echo $row['strategic_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Core Function
                    </p>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="core_function_mfo" id="core_function_mfo"
                        value="<?php echo $row['core_function_mfo']; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="core_function_rating" id="core_function_rating"
                        value="<?php echo $row['core_function_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Support Function
                    </p>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="support_function_mfo" id="support_function_mfo"
                        value="<?php echo $row['support_function_mfo']; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="support_function_rating" id="support_function_rating"
                        value="<?php echo $row['support_function_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Total Overall Rating
                    </p>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="total_overall_rating" id="total_overall_rating"
                        value="<?php echo $row['total_overall_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Final Average Rating
                    </p>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="final_average_rating" id="final_average_rating"
                        value="<?php echo $row['final_average_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-center">
                        Adjective Rating
                    </p>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="adjective_rating" id="adjective_rating"
                        value="<?php echo $row['adjective_rating']; ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="supporting_document">Supporting Document <a href="<?php echo $row['supporting_document']; ?>"
                    class="" target="_blank">View Here </a></label>
            <input type="file" class="form-control" id="supporting_document" name="supporting_document" hidden>
            <small class="form-text text-muted" hidden>Uploading new file will overide the existing file.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
    </form>
</div>

<?php
include '../includes/footer.php';
            } else {
                echo "No data found for the provided ID";
            }
        } else {
            echo "Error fetching data";
        }
    } else {
        echo "Error preparing statement";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "No ID parameter provided";
}
?>

<script>
function goBack() {
    window.history.back();
}
</script>