var container = document.getElementById('info');
var messages = document.getElementById('messages');

var ajaxSend = Object.create(null);

ajaxSend.setParams = function (method) {
    if(method == "POST"){
        var x;
        var result = '';
        for (x in this.params) {
            result += x+"="+ this.params[x]+"&";
        }
       return (result.slice(0, -1));
    }
    return null;
};

ajaxSend.greet = function (method, path)
{
    var result = this.setParams(method);

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open(method, path, true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded', true);
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200) {
            if(method == 'GET')
            {
                renderHTML(JSON.parse(this.responseText));
            }
            else
            {
                messages.innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.send(result);
};

//validation
var validate = Object.create(null);
validate.check = function ()
{
    var x;
    for (x in this.fields) {
        if(this.fields[x].trim() == '')
        {
            this.message = 'error';
            document.getElementById(x+'_error').innerHTML = x+' field must be required';
        }
        else
        {
            document.getElementById(x+'_error').innerHTML = '';
        }
    }
};

function createUser(){
        messages.innerHTML = '';
     var html = '<div id="createUser"><div class="form-group row">'+
        '<input type="text" class="form-control" id="new_name" name="name" placeholder="Name">'+
         '<div class="has-error" id="name_error"></div>'+
        '</div>'+
        '<div class="form-group row">'+
        '<input type="text" class="form-control" id="new_designation" name="designer" placeholder="Designation">'+
         '<div class="has-error" id="designation_error"></div>'+
        '</div>'+
        '<div class="form-group row">'+
        '<input type="text" class="form-control" id="new_gender" name="gender" placeholder="Gender">'+
         '<div class="has-error" id="gender_error"></div>'+
        '</div>'+
        '<div class="form-group row">'+
        '<button type="submit" class="btn btn-success" name="submit" onclick="storeEmployee()">Create</button>'+
        '</div>'+
        '</div>';
    container.innerHTML = html;
};

function storeEmployee() {

    var name = document.getElementById('new_name');
    var gender = document.getElementById('new_gender');
    var designation = document.getElementById('new_designation');

    var newVal = Object.create(validate);
    newVal.fields  = {
        name: name.value,
        gender: gender.value,
        designation: designation.value
    };
    newVal.message = '';
    newVal.check();
    if (newVal.message)
    {
        return false;
    }
    var store = Object.create(ajaxSend);
    store.params = {
        name: name.value,
        gender: gender.value,
        designation: designation.value
    };
    store.greet("POST", "/employee/create");
    container.innerHTML = '';
};

function searchResult()
{
    var search = document.getElementById('search');
    var newVal = Object.create(validate);
        newVal.fields  = {
            search: search.value
        };
    newVal.message = '';
    newVal.check();

    if (newVal.message)
    {
        return false;
    }
        container.innerHTML = '';
        messages.innerHTML = '';
        var searchObj = Object.create(ajaxSend);
        searchObj.greet("GET", "/employee/search?result="+search.value);
};

function updateUsers(elem) {

    messages.innerHTML = '';
    //document.getElementById('info').style.display = "block";
    document.getElementById('table').style.display = "none";
    var f = elem.id.split('_')[1];
    document.getElementById('update_'+f).style.display = "block";

};

function saveChanges(elem) {

    var ident = elem.id.split('_')[1];
    var name = document.getElementById('name_' + ident);
    var gender =document.getElementById('gender_' + ident);
    var designation = document.getElementById('designation_' + ident);

    var newVal = Object.create(validate);
    newVal.fields  = {
        name: name.value,
        gender: gender.value,
        designation: designation.value
    };
    newVal.message = '';
    newVal.check();
    if (newVal.message)
    {
        return false;
    }

    var store = Object.create(ajaxSend);
    store.params = {
        ident: ident,
        name: name.value,
        gender: gender.value,
        designation: designation.value
    };
    store.greet("POST", "/employee/update");

    container.innerHTML = '';
};

function deleteUsers(){

    var checkboxes = document.getElementsByName('approve[]');
    var res = '';

    for(i=0; i<checkboxes.length; i++){
        if(checkboxes[i].checked === false)
        {
            continue;
        }else{
            document.getElementById('tr_'+checkboxes[i].value).style.display = "none";
            res += checkboxes[i].value+',';
        }
    }
    if(res.length == 0){
        return false;
    }
    var del = Object.create(ajaxSend);
    del.params = {result: res};
    del.greet("POST", "/employee/delete");
};

function showList() {
    container.innerHTML = '';
    var list = Object.create(ajaxSend);
    list.greet("GET", "/data/employee_data.json");
};

function renderHTML(data)
{
    var htmlString = '';
    if (data.length) {

     htmlString += '<table id="table" class="table table-hover">' +
        '<thead>' +
        '<tr>' +
        '<th>#</th><th>Name</th><th>Designation</th><th>Gender</th><th>Edit</th><th><button class="btn btn-danger btn-xs" onclick="deleteUsers()">Delete</button></th></tr>' +
        '</thead>' +
        '<tbody>';
    for (i = 0; i < data.length; i++) {
        htmlString += '<tr id="tr_' + data[i].ident + '"><td>' + (i + 1) + '</td><td>' + data[i].name + '</td><td>' + data[i].designation + '</td><td>' + data[i].gender + '</td>' +
            '<td><button onclick="updateUsers(this)" id="edit_' + data[i].ident + '" class="btn btn-default btn-xs">edit</button></td>' +
            '<td><input type="checkbox" name="approve[]" value="' + data[i].ident + '" /></td>' +
            '</tr>';
    }

    htmlString += '</tbody></table>';

    for (j = 0; j < data.length; j++) {
        htmlString += '<div class="form-group" id="update_' + data[j].ident + '" style="display: none">' +
            '<div class="col-sm-4">' +
            '<input type="text" class="form-control" id="name_' + data[j].ident + '" value="' + data[j].name + '">' +
            '<div class="has-error" id="name_error"></div>' +
            '</div>' +
            '<div class="col-sm-4">' +
            '<input type="text" class="form-control" id="designation_' + data[j].ident + '" value="' + data[j].designation + '">' +
            '<div class="has-error" id="designation_error"></div>' +
            '</div>' +
            '<div class="col-sm-4">' +
            '<input type="text" class="form-control" id="gender_' + data[j].ident + '" value="' + data[j].gender + '">' +
            '<div class="has-error" id="gender_error"></div>' +
            '</div>' +
            '<button class="btn btn-warning" id="save_' + data[j].ident + '" onclick="saveChanges(this)">Save</button>' +
            '</div>' +
            '</div>' +
            '</div>';
    }
}
    else
    {
        htmlString += '<span class="has-error">Nothing found</span>';
    }
    container.insertAdjacentHTML('beforeend', htmlString);
};