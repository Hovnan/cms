
    <h2>Employees</h2>
    <div class="input-group">
        <input id = "search" type="text" class="form-control1" placeholder="Search for..." name="result">

      <span class="input-group-btn">
        <button class="btn btn-default" type="submit" name="search" onclick="searchResult()">Go!</button>
      </span>
        <div class="has-error" id="search_error"></div>
    </div>
    <div id="messages"></div>
    <button id="show" onclick="showList()" class="btn btn-info">Import attached JSON data of employees</button>
    <button id="create" onclick="createUser()" class="btn btn-primary">Create new Employee</button>
    <div id="info"></div>
