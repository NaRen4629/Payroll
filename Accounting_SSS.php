<?php
// Include necessary files and start session
include 'session.php';
include 'includes/Accounting-header.php';
include 'config/connection.php';
require_once 'Controller/controller_position.php';

// Initialize Position controller
$SSS = new Position();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Display Alert Messages -->
    <?php if (!empty($_SESSION['SSS-alert_success'])): ?>
        <div class="alert alert-dismissible fade show alert-<?php echo $_SESSION['SSS-alert_type']; ?>" role="alert">
            <?= $_SESSION['SSS-alert_success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php 
            unset($_SESSION['SSS-alert_success']);
            unset($_SESSION['SSS-alert_type']);
        ?>
    <?php endif; ?>

    <!-- Page Title -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">SSS</h1>
    </div>

    <!-- Add Contribution Modal Trigger -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSSS">Add SSS</button>
            <?php include 'add_sss.php' ?>
        </div>
    

    <!-- Data Table Card -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Contribution Name</th>
                            <th>Prices</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $database = new Connection();
                            $db = $database->open();

                            $sql = "SELECT 
                                        *
                                    FROM 
                                        tbl_contribution_sss
                                    INNER JOIN 
                                        tbl_contribution_sss_contents 
                                    ON 
                                        tbl_contribution_sss.sss_id = tbl_contribution_sss_contents.sss_id
                                    ORDER BY 
                                        CASE WHEN tbl_contribution_sss.status = 'Active' THEN 0 ELSE 1 END, -- Order by 'Active' status first
                                        tbl_contribution_sss.sss_id";

                            $result = $db->query($sql);

                            // Initialize an empty array to hold the grouped data
                            $contributions = [];

                            // Group the results by sss_id
                            foreach ($result as $row) {
                                $sss_id = $row['sss_id'];
                                if (!isset($contributions[$sss_id])) {
                                    $contributions[$sss_id] = [
                                        'contribution_name' => htmlspecialchars($row['contribution_name']),
                                        'prices' => [],  
                                        'status' => $row['status']
                                    ];
                                }
                                $contributions[$sss_id]['prices'][] = [
                                    'minimum_price' => number_format($row['minimum_price'], 2),
                                    'maximum_price' => number_format($row['maximum_price'], 2),
                                    'total' => number_format($row['total'], 2)
                                ];
                            }

                            // Display the grouped data in the table
                            foreach ($contributions as $sss_id => $contribution) {
                                ?>
                                <tr>
                                    <td><?= $contribution['contribution_name']; ?></td>
                                    <td>
                                        <?php 
                                        // Display each price range in the desired format
                                        $formattedPrices = [];
                                        foreach ($contribution['prices'] as $price) {
                                            $formattedPrices[] = "₱{$price['minimum_price']} to ₱{$price['maximum_price']} Deduction: ₱{$price['total']}";
                                        }
                                        echo implode('<br>', $formattedPrices);
                                        ?>
                                    </td>
                                    <td><?= $contribution['status']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                            <a href="#viewreqitem_<?= $sss_id; ?>" class="btn btn-info btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-eye"></i> View</a>
                                            <a href="#editUser_<?= $sss_id; ?>" class="btn btn-success btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-pen"></i> Edit</a>
                                            <!-- <a href="#deleteUser_<?= $sss_id; ?>" class="btn btn-danger btn-sm" data-bs-toggle="modal"><i class="fa-solid fa-trash"></i> Delete</a> -->
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } catch (PDOException $e) {
                            echo '<tr><td colspan="3">There is some problem in connection: ' . $e->getMessage() . '</td></tr>';
                        } finally {
                            // Close connection
                            if (isset($database)) {
                                $database->close();
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<?php
include 'includes/footer.php';
include 'includes/scripts.php';
?>
