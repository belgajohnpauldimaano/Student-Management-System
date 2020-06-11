<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Faculty Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        .page-break {
            page-break-after: always;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            font-size : 10px;
        }
    </style>
</head>
<body>

    <h2>Enrolled Students</h2>
    <div>

        <div></div><label for="">School Year:</label> <strong><?php echo e($ClassDetail->school_year); ?></strong></div>
        <div><label for="">Grade & Section:</label> <strong><?php echo e($ClassDetail->grade_level); ?> - <?php echo e($ClassDetail->section); ?></strong></div>
        <div><label for="">Room:</label> <strong><?php echo e($ClassDetail->room_code); ?></strong></div>
        
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Number</th>
                        <th>Student Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($Enrollment): ?>
                        <?php $__currentLoopData = $Enrollment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><?php echo e($data->username); ?></td>
                                <td><?php echo e($data->fullname); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>