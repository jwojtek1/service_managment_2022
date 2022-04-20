<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Panel</title>
        <link rel="icon" type="image/png" href="img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/login_form.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>
<body id="kanban">

<?php
    session_start();
    $user_type = $_SESSION['user_type'];
    require_once "connect.php";
?>

<?php 
    include_once "menu.php"; 
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);
?>

<main class="content">
    <div class="container p-0">

        <h1 class="h3 mb-3 kanban_name">Kanban <a href="contractCard_new.php"><i class="fas fa-plus"></i></a></h1>


        <!-- Nowe zlecenie -->
        <div class="row kanban">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card card-border-primary">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgb(3, 170, 192)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                    <circle cx="12" cy="12" r="1"></circle>
                                </svg>
                            </div>
                        </div>
                        <h5 class="card-title">Nowe zlecenie</h5> 
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="card-body p-3 column">

            <?php
            
                $contracts = $con->query('
                SELECT 
                    contract_id, 
                    contract_number, 
                    phase.name AS "phase", 
                    LEFT(description , 20) AS "description",
                    substr(creation_date, 1, 16) AS "creation_date", 
                    CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
                    company.name AS "company", 
                    CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
                    CASE 
                        WHEN priority = 1 THEN "1"
                        WHEN priority = 2 THEN "2"
                        WHEN priority = 3 THEN "3"
                        WHEN priority = 4 THEN "4"
                        WHEN priority = 5 THEN "5"
                    END AS "priority",
                    device.serial_number as "serial_number"
                FROM contract 
                LEFT JOIN phase using (phase_id)
                LEFT JOIN company using (company_id)
                LEFT JOIN company_user using (company_user_id)
                LEFT JOIN employee using (employee_id)
                LEFT JOIN device using (contract_id)
                WHERE contract.phase_id = 1
                AND (CASE WHEN '.$user_type.' = 2 THEN contract.company_id = '.$_SESSION['company_id'].'
                ELSE true END)
                ORDER BY priority, creation_date
                ');
                
                while($contract_new = $contracts->fetch_assoc())
                {
            ?>
                <div class="card mb-3 bg-light">
                    <div class="card-body p-3 card">
                        <div class="float-right mr-n2">
                            <label class="custom-control custom-checkbox">
                                    <img src="img/folder.png" width="24" height="24" alt="Avatar">
                                <a class="link-card" href="contractCard.php?id=<?php echo $contract_new['contract_id']; ?>"><?php echo $contract_new['contract_number']; ?> </a>
                                <div class="priority"><?php echo $contract_new['priority']; ?></div>
                            </label>
                        </div>
                        <p class="creation_date">Data utworzenia: <?php  echo $contract_new['creation_date']; ?></p> 
                        <p class="creation_date">Firma: <?php  echo $contract_new['company']; ?></p> 
                        <p class="creation_date">Osoba klienta: <?php  echo $contract_new['company_user']; ?></p> 
                        <div class="contract_details">
                            <a class="btn btn-outline-primary btn-sm" href="contractCard.php?id=<?php echo $contract_new['contract_id']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

            <?php
                }
            ?>
                </div>
            </div>
        </div>
        <!-- Analiza -->
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card card-border-warning">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgb(3, 170, 192)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                    </svg>
                            </div>
                        </div>
                        <h5 class="card-title">Analiza</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="card-body p-3 column">
                    <?php
            
                        $contracts = $con->query('
                        SELECT 
                            contract_id, 
                            contract_number, 
                            phase.name AS "phase", 
                            LEFT(description , 20) AS "description",
                            substr(creation_date, 1, 16) AS "creation_date", 
                            CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
                            company.name AS "company", 
                            CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
                            CASE 
                                WHEN priority = 1 THEN "1"
                                WHEN priority = 2 THEN "2"
                                WHEN priority = 3 THEN "3"
                                WHEN priority = 4 THEN "4"
                                WHEN priority = 5 THEN "5"
                            END AS "priority",
                            device.serial_number as "serial_number"
                        FROM contract 
                        LEFT JOIN phase using (phase_id)
                        LEFT JOIN company using (company_id)
                        LEFT JOIN company_user using (company_user_id)
                        LEFT JOIN employee using (employee_id)
                        LEFT JOIN device using (contract_id)
                        WHERE contract.phase_id = 2
                        AND (CASE WHEN '.$user_type.' = 2 THEN contract.company_id = '.$_SESSION['company_id'].'
                        ELSE true END)
                        ORDER BY priority, creation_date
                        ');
                        
                        while($contract_analysis = $contracts->fetch_assoc())
                        {
                    ?>
                        <div class="card mb-3 bg-light">
                            <div class="card-body p-3 card">
                                <div class="float-right mr-n2">
                                    <label class="custom-control custom-checkbox">
                                            <img src="img/folder.png" width="24" height="24" alt="Avatar">
                                        <a class="link-card" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><?php echo $contract_analysis['contract_number']; ?> </a>
                                        <div class="priority"><?php echo $contract_analysis['priority']; ?></div>
                                    </label>
                                </div>
                                <p class="creation_date">Data utworzenia: <?php  echo $contract_analysis['creation_date']; ?></p> 
                                <p class="creation_date">Firma: <?php  echo $contract_analysis['company']; ?></p> 
                                <p class="creation_date">Osoba klienta: <?php  echo $contract_analysis['company_user']; ?></p> 
                                <div class="contract_details">
                                    <a class="btn btn-outline-primary btn-sm" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?>
            </div>
        </div>
    </div>
        <!-- Realizacja -->
    <div class="col-12 col-lg-6 col-xl-3">
                <div class="card card-border-warning">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgb(3, 170, 192)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                            </div>
                        </div>
                        <h5 class="card-title">Realizacja</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="card-body p-3 column">
                    <?php
            
                        $contracts = $con->query('
                        SELECT 
                            contract_id, 
                            contract_number, 
                            phase.name AS "phase", 
                            LEFT(description , 20) AS "description",
                            substr(creation_date, 1, 16) AS "creation_date", 
                            CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
                            company.name AS "company", 
                            CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
                            CASE 
                                WHEN priority = 1 THEN "1"
                                WHEN priority = 2 THEN "2"
                                WHEN priority = 3 THEN "3"
                                WHEN priority = 4 THEN "4"
                                WHEN priority = 5 THEN "5"
                            END AS "priority",
                            device.serial_number as "serial_number"
                        FROM contract 
                        LEFT JOIN phase using (phase_id)
                        LEFT JOIN company using (company_id)
                        LEFT JOIN company_user using (company_user_id)
                        LEFT JOIN employee using (employee_id)
                        LEFT JOIN device using (contract_id)
                        WHERE contract.phase_id = 3
                        AND (CASE WHEN '.$user_type.' = 2 THEN contract.company_id = '.$_SESSION['company_id'].'
                        ELSE true END)
                        ORDER BY priority, creation_date
                        ');
                        
                        while($contract_analysis = $contracts->fetch_assoc())
                        {
                    ?>
                        <div class="card mb-3 bg-light">
                            <div class="card-body p-3 card">
                                <div class="float-right mr-n2">
                                    <label class="custom-control custom-checkbox">
                                            <img src="img/folder.png" width="24" height="24" alt="Avatar">
                                        <a class="link-card" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><?php echo $contract_analysis['contract_number']; ?> </a>
                                        <div class="priority"><?php echo $contract_analysis['priority']; ?></div>
                                    </label>
                                </div>
                                <p class="creation_date">Data utworzenia: <?php  echo $contract_analysis['creation_date']; ?></p> 
                                <p class="creation_date">Firma: <?php  echo $contract_analysis['company']; ?></p> 
                                <p class="creation_date">Osoba klienta: <?php  echo $contract_analysis['company_user']; ?></p> 
                                <div class="contract_details">
                                    <a class="btn btn-outline-primary btn-sm" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?>
            </div>
        </div>
    </div>

        <!-- Zakończone -->
    <div class="col-12 col-lg-6 col-xl-3">
                <div class="card card-border-warning">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <div class="dropdown show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgb(3, 170, 192)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                        <circle cx="26" cy="12" r="1"></circle>
                                    </svg>
                            </div>
                        </div>
                        <h5 class="card-title">Zakończone</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="card-body p-3 column">
                    <?php
            
                        $contracts = $con->query('
                        SELECT 
                            contract_id, 
                            contract_number, 
                            phase.name AS "phase", 
                            LEFT(description , 20) AS "description",
                            substr(creation_date, 1, 16) AS "creation_date", 
                            CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
                            company.name AS "company", 
                            CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
                            CASE 
                                WHEN priority = 1 THEN "1"
                                WHEN priority = 2 THEN "2"
                                WHEN priority = 3 THEN "3"
                                WHEN priority = 4 THEN "4"
                                WHEN priority = 5 THEN "5"
                            END AS "priority",
                            device.serial_number as "serial_number"
                        FROM contract 
                        LEFT JOIN phase using (phase_id)
                        LEFT JOIN company using (company_id)
                        LEFT JOIN company_user using (company_user_id)
                        LEFT JOIN employee using (employee_id)
                        LEFT JOIN device using (contract_id)
                        WHERE contract.phase_id = 4
                        AND (CASE WHEN '.$user_type.' = 2 THEN contract.company_id = '.$_SESSION['company_id'].'
                        ELSE true END)
                        ORDER BY priority, creation_date
                        ');
                        
                        while($contract_analysis = $contracts->fetch_assoc())
                        {
                    ?>
                        <div class="card mb-3 bg-light">
                            <div class="card-body p-3 card">
                                <div class="float-right mr-n2">
                                    <label class="custom-control custom-checkbox">
                                            <img src="img/folder.png" width="24" height="24" alt="Avatar">
                                        <a class="link-card" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><?php echo $contract_analysis['contract_number']; ?> </a>
                                        <div class="priority"><?php echo $contract_analysis['priority']; ?></div>
                                    </label>
                                </div>
                                <p class="creation_date">Data utworzenia: <?php  echo $contract_analysis['creation_date']; ?></p> 
                                <p class="creation_date">Firma: <?php  echo $contract_analysis['company']; ?></p> 
                                <p class="creation_date">Osoba klienta: <?php  echo $contract_analysis['company_user']; ?></p> 
                                <div class="contract_details">
                                    <a class="btn btn-outline-primary btn-sm" href="contractCard.php?id=<?php echo $contract_analysis['contract_id']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>

                    <?php
                        }
                    ?>
            </div>
        </div>
    </div>
    </div>

</div>
</main>

<?php include_once "footer.php"; ?>
</body>
</html>