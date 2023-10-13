<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API CRUD & Search - Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        h3{
            text-align: center;
            margin-top: 5px;
        }
        h5{
            text-align: center;
        }
        .message{
            position: fixed;
            top: 60px;
            right: 5px;
            background-color: red;
            padding: 10px 15px;
            border-radius: 50px;
            color: white;
            display: none;
        }
        .addbtn{
            text-align: center;
        }
    </style>
  </head>
  <body>
    <div class="message">
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">API CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
              </li>
            </ul>
            <form id="searchForm" class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search">
              <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <h3>Crud Through API</h3>
      <div class="addbtn">
        <button class="btn btn-dark" onclick="showCreateModal()">Add User</button>
      </div>
      <hr>
      <h5>Fetched User</h5>
      <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>        
    </div>
    <!-- Modal for updating data -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="updateName">Name</label>
                        <input type="text" class="form-control" id="updateName">
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">Email</label>
                        <input type="email" class="form-control" id="updateEmail">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateId">
                    </div>
                    <button type="button" class="btn btn-dark my-2" onclick="updateDataSubmit()">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Credentials</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="createName">Name</label>
                        <input type="text" class="form-control" id="createName" required>
                    </div>
                    <div class="form-group">
                        <label for="createEmail">Email</label>
                        <input type="email" class="form-control" id="createEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="createPassword">Password</label>
                        <input type="password" class="form-control" id="createPassword" required>
                    </div>
                    <button type="button" class="btn btn-dark my-2" id="saveCreate" onclick="createData()">Create</button>
            </div>
        </div>
    </div>
</div>
<footer class="my-5 text-center">
    <p>Copyright &copy; {{ date('Y') }} | All Rights Reserved | Created By Rajan</p>
</footer>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        function createUserRow(user) {
        const tableRow = document.createElement('tr');
        tableRow.innerHTML = `
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>
                <button type="button" class="btn btn-dark btn-sm" onclick="updateData(${user.id}, '${user.name}', '${user.email}')">Update</button>
                <button type="button" class="btn btn-danger btn-sm update-button" onclick="deleteData(${user.id})">Delete</button>
            </td>
        `;
        return tableRow;
    }
    function fetchData(){
        const apiUrl = 'http://localhost:8000/api/fetch';
        fetch(apiUrl)
        .then(response => {
            if (response.status === 200) {
            return response.json();
            } else {
            throw new Error('Failed to fetch data');
            }
        })
    .then(data => {
        const tableBody = document.getElementById('table-body');

        // Clear any existing table rows
        tableBody.innerHTML = '';

        // Iterate through the data and create table rows for each user
        data.forEach(user => {
        const userRow = createUserRow(user);
        tableBody.appendChild(userRow);
        });
    })
    .catch(error => {
        console.error(error);
    });
}
fetchData();
function deleteData(id){
const apiUrl = 'http://localhost:8000/api/deleteid';
const dataToSend = {
  id: id,
};

fetch(apiUrl, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    // Add any other headers if required
  },
  body: JSON.stringify(dataToSend),
})
  .then(response => {
    if (response.status === 200) { // Assuming a successful response status code (e.g., 201 for created)
      return response.json();
    } else {
      throw new Error('Failed to send data');
    }
  })
  .then(data => {
    // Handle the response data from the API
    fetchData();
    $('.message').html(data.Success);
    $('.message').fadeIn();
    setTimeout(() => {
        $('.message').fadeOut();
    }, 3000);
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error(error);
  });
}
function updateData(id, name, email){
    $('#updateId').val(id);
    $('#updateName').val(name);
    $('#updateEmail').val(email);
    $('#updateModal').modal('show');
}

function updateDataSubmit(){
    let id = document.getElementById('updateId').value;
    let name = document.getElementById('updateName').value;
    let email = document.getElementById('updateEmail').value;
    const apiUrl = 'http://localhost:8000/api/updateid';
const dataToSend = {
  id: id,
  name: name,
  email: email,
};

fetch(apiUrl, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    // Add any other headers if required
  },
  body: JSON.stringify(dataToSend),
})
  .then(response => {
    if (response.status === 200) { // Assuming a successful response status code (e.g., 201 for created)
      return response.json();
    } else {
      throw new Error('Failed to send data');
    }
  })
  .then(data => {
    // Handle the response data from the API
    fetchData();
    $('#updateModal').modal('hide');
    $('.message').html(data.Success);
    $('.message').fadeIn();
    setTimeout(() => {
        $('.message').fadeOut();
    }, 3000);
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error(error);
  });
}

function showCreateModal(){
    $('#createModal').modal('show');
}
function createData(){
    let name = document.getElementById('createName').value;
    let email = document.getElementById('createEmail').value;
    let password = document.getElementById('createPassword').value;
    const apiUrl = 'http://localhost:8000/api/create';
    const dataToSend = {
        name: name,
        email: email,
        password: password,
    };

fetch(apiUrl, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    // Add any other headers if required
  },
  body: JSON.stringify(dataToSend),
})
  .then(response => {
    if (response.status === 200) { // Assuming a successful response status code (e.g., 201 for created)
      return response.json();
    } else {
      throw new Error('Failed to send data');
    }
  })
  .then(data => {
    // Handle the response data from the API
    fetchData();
    $('#createModal').modal('hide');
    document.getElementById('createName').value = '';
    document.getElementById('createEmail').value = '';
    document.getElementById('createPassword').value = '';
    $('.message').html(data.Success);
    $('.message').fadeIn();
    setTimeout(() => {
        $('.message').fadeOut();
    }, 3000);
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error(error);
  });
}

$("#searchForm").submit(function (event) {
    event.preventDefault();
    var formData = {
      search: $("#search").val(),
    };
    const apiUrl = 'http://localhost:8000/api/search';

fetch(apiUrl, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    // Add any other headers if required
  },
  body: JSON.stringify(formData),
})
  .then(response => {
    if (response.status === 200) { // Assuming a successful response status code (e.g., 201 for created)
      return response.json();
    } else {
      throw new Error('Failed to send data');
    }
  })
  .then(data => {
    // Handle the response data from the API
    const tableBody = document.getElementById('table-body');

        // Clear any existing table rows
        tableBody.innerHTML = '';

        // Iterate through the data and create table rows for each user
        data.forEach(user => {
        const userRow = createUserRow(user);
        tableBody.appendChild(userRow);
        });
  })
  .catch(error => {
    // Handle any errors that occurred during the request
    console.error(error);
  });
  });

    </script>
  </body>
</html>