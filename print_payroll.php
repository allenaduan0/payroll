<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
			*{
				font-family: 'Poppins', sans-serif;
			}
table{
    width:100%;
    border-collapse:collapse;
}
tr,td,th{
    border:1px solid black
}
.text-center{
    text-align:center;
}
.text-right{
    text-align:right;
}
</style>
<?php include('db_connect.php') ?>
<?php
		$pay = $conn->query("SELECT * FROM payroll where id = ".$_GET['id'])->fetch_array();
		$pt = array(1=>"Monhtly",2=>"Semi-Monthly");
?>
<div>
<h2 class="text-center">Payroll - <?php echo $pay['ref_no'] ?></h2>
<hr>
</div>
<table>
    <thead>
        <tr>
            <th class="text-center">Employee ID</th>
            <th class="text-center">Employee Name</th>
            <th class="text-center">Monthly Salary</th>
            <th class="text-center">Absent</th>
            <th class="text-center">Tardy/Undertime(mins)</th>
            
            <th class="text-center">Total Deduction</th>
            <th class="text-center">Net Pay</th>
        </tr>
    </thead>
    <tbody>
    <?php
									
        $payroll=$conn->query("SELECT p.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as ename,e.employee_no,e.salary FROM payroll_items p inner join employee e on e.id = p.employee_id ") or die(mysqli_error());
        while($row=$payroll->fetch_array()){
    ?>
    <tr>
        <td><?php echo $row['employee_no'] ?></td>
        <td><?php echo ucwords($row['ename']) ?></td>
        <td class="text-right"><?php echo number_format($row['salary'],2) ?></td>
        <td class="text-right"><?php echo $row['absent'] ?></td>
        <td class="text-right"><?php echo $row['late'] ?></td>
        
        <td class="text-right"><?php echo number_format($row['deduction_amount'],2) ?></td>
        <td class="text-right"><?php echo number_format($row['net'],2) ?></td>
    </tr>
    <?php
        }
    ?>
    </tbody>
</table>