<div class="container-fluid px-0 header">
    <div class="container px-0 mt-2 tabbtns">
        <div class="my-2">
            <a href="./list_emp_task.php?type=progress"><button
                    class="listbtn <?php echo $type == 'progress' ? 'listbtnactive' : ''; ?>">In Progress</button></a>
        </div>
        <div class="my-2">
            <a href="./list_emp_task.php?type=hold"><button
                    class="listbtn <?php echo $type == 'hold' ? 'listbtnactive' : ''; ?>">Hold</button></a>
        </div>
        <div class="my-2">
            <a href="./list_emp_task.php?type=drop"><button
                    class="listbtn <?php echo $type == 'drop' ? 'listbtnactive' : ''; ?>">Dropped</button></a>
        </div>
        <div class="my-2">
            <a href="./list_emp_task.php?type=completed"><button
                    class="listbtn <?php echo $type == 'completed' ? 'listbtnactive' : ''; ?>">Completed</button></a>
        </div>
        <div class="my-2">
            <a href="./list_emp_task.php?type=scheduled"><button
                    class="listbtn <?php echo $type == 'completed' ? 'listbtnactive' : ''; ?>">Scheduled</button></a>
        </div>
    </div>
</div>