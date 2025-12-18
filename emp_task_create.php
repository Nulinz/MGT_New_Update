<div class="sidebodyhead mb-3">
    <h4 class="m-0">Create Task</h4>
</div>
<form action="">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="assignto">Assign To</label>
            <select class="form-select" name="assignto" id="assignto" autofocus>
                <option value="" selected disabled>Select Option</option>
                <option value="">Employee List</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="tasktitle">Task Title</label>
            <input class="form-control" name="tasktitle" id="tasktitle" placeholder="Enter Task Title">
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="category">Category</label>
            <select name="cat" id="cat" class="form-select">
                <option value="" selected disabled>Select Category</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="subcategory">Sub Category</label>
            <select name="subcat" id="subcat" class="form-select">
                <option value="" selected disabled>Select Sub Category</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="priority">Priority</label>
            <select name="priority" id="priority" class="form-select">
                <option value="" selected disabled>Select Priority</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 inputs">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 inputs pe-2 mb-2">
                    <label for="startdate">Start Date</label>
                    <input type="date" class="form-control" name="stdate" id="startdate">
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 inputs pe-2 mb-2">
                    <label for="starttime">Start Time</label>
                    <input type="time" class="form-control" name="starttime" id="starttime">
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 inputs">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-xl-6 inputs pe-2 mb-2">
                    <label for="enddate">End Date</label>
                    <input type="date" class="form-control" name="enddate" id="enddate">
                </div>
                <div class="col-sm-12 col-md-6 col-xl-6 inputs pe-2 mb-2">
                    <label for="endtime">End Time</label>
                    <input type="time" class="form-control" name="endtime" id="endtime">
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-xl-12 mb-2 inputs">
            <label for="description">Description</label>
            <textarea rows="1" class="form-control" name="des" id="description"
                placeholder="Enter Description"></textarea>
        </div>
        <div class="col-12 d-flex align-items-center justify-content-center mt-2">
            <button type="button" class="formbtn">Save</button>
        </div>
    </div>
</form>